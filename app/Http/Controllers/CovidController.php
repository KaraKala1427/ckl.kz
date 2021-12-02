<?php

namespace App\Http\Controllers;

use App\Services\Helpers\EnsOrderHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

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
        $this->kiasClient =  $response['client'];
        session()->put('kiasClient', $response['client']);
        $response = EnsOrderHelper::secret($response);
        return response()->json($response);
    }


    public function setOrder(Request $request)
    {
        $array = $request->all();
        $dataOrder = $this->formDataOrder($array);
        if(isset($array['order_id']) && isset($array['hash']) && $this->checkHash($array['order_id'], $array['hash'])){
            try {
                $order = Order::findOrFail($array['order_id']);
            }
            catch (ModelNotFoundException $exception)
            {
                $order = new Order();
            }
        }
        else $order = new Order();
        $this->saveOrder($order, $array, $dataOrder);
        $responseSubjISN = $this->setSubject($order);
        if($responseSubjISN['code'] != 200) {
            session()->put('data',$responseSubjISN['error']);
            return $responseSubjISN['error'];
        }
        $subjISN = $responseSubjISN['subjectISN'];
        $key = 0;
        self::updateOrder($order, $subjISN, $key);
        $responseDoc  = $this->setDocs($subjISN, $order);
        if($responseDoc['code'] != 200) {
            session()->put('data',$responseDoc['error']);
            return $responseDoc['error'];
        }
        $responseESBD = $this->setSubjectESBD($subjISN);
        if($responseESBD['code'] == 200){
            $dateBeg = $this->getFieldOrderData($order, 'dateBeg');
            $dateEnd = $this->getFieldOrderData($order, 'dateEnd');
            if($order->agr_isn == null){
                $responseAgr = $this->setAgreement($subjISN, $dateBeg, $dateEnd, $order);
                if($responseAgr['code'] != 200) {
                    session()->put('data',$responseAgr['error']);
                    return $responseAgr['error'];
                }
            }
            else {
                $responseUpdate = $this->updateAgreement($subjISN, $order, $dateBeg, $dateEnd);
                if($responseUpdate['code'] != 200) {
                    session()->put('data',$responseUpdate['error']);
                    return $responseUpdate['error'];
                }
                $responseClear = $this->clearAgreement($order->agr_isn);
                if($responseClear['code'] != 200) {
                    session()->put('data',$responseClear['error']);
                    return $responseClear['error'];
                }
            }
            $responseObj = $this->setAgrObj($subjISN, $order);
            if($responseObj['code'] != 200) {
                session()->put('data',$responseObj['error']);
                return $responseObj['error'];
            }
            $responseRole = $this->setAgrRole($subjISN, $order);
            if($responseRole['code'] != 200) {
                session()->put('data',$responseRole['error']);
//                return $responseRole['error'];
            }
            $responseAttributes = $this->setAttributes($subjISN, $order);
            if($responseAttributes['data'] == 'ok'){
                $responseCond = $this->setAgrCond($responseObj['obj_isn'], $order->agr_isn, self::getLimitSum($order));
                if($responseCond['code'] != 200) {
                    session()->put('data',$responseCond['error']);
                    return $responseCond['error'];
                }
                $responseCalc = $this->agrCalculate($order);
                if($responseCalc['code'] != 200) {
                    session()->put('data',$responseCalc['error']);
                    return $responseCalc['error'];
                }
                if($responseCalc['code'] == 200){
                    $hash = md5($order->id."mySuperPassword123");
                    $data = [
                        'order_id' => $order->id,
                        'hash' =>$hash,
                        'premium' => $responseCalc['premium']
                    ];
                    session()->put('data', $data);
                    return response()->json($data);   // при успешном прохождении цепочки запросов (endpoint)
                }

            }
            else   {
                session()->put('data',$responseAttributes['error']);
                return $responseAttributes['error'];
            }
        }
        else {
            session()->put('data',$responseESBD['error']);
            return $responseESBD['error'];
        }

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
        ]);
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
            $dataOrder = json_decode($order->order_data,true);
            $dataOrder[0]['agrISN'] = $response['agr_isn'];
            $order->order_data = json_encode($dataOrder);
            $order->save();
        }
        return $response;
    }

    public function updateAgreement($subjISN, Order $order, $dateBeg, $dateEnd)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/updateAgreement',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN,
            "agrISN"    => $order->agr_isn,
            "agrBeg"    => $dateBeg,
            "agrEnd"    => $dateEnd
        ])->json();

        $dataOrder = json_decode($order->order_data,true);
        $dataOrder[0]['agrISN'] = $order->agr_isn;
        $order->order_data = json_encode($dataOrder);
        $order->save();
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
            "objName"   => $orderDataUser['last_name']." ".$orderDataUser['first_name'],
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
            "token"           => "wesvk345sQWedva55sfsd*g",
            "subjISN"         => $subjISN,
            "agrISN"          => $this->getFieldOrderData($order, 'agrISN'),
            "email"           => $this->getFieldOrderData($order, 'email'),
            "phone"           => $this->getFieldOrderData($order, 'phone'),
            "programISN"      => (int)$this->getFieldOrderData($order, 'programISN'),
            "notificationISN" => (int)$this->getFieldOrderData($order, 'notificationISN'),
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
        $order->first_name = $array['firstName'];
        $order->last_name = $array['lastName'];
        $order->phone = $array['phone'];
        $order->email = $array['email'];
        $order->order_data = json_encode($dataOrder);
        return $order->save();
    }

    public function formDataOrder($array)
    {
        $this->kiasClient = session()->get('kiasClient');
        $dataOrder = array([
            'code' => 200,
            'phone' => $array['phone'],
            'email' => $array['email'],
            'notificationISN' => $array['notificationISN'],
            'programISN' => $array['programISN'],
            'limitSum' => $array['limitSum'],
            'dateBeg' => $array['dateBeg'],
            'dateEnd' => $array['dateEnd'] ?? '09.12.2022',
            'agrISN'  => null,
            'subjects' => [
                0 => [
                    'kias' => [
                        'subjISN' => null,
                        'iin' => $this->kiasClient['IIN'],
                        'first_name' => $this->kiasClient["First_Name"],
                        'last_name' => $this->kiasClient["Last_Name"],
                        'patronymic_name' => $this->kiasClient["Patronymic_Name"] ?? null,
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
        $dataOrder = json_decode($order->order_data,true);
        $dataOrder[0]['subjects'][$key]['kias']['subjISN'] = $subjISN;
        $dataOrder[0]['subjects'][$key]['user']['subjISN'] = $subjISN;
        $order->order_data = json_encode($dataOrder);
        $order->save();
    }

    public static function getLimitSum(Order $order)
    {
        return json_decode($order->order_data,true)[0]['limitSum'];

    }

    public function getFinalSubject(Order $order , $key = 0)
    {
        $result = [];
        $subject = json_decode($order->order_data,true)[0]['subjects'];
        $result['document_gived_by'] = $subject[$key]['user']['document_gived_by'];
        $result['document_class_name'] = $subject[$key]['user']['document_class_name'];
        if (strpos($subject[$key]['user']['document_number'],'*') !== false)
        {
            $result['document_number'] = $subject[$key]['kias']['document_number'];
        }
        else $result['document_number'] = $subject[$key]['user']['document_number'];
        if (strpos($subject[$key]['user']['document_gived_date'],'*') !== false)
        {
            $result['document_gived_date'] = $subject[$key]['kias']['document_gived_date'];
        }
        else $result['document_gived_date'] = $subject[$key]['user']['document_gived_date'];

        return $result;
    }

    public function getFieldOrderData(Order $order, $param , $key = 0)
    {
        $data = json_decode($order->order_data, true)[$key];
        return $data[$param];
    }

    public function checkHash($id, $hash)
    {
        if( md5($id."mySuperPassword123") == $hash) return true;
        return false;
    }

 }
