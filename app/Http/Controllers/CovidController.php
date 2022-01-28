<?php

namespace App\Http\Controllers;

use App\Repositories\PhoneRepository;
use App\Services\Helpers\EnsOrderHelper;
use App\Services\Products\CovidService;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use AuthenticatesAndRegistersUsers;


class  CovidController extends Controller
{
    protected $kiasClient = [];
    protected $phoneRepository;
    protected $covidService;

    public function __construct(PhoneRepository $phoneRepository, CovidService $service)
    {
        $this->phoneRepository = $phoneRepository;
        $this->covidService = $service;
    }

    public function index(Request $request)
    {
        $order_id = $request->productOrderId;
        $hash = $request->hash;
        $urlStep = $request->step;
        if($order_id != null && $hash != null && $this->checkHash($order_id, $hash)){
            try {
                $order = Order::findOrFail($order_id);
                $premiumSum = $order->premium_sum;
                $step  = $order->step;
                $dataUrl = json_decode($order->order_data,true)[0];
                $timeLimitReached = $this->covidService->getTimeIfLimitReached($order_id);
                $verified = $this->covidService->isVerified($order_id) ? true : 'notVerified' ;
                $wrongAttempts = $this->covidService->getWrongAttempts($order_id);
                $allowedDate  = $this->covidService->IsAllowedDate($order);
                if ($urlStep == 1){
                    return view('pages.covid',compact('dataUrl','premiumSum'));
                }
                elseif ($step == 2 && $urlStep == $step){
                    return view('pages.covid2',compact('dataUrl', 'order','hash','order_id','timeLimitReached','verified','wrongAttempts','allowedDate'));
                }
                return redirect()->route('covid',['productOrderId'=> $order_id, 'hash' => $hash, 'step' => 1]);
            }
            catch (ModelNotFoundException $exception)
            {
                return view('pages.covid');
            }
        }
        return view('pages.covid');
    }

    public function getClient(Request $request)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/getClient',[
            'token'  => "wesvk345sQWedva55sfsd*g",
            'iin'    => $request->iin
        ])->json();
        if($response['code'] == 404){
            return response()->json($response);
        }
        $this->kiasClient =  $response['client'];
        session()->put('kiasClient', $response['client']);
        $response = EnsOrderHelper::secret($response);
        return response()->json($response);
    }

    public function nextStep(Request $request)
    {
        $order_id = $request->productOrderId;
        $hash = $request->hash;
        $urlStep = $request->step;
        if($order_id != null && $hash != null && $this->checkHash($order_id, $hash)){
            try {
                $order = Order::findOrFail($order_id);
                $order->step = $urlStep;
                $order->save();
                $dataUrl = json_decode($order->order_data,true)[0];
                if ($urlStep == 2){
                    return response()->json([
                        'code' => 200
                    ]);
                }
                return view('pages.covid',compact('dataUrl'));
            }
            catch (ModelNotFoundException $exception)
            {
                return view('pages.covid');
            }
        }
        return view('pages.covid');
    }

    public function prevStep(Request $request)
    {
        $order_id = $request->productOrderId;
        $hash = $request->hash;
        $urlStep = $request->step;
        $clearDate = $request->clearDate;
        if($order_id != null && $hash != null && $this->checkHash($order_id, $hash)){
            try {
                $order = Order::findOrFail($order_id);
                $dataUrl = json_decode($order->order_data,true);
                if ($urlStep == 1 && $clearDate == 1){
                    $order->agr_isn = '';
                    $dataUrl[0]['agrISN'] = '';
                    $dataUrl[0]['dateBeg'] = '';
                    $dataUrl[0]['dateEnd'] = '';
                    $order->order_data = json_encode($dataUrl);
                    $order->save();
                }
                return response()->json([
                    'code' => 200,
                    'step' => 1
                ]);
            }
            catch (ModelNotFoundException $exception)
            {
                return view('pages.covid');
            }
        }
        return view('pages.covid');
    }

    public function sendSms(Request $request)
    {
        $order_id = $request->order_id;
        $hash = $request->hash;
        $phone = $request->phone;
        if($order_id != null && $hash != null && $this->checkHash($order_id, $hash)){
            $timeLimitReached = $this->covidService->getTimeIfLimitReached($order_id,true);
            if($timeLimitReached == null){
                $code = rand(1000,9999);
                $model = $this->phoneRepository->create($order_id,$phone, $code);
                $this->covidService->sendSmsToPhone($phone, $code);
                if(!is_null($model)){
                    $timeLimitReached = $this->covidService->getTimeIfLimitReached($order_id,true);
                    return response()->json([
                        'code'    => 200,
                        'success' => true,
                        'time_limit_reached' => $timeLimitReached
                    ]);
                }
                return response()->json([
                    'code'    => 400,
                    'success' => false
                ]);
            }
            else {
                return response()->json([
                    'code'    => 400,
                    'success' => false,
                    'time_limit_reached' => $timeLimitReached
                ]);
            }
        }
    }

    public function confirmCode(Request $request)
    {
        $order_id = $request->order_id;
        $code = $request->code;
        $result = $this->covidService->confirmCode($order_id, $code);
        if($result['success']){
            return response()->json([
                'code'    => 200,
                'success' => true
            ]);
        }
        return response()->json([
            'code'    => 400,
            'success' => false,
            'limit_reached' => $result['limit_reached'],
            'time_limit_reached' => $result['time_limit_reached']
        ]);
    }

    public function getProgramIsn(Request $request)
    {

        $programIsn = $request->programISN;
        if($programIsn == '0') $limitSum = '';
        elseif($programIsn == '898641') $limitSum = "1 000 000";
        elseif ($programIsn == '898651') $limitSum = "2 000 000";
        elseif ($programIsn == '898661') $limitSum = "3 000 000";
        $response = ['code' => 200, 'limitSum' => $limitSum];

        if ($response['code'] == 200) {
            return response()->json($response);
        }
        else{
            return  response()->json([
                'code' => 404
            ]);
        }
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
        if($this->startOrNot($array['checkboxes'])){
            return response()->json([
                'code' => 422,
                'error' => "Позвоните в call-center."
            ]);
        }
        $responseSubjISN = $this->setSubject($order);
        if($responseSubjISN['code'] != 200) {
            return response()->json([
                'code' => 404,
                'error' => $responseSubjISN['error'],
                'function' => 'setSubject'
            ]);
        }
        $subjISN = $responseSubjISN['subjectISN'];
        $key = 0;
        self::updateOrder($order, $subjISN, $key);
        $responseDoc  = $this->setDocs($subjISN, $order);
        if($responseDoc['code'] != 200) {
            return response()->json([
                'code' => 404,
                'error' => $responseDoc['error'],
                'function' => 'setDocs'
            ]);
        }
        $responseESBD = $this->setSubjectESBD($subjISN);
        if($responseESBD['code'] == 200){
            $orderDataUser = $this->getFieldOrderData($order,'subjects')[0]['user'];
            $this->saveXmlInAndOut($responseESBD['xmlIsn'], $order, $orderDataUser['iin'] );
            $dateBeg = $this->getFieldOrderData($order, 'dateBeg');
            $dateEnd = $this->getFieldOrderData($order, 'dateEnd');
            if($order->agr_isn == null){
                $responseAgr = $this->setAgreement($subjISN, $dateBeg, $dateEnd, $order);
                if($responseAgr['code'] != 200) {
                    return response()->json([
                        'code' => 404,
                        'error' => $responseAgr['error'],
                        'function' => 'setAgr'
                    ]);
                }
            }
            else {
                $responseUpdate = $this->updateAgreement($subjISN, $order, $dateBeg, $dateEnd);
                if($responseUpdate['code'] != 200) {
                    return response()->json([
                        'code' => 404,
                        'error' => $responseUpdate['error'],
                        'function' => 'updateAgr'
                    ]);
                }
                $responseClear = $this->clearAgreement($order->agr_isn);
                if($responseClear['code'] != 200) {
                    return response()->json([
                        'code' => 404,
                        'error' => $responseClear['error'],
                        'function' => 'clearAgr'
                    ]);
                }
            }
            $responseObj = $this->setAgrObj($subjISN, $order);
            if($responseObj['code'] != 200) {
                return response()->json([
                    'code' => 404,
                    'error' => $responseObj['error'],
                    'function' => 'setAgrObject'
                ]);
            }
            $responseRole = $this->setAgrRole($subjISN, $order);
            if($responseRole['code'] != 200) {
//                return $responseRole['error'];
            }
            $responseAttributes = $this->setAttributes($subjISN, $order);
            if($responseAttributes['data'] == 'ok'){
                $responseCond = $this->setAgrCond($responseObj['obj_isn'], $order->agr_isn, self::getLimitSum($order));
                if($responseCond['code'] != 200) {
                    return response()->json([
                        'code' => 404,
                        'error' => $responseCond['error'],
                        'function' => 'setAgrCond'
                    ]);
                }
                $responseCalc = $this->agrCalculate($order);
                if($responseCalc['code'] != 200) {
                    return response()->json([
                        'code' => 404,
                        'error' => $responseCalc['error'],
                        'function' => 'agrCalculate'
                    ]);
                }
                if($responseCalc['code'] == 200){
                    if($order->email_calculation_sent != 'true')
                        $this->covidService->sendOrderEmail($order);

                    $hash = md5($order->id."mySuperPassword123");
                    $data = [
                        'code' => 200,
                        'order_id' => $order->id,
                        'hash' =>$hash,
                        'premium' => $responseCalc['premium']
                    ];
                    return response()->json($data);   // при успешном прохождении цепочки запросов (endpoint)
                }

            }
            else   {
                return response()->json([
                    'code' => 404,
                    'error' => $responseAttributes['error'],
                    'function' => 'setAttribute'
                ]);
            }
        }
        else {
            return response()->json([
                'code' => 404,
                'error' => $responseESBD['error'],
                'function' => 'setSubjectEsbd'
            ]);
        }
    }

    public function setSubject(Order $order)
    {
        $orderDataUser = $this->getFieldOrderData($order,'subjects')[0]['user'];

        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setClient',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "iin"       => $orderDataUser['iin'],
            "fisrtName" => $orderDataUser['first_name'],
            "lastName"  => $orderDataUser['last_name'],
            "middleName"  => $orderDataUser['patronymic_name'],
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
            "agrEnd"    => $dateEnd,
            "systemISN" => 624841
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
            "order_id"        => (string)$order->id
        ])->json();
        return $response;
    }

    public function setAgrCond($objISN, $agrISN, $limitSum)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/setAgrCondition',[
            "token"      => "wesvk345sQWedva55sfsd*g",
            "agrISN"     => $agrISN,
            "objISN"     => $objISN,
            "limitSum"   => (int)$limitSum
        ])->json();

        return $response;
    }

    public function forteLogin(Request $request)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/forte-bank/login', [
            "username" => $request->username,
            "password" => $request->password
        ])->json();

        if ($response['code'] == 200) {
            return response()->json($response);
        } else {
            return response()->json([
                'code' => 401,
                'result' => false
            ]);
        }
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
            'dateEnd' => $array['dateEnd'],
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
    public function startOrNot($checkboxString)
    {
        $k = substr_count($checkboxString, 'yes');
        if($k>2) return true;
        return false;
    }

    public function saveXmlInAndOut($xmlIsn, Order $order, $requestParam)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/getXmlInfo',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "xmlIsn"      => $xmlIsn,
        ])->json();
        if ($response['code'] == 200){
            $order->xml_in  .= PHP_EOL.PHP_EOL." -------------------- $requestParam".PHP_EOL.$response['result_cursor'][0]['XMLIN'];
            $order->xml_out .= PHP_EOL.PHP_EOL." -------------------- $requestParam".PHP_EOL.$response['result_cursor'][0]['XMLOUT'];
            $order->save();
        }
        return $response;
    }

    public function sendSmsToPhone(Request $request)
    {
        $phone = $request->phone;
        $code = $request->code;
        return $this->covidService->sendSmsToPhone($phone, $code);
    }

    public function setAgrStatus(Request $request)
    {
        $orderId = $request->order_id;
        return $this->covidService->setAgrStatus($orderId);
    }
 }
