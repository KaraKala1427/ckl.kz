<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Covid;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class  CovidController extends Controller
{

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
        return response()->json($response);
    }


    public function setClient(Request $request)
    {
        $array = $request->all();
        $dataOrder = array([
            'code' => 200,
            'Phone' => 'Phone',
            'Email' => 'Email',
            'Calc_Sum' => 'Calc_Sum',
            'subjects' => [
                0 => [
                    'kias' => [
                        'First_Name' => $array["First_Name"],
                        'Last_Name' => $array["Last_Name"],
                        'Patronymic_Name' => $array["Patronymic_Name"],
                        'Born' => $array['Born'],
                        'DOCUMENT_GIVED_DATE' => $array['DOCUMENT_GIVED_DATE'],
                        'DOCUMENT_NUMBER' => $array['DOCUMENT_NUMBER']
                    ],
                    'user' => [
                        'iin' => $array["iin"],
                        'First_Name' => $array["First_Name"],
                        'Last_Name' => $array["Last_Name"],
                        'Patronymic_Name' => $array["Patronymic_Name"],
                        'Born' => $array['Born'],
                        'DOCUMENT_GIVED_DATE' => $array['DOCUMENT_GIVED_DATE'],
                        'DOCUMENT_NUMBER' => $array['DOCUMENT_NUMBER'],
                    ],
                ],
            ],
        ]);

        $writeToDataJson= array([
            'Phone' => $array['Phone'],
            'Email' => $array['Email'],
            'Calc_Sum' => $array['Calc_Sum'],
            'First_Name' => $array['First_Name'],
            'Last_Name' => $array['Last_Name'],
            'Patronymic_Name' => $array['Patronymic_Name'],
            'Born' => $array['Born'],
            'DOCUMENT_GIVED_DATE' => $array['DOCUMENT_GIVED_DATE'],
            'DOCUMENT_NUMBER' => $array['DOCUMENT_NUMBER'],


        ]);

        $Covi = new Covid();
        $Covi->Phone = $array['Phone'];
        $Covi->Email = $array['Email'];
        $Covi->Calc_Sum = $array['Calc_Sum'];
        $json_array = json_encode($writeToDataJson);
        $Covi->Order_Data = $json_array;
        $Covi->save();
    }

    public static function secret($response)
    {
        $response['client']['DOCUMENT_GIVED_DATE'] = substr($response['client']['DOCUMENT_GIVED_DATE'], 0, 1) . "*.**.***" . substr($response['client']['DOCUMENT_GIVED_DATE'], -1);
        $response['client']['DOCUMENT_NUMBER'] = substr($response['client']['DOCUMENT_NUMBER'], 0, 2) . "*****" . substr($response['client']['DOCUMENT_NUMBER'], -2);
        return $response;
    }

 }

