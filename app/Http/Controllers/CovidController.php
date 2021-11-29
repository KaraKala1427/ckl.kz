<?php

namespace App\Http\Controllers;

use App\Services\Helpers\EnsOrderHelper;
use Illuminate\Http\Request;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class  CovidController extends Controller
{
    protected $kiasClient = [];
    public function index()
    {
        return view('pages.covid');
    }

    public function getClient(Request $request)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/getClient',[
            'token'  => "wesvk345sQWedva55sfsd*g",
            'iin'    => $request->iin
        ])->json();
        $response = EnsOrderHelper::secret($response);
        $this->kiasClient =  $response['client'];
        return response()->json($response);
    }


    public function setOrder(Request $request)
    {
        $array = $request->all();
        $dataOrder = $this->formDataOrder($array);
        if(isset($array['order_id'])){
           $order = Order::findOrFail($array['order_id']);
        }
        else $order = new Order();
        $this->saveOrder($order, $array, $dataOrder);
        $responseSubjISN = $this->setSubject($order);
        if($responseSubjISN['code'] != 200) return $responseSubjISN['error'];
        $subjISN = $responseSubjISN['subjectISN'];
        $key = 0;
        self::updateOrder($order, $subjISN, $key);
        $responseDoc  = $this->setDocs($subjISN, $order);
        if($responseDoc['code'] != 200) return $responseDoc['error'];
        $responseESBD = $this->setSubjectESBD($subjISN);
        if($responseESBD['code'] == 200){
            $dateBeg = $this->getFieldOrderData($order, 'dateBeg');
            $dateEnd = $this->getFieldOrderData($order, 'dateEnd');
            if($order->agr_isn == null){
                $responseAgr = $this->setAgreement($subjISN, $dateBeg, $dateEnd, $order);
                if($responseAgr['code'] != 200) return $responseAgr['error'];
            }
            else {
                $responseUpdate = $this->updateAgreement($subjISN, $order->agr_isn, $dateBeg, $dateEnd);
                if($responseUpdate['code'] != 200) return $responseUpdate['error'];
                $responseClear = $this->clearAgreement($order->agr_isn);
                if($responseClear['code'] != 200) return $responseClear['error'];
            }
            $responseObj = $this->setAgrObj($subjISN, $order);
            if($responseObj['code'] != 200) return $responseObj['error'];
            $responseRole = $this->setAgrRole($subjISN, $order);
            if($responseRole['code'] != 200) return $responseRole['error'];
            $responseAttributes = $this->setAttributes($subjISN, $order);
            if($responseAttributes['result'] == 'ok'){
                $responseCond = $this->setAgrCond($responseObj['obj_isn'], $order->agr_isn, self::getLimitSum($order));
                if($responseCond['code'] != 200) return $responseCond['error'];
                $responseCalc = $this->agrCalculate($order);
                $finalArray = [$order->id, $hash, $responseCalc['premium']];
                if($responseCalc['code'] == 200) return $finalArray;   // при успешном прохождении цепочки запросов (endpoint)
                return $responseCalc['error'];
            }
            return $responseAttributes['error'];
        }
        return $responseESBD['error'];

    }
    public function setSubject(Order $order)
    {
        $orderDataUser = $this->getFieldOrderData($order,'subjects')[0]['user'];
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setClient',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "iin"       => $orderDataUser['iin'],
            "fullName"  => $orderDataUser['first_name']." ".$orderDataUser['last_name'],
            "resident"  => "Y",
            "juridical" => "N",
            "sex"       => EnsOrderHelper::identifySexByIIN($orderDataUser['iin']),
            "birthDay"  => $orderDataUser['born']
        ])->json();
        return $response;
    }

    public function setDocs($subjISN, Order $order)
    {
        $subjectDocs = $this->getFinalSubject($order);
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setSubjDocs',[
            "token"         => "wesvk345sQWedva55sfsd*g",
            "subjISN"       => $subjISN,
            "docClassName"  => $subjectDocs['document_class_name'],
            "docNo"         => $subjectDocs['document_number'],
            "docIssuedBy"   => $subjectDocs['document_gived_by'],
            "docDateBeg"    => $subjectDocs['document_gived_date'],
        ])->json();
        return $response;
    }

    public function setSubjectESBD($subjISN)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setSubjToEsbd',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN
        ])->json();
        return $response;

    }

    public function setAgreement($subjISN, $dateBeg, $dateEnd, Order $order)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAgreement',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN,
            "agrBeg"    => $dateBeg,
            "agrEnd"    => $dateEnd
        ])->json();
        if($response['code'] == 200) {
            $order->agr_isn = $response['agr_isn'];
            $dataOrder = json_decode($order->order_data);
            $dataOrder['agrISN'] = $response['agr_isn'];
            $order->order_data = json_encode($dataOrder);
            $order->save();
        }
        return $response;
    }

    public function updateAgreement($subjISN, $agr_isn, $dateBeg, $dateEnd)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/updateAgreement',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN,
            "agrISN"    => $agr_isn,
            "agrBeg"    => $dateBeg,
            "agrEnd"    => $dateEnd
        ])->json();
        return $response;
    }

    public function clearAgreement($agr_isn)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/clearAgreement',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "agrISN"    => $agr_isn
        ])->json();
        return $response;
    }

    public function setAgrObj($subjISN, Order $order)
    {
        $orderDataUser = $this->getFieldOrderData($order,'subjects')[0]['user'];

        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAgrObject',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN,
            "agrISN"    => $order->agr_isn,
            "objName"   => $orderDataUser['first_name']." ".$orderDataUser['last_name'],
        ])->json();
        return $response;
    }

    public function setAgrRole($subjISN, Order $order)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAgrRole',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN,
            "agrISN"    => $order->agr_isn,
            "role"      => "insurer",
        ])->json();
         return $response;
    }

    public function setAttributes($subjISN, Order $order)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAllAttribute',[
            "token"      => "wesvk345sQWedva55sfsd*g",
            "subjISN"    => $subjISN,
            "agrISN"     => $this->getFieldOrderData($order, 'agrISN'),
            "email"     => $this->getFieldOrderData($order, 'email'),
            "phone"     => $this->getFieldOrderData($order, 'phone'),
            "programISN" => $this->getFieldOrderData($order, 'programISN'),
            "notificationISN" => $this->getFieldOrderData($order, 'notificationISN'),
        ])->json();
        return $response;
    }

    public function setAgrCond($objISN, $agrISN, $limitSum)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAgrCondition',[
            "token"      => "wesvk345sQWedva55sfsd*g",
            "agrISN"     => $agrISN,
            "objISN"     => $objISN,
            "limitSum"   => $limitSum
        ])->json();

        return $response;
    }
    public function agrCalculate(Order $order)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/agrCalculate',[
            "token"      => "wesvk345sQWedva55sfsd*g",
            "agrISN"     => $order->agr_isn
        ])->json();
        if($response['code'] == 200){
            $order->premium_sum = $response['premium'];
            $order->save();
        }
        return $response;
    }

    public function saveOrder(Order $order, $array, $dataOrder)
    {
        $order->product = 'covid';
        $order->iin = $array['iin'];
        $order->first_name = $array['first_name'];
        $order->last_name = $array['last_name'];
        $order->phone = $array['phone'];
        $order->email = $array['email'];
        $order->order_data = json_encode($dataOrder);
        return $order->save();
    }

    public function formDataOrder($array)
    {
        $dataOrder = array([
            'code' => 200,
            'phone' => $array['phone'],
            'email' => $array['email'],
            'notificationISN' => $array['notificationISN'],
            'programISN' => $array['programISN'],
            'limitSum' => $array['limitSum'],
            'dateBeg' => $array['dateBeg'],
            'dateEnd' => $array['dateEnd'],
            'agrISN'  => null,
            'subjects' => [
                0 => [
                    'kias' => [
                        'subjISN' => null,
                        'iin' => $this->kiasClient['iin'],
                        'first_name' => $this->kiasClient["First_Name"],
                        'last_name' => $this->kiasClient["Last_Name"],
                        'patronymic_name' => $this->kiasClient["Patronymic_Name"],
                        'born' => $this->kiasClient['Born'],
                        'document_gived_date' => $this->kiasClient['DOCUMENT_GIVED_DATE'],
                        'document_number' => $this->kiasClient['DOCUMENT_NUMBER'],
                        'document_gived_by' => $this->kiasClient['DOCUMENT_GIVED_BY'],
                        'document_class_name' => EnsOrderHelper::convertDocCLassName($this->kiasClient['DOCUMENT_TYPE_ID']),
                    ],
                    'user' => [
                        'subjISN' => null,
                        'iin' => $array["iin"],
                        'first_name' => $array["firstName"],
                        'last_name' => $array["lastName"],
                        'patronymic_name' => $array["patronymicName"],
                        'born' => $array['born'],
                        'document_gived_date' => $array['documentGivedDate'],
                        'document_number' => $array['documentNumber'],
                        'document_gived_by' => $array['documentGivedBy'],
                        'document_class_name' => EnsOrderHelper::convertDocCLassName($array['documentTypeId']),
                    ],
                ],
            ],
        ]);
        return $dataOrder;
    }
    public static function updateOrder(Order $order, $subjISN , $key = 0)
    {
        $dataOrder = json_decode($order->order_data)['subjects'];
        $dataOrder[$key]['kias']['subjISN'] = $subjISN;
        $dataOrder[$key]['user']['subjISN'] = $subjISN;
        $order->order_data = json_encode($dataOrder);
        $order->save();
    }

    public static function getLimitSum(Order $order)
    {
        return json_decode($order->order_data)['limitSum'];

    }

    public function getFinalSubject(Order $order)
    {
        $result = [];
        $subject = json_decode($order->order_data)['subjects'];
        $result['document_gived_by'] = $subject[0]['user']['document_gived_by'];
        $result['document_class_name'] = $subject[0]['user']['document_class_name'];
        if (strpos($subject[0]['user']['document_number'],'*') !== false)
        {
            $result['document_number'] = $subject[0]['kias']['document_number'];
        }
        else $result['document_number'] = $subject[0]['user']['document_number'];
        if (strpos($subject[0]['user']['document_gived_date'],'*') !== false)
        {
            $result['document_gived_date'] = $subject[0]['kias']['document_gived_date'];
        }
        else $result['document_gived_date'] = $subject[0]['user']['document_gived_date'];

        return $result;
    }

    public function getFieldOrderData(Order $order, $param)
    {
        $data = json_decode($order->order_data);
        return $data[$param];
    }

 }

