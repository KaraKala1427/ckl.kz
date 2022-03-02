<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Products\CovidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class EpayController extends Controller
{
    protected $covidService;

    public function __construct(CovidService $service)
    {
        $this->covidService = $service;
    }


    public function paymentAuth(Request $request)
    {
        $order_id = (int)$request->order_id;
        $amount   = $this->covidService->getFieldData($order_id, 'premium_sum');
        $auth = Http::asForm()->post('https://epay-oauth.homebank.kz/oauth2/token',[
            "grant_type"    => "client_credentials",
            "scope"         => "payment",
            "client_id"     => "CKL.KZ",
            "client_secret" => "b)TUCpd&3vOa&W&C",
            "invoiceID"     => (string)$order_id,
            "amount"        => (int)$amount,
            "currency"      => "KZT",
            "terminal"      => "6eddddad-df65-4aea-b7b1-d323340dce27"
        ])->json();

        return $auth;
    }

    public function epayRedirect()
    {
        return view('pages.test.epay_redirect')->with(['auth' => session('auth'), 'order_id' => session('order_id'), 'amount' => session('amount')]);
    }

//    public function successPayment()
//    {
//        return view('pages.test.success-payment');
//    }

    public function failurePayment()
    {
        return view('pages.test.failure-payment');
    }

    public function paymentResponse(Request $request)
    {
        try {
            Log::channel('payment')->info("в Postlink постучались");
            $response = $request->getContent();
            $data = $request->toArray();
            Log::channel('payment')->info("Postlink: {$response}");
            $invoiceId = $data['invoiceId'] ?? 'emptyID';
            $order_status = $this->covidService->checkStatus($invoiceId);
            if ($order_status == 'accepted'){
                Log::channel('payment')->info("Договор уже подписан, но все равно в постлинк стучатся, по invoiceId: ".$invoiceId);
                return response()->json([
                    'message' => 'postlink уже было отработан, по invoiceId: '.$invoiceId
                ]);
            }
            $auth = json_encode($this->statusAuth());
            $status = json_encode($this->getStatus($auth, $invoiceId));
            $statusArray = json_decode($status,true);
            $orderId = (int)$statusArray['invoiceId'];
            Log::channel('payment')->info("Status: {$status}");
            if ($data['invoiceId'] == $statusArray['invoiceId'] && $data['amount'] == $statusArray['amount']) {
                $responseSavePostLink = $this->covidService->savePostLink($orderId, $status, $response);
                if ($responseSavePostLink['code'] == 200){
                    $responseSaveEsbd = $this->covidService->saveAgrToEsbd($orderId);
                    if($responseSaveEsbd['code'] == 200){
                        $resultStatusKias = $this->covidService->setAgrStatus($orderId);
                        if($resultStatusKias['code'] == 200){
                            $this->covidService->setStatusAccepted($orderId);
                            $policyResult = $this->covidService->savePolicyResult($orderId, $this->covidService->getAgrId($orderId));
                            if($policyResult != 'false'){
                                $this->covidService->sendOrderPaidEmailSuccess($this->covidService->getById($orderId), $responseSavePostLink['meok']);
                            }
                            else $this->covidService->sendOrderPaidEmailFail($this->covidService->getById($orderId), "Не записался номер договора");
                        }
                        else $this->covidService->sendOrderPaidEmailFail($this->covidService->getById($orderId), "Договор не подписался");
                    }
                    else $this->covidService->sendOrderPaidEmailFail($this->covidService->getById($orderId), "Договор не сел в ЕСБД");
                }
                else $this->covidService->sendOrderPaidEmailFail($this->covidService->getById($orderId), $responseSavePostLink);
            }
            else $this->covidService->sendOrderPaidEmailFail($this->covidService->getById($orderId), "Оплата не села");

            return response()->json([
                'message' => 'в postlink достучался'
            ]);
        }
        catch (\Exception $e){
            Log::debug("PaymentResponse/SaveAgrToEsbd/setAgrStatus failed ".$e->getMessage()." Code: ".$e->getCode()." Line: ".$e->getLine());
        }
    }

    public function statusAuth()
    {
        try {
            $auth = Http::asForm()->post('https://epay-oauth.homebank.kz/oauth2/token',[
                "grant_type"    => "client_credentials",
                "scope"         => "webapi usermanagement email_send verification statement statistics payment",
                "client_id"     => "CKL.KZ",
                "client_secret" => "b)TUCpd&3vOa&W&C"
            ])->json();

            return $auth;
        }
        catch (\Exception $e){
            Log::debug("statusAuth failed ".$e->getMessage());
        }
    }

    public function getStatus($auth, $invoiceId)
    {
        try {
            $array = json_decode($auth,true);
            $token = $array['access_token'];
            $status = Http::withToken($token)->get("https://epay-api.homebank.kz/operation/$invoiceId")->json();
            return $status;
        }
        catch (\Exception $e){
            Log::debug("getStatus ".$array." token: ".$token." ".$e->getMessage());
        }
    }



}
