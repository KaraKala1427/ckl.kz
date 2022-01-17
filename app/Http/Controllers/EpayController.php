<?php

namespace App\Http\Controllers;

use App\Services\Products\CovidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EpayController extends Controller
{
    protected $covidService;

    public function __construct(CovidService $service)
    {
        $this->covidService = $service;
    }


    public function paymentAuth(Request $request)
    {
        $order_id = $request->order_id;
        $amount   = $this->covidService->getFieldData($order_id, 'premium_sum');
        dd($amount);
        $data = $request->toArray();
        $response = Http::withOptions(['verify' => false])->post('https://testoauth.homebank.kz/epay2/oauth2/token',[
            "grant_type"    => "client_credentials",
            "scope"         => "payment",
            "client_id"     => "test",
            "client_secret" => "yF587AV9Ms94qN2QShFzVR3vFnWkhjbAK3sG",
            "invoiceID"     => "002300030",
            "amount"        => 150,
            "currency"      => "KZT",
            "terminal"      => "67e34d63-102f-4bd1-898e-370781d0074d"
        ])->json();

        return $response;
    }

    public function epayRedirect()
    {
        return view('pages.test.epay_redirect');
    }

    public function successPayment()
    {
        return view('pages.test.success-payment');
    }

    public function failurePayment()
    {
        return view('pages.test.failure-payment');
    }

    public function paymentResponse(Request $request)
    {
        $response = $request->getContent();
        $token = $request->bearerToken();
        $headers = $request->header();
        Log::channel('payment')->info("{$response} , token : $token,  headers : $headers");
    }
}
