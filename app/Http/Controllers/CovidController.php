<?php

namespace App\Http\Controllers;

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
        $response = self::secret($response);
        $this->kiasClient =  $response['client'];
        return response()->json($response);
    }


    public function setOrder(Request $request)
    {
        $array = $request->all();
        $dataOrder = $this->formDataOrder($array);
        $order = new Order();
        $this->saveOrder($order, $array, $dataOrder);
        $subjISN = $this->setSubject($order);
        self::updateOrder($order, $subjISN);
        $responseDoc  = $this->setDocs($subjISN, $order);
        if($responseDoc['code'] != 200) return $responseDoc['error'];
        $responseESBD = $this->setSubjectESBD($subjISN);
        if($responseESBD['code'] == 200){
            $dateBeg = $this->getFieldValue($order, 'dateBeg');
            $dateEnd = $this->getFieldValue($order, 'dateEnd');
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
            if($responseAttributes == 'ok'){
                $responseCond = $this->setAgrCond($responseObj['obj_isn'], $order->agr_isn, self::getLimitSum($order));
                if($responseCond['code'] != 200) return $responseCond['error'];
                $responseCalc = $this->agrCalculate($order->agr_isn);
                if($responseCalc['code'] == 200) return $responseCalc['premium'];   // при успешном прохождении цепочки запросов (endpoint)
                return $responseCalc['error'];
            }
            return $responseAttributes['error'];
        }
        return $responseESBD['error'];

    }
    public function setSubject(Order $order)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setClient',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "iin"       => $order->iin,
            "fullName"  => $order->first_name." ".$order->last_name,
            "resident"  => "Y",
            "juridical" => "N",
            "sex"       => self::convertBoolToSex($this->kiasClient['Sex_ID']),
            "birthDay"  => $this->kiasClient['Born']
        ])->json();
        if($response['code'] == 200) return $response['subjectISN'];
        else return $response['error'];
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
            "docDateBeg"    => $this->getFieldValue($order, 'dateBeg'),
            "docDateEnd"    => $this->getFieldValue($order, 'dateEnd'),
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
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAgrObject',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "subjISN"   => $subjISN,
            "agrISN"    => $order->agr_isn,
            "objName"   => $order->first_name." ".$order->last_name,
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
        if($response['code'] == 200) return $response['role_isn'];
        else return $response['error'];
    }

    public function setAttributes($subjISN, Order $order)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAllAttribute',[
            "token"      => "wesvk345sQWedva55sfsd*g",
            "subjISN"    => $subjISN,
            "agrISN"     => $order->agr_isn,
            "email"     => $order->email,
            "phone"     => $order->phone,
            "programISN" => $this->getFieldValue($order, 'programISN'),
            "notificationISN" => $this->getFieldValue($order, 'notificationISN'),
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
    public function agrCalculate($agrISN)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/agrCalculate',[
            "token"      => "wesvk345sQWedva55sfsd*g",
            "agrISN"     => $agrISN
        ])->json();
        if($response['code'] == 200) return $response['premium'];
        else return $response['error'];
    }

    public static function secret($response)
    {
        $response['client']['DOCUMENT_GIVED_DATE'] = substr($response['client']['DOCUMENT_GIVED_DATE'], 0, 1) . "*.**.***" . substr($response['client']['DOCUMENT_GIVED_DATE'], -1);
        $response['client']['DOCUMENT_NUMBER'] = substr($response['client']['DOCUMENT_NUMBER'], 0, 2) . "*****" . substr($response['client']['DOCUMENT_NUMBER'], -2);
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
                        'document_class_name' => $this->convertDocCLassName($this->kiasClient['DOCUMENT_TYPE_ID']),
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
                        'document_class_name' => $this->convertDocCLassName($array['documentTypeId']),
                    ],
                ],
            ],
        ]);
        return $dataOrder;
    }
    public static function updateOrder(Order $order, $subjISN)
    {
        $dataOrder = json_decode($order->order_data)['subjects'];
        $dataOrder[0]['kias']['subjISN'] = $subjISN;
        $dataOrder[0]['user']['subjISN'] = $subjISN;
        $order->order_data = json_encode($dataOrder);
        $order->save();
    }

    public static function getLimitSum(Order $order)
    {
        return json_decode($order->order_data)['limitSum'];

    }

    public static function convertBoolToSex($string)
    {
        return $string == '1' ? 'М' : 'Ж';
    }

    public function getFinalSubject(Order $order)
    {
        $subject = json_decode($order->order_data)['subjects'];
        if (strpos($subject[0]['user']['document_number'],'*') !== false)
        {
            return $subject[0]['kias'];
        }
        return $subject[0]['user'];
    }
    public function convertDocCLassName($typeId)
    {
        switch ($typeId) {
            case '1':
                $docClassName = 'Удостоверение личности гражданина Казахстана';
                break;
            case '2':
                $docClassName = 'Паспорт гражданина Казахстана';
                break;
            case '3':
                $docClassName = 'Свидетельство о рождении';
                break;
            case '4':
                $docClassName = 'Вид на жительство';
                break;
            case '8':
                $docClassName = 'Служебный паспорт Республики Казахстан';
                break;
        }
        return $docClassName;
    }

    public function getFieldValue(Order $order, $param)
    {
        $data = json_decode($order->order_data);
        return $data[$param];
    }

 }

