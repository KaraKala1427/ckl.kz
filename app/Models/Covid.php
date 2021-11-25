<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{

    use HasFactory;
    protected $fillable = [
        'iin',
        'Phone',
        'Email',
        'Calc_Sum',
        'First_Name',
        'Last_Name',
        'Patronymic_Name',
        'Born',
        'DOCUMENT_GIVED_DATE',
        'DOCUMENT_NUMBER'
    ];



}


//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use App\Models\Covid;
//
//class CovidController extends Controller
//{
//
//    public function index()
//    {
//        return view('pages.covid');
//    }
//
//    public function answer(Request $request)
//    {
//        $array = $request->request->all();
////        \Log::info($array);
//        $dataOrder = array([
//            'code' => 200,
//            'Phone' => 'Phone',
//            'Email' => 'Email',
//            'Calc_Sum' => 'Calc_Sum',
//            'subjects' => [
//                0 => [
//                    'kias' => [
//                        'First_Name' => $array["First_Name"],
//                        'Last_Name' => $array["Last_Name"],
//                        'Patronymic_Name' => $array["Patronymic_Name"],
//                        'Born' => $array['Born'],
//                        'DOCUMENT_GIVED_DATE' => $array['DOCUMENT_GIVED_DATE'],
//                        'DOCUMENT_NUMBER' => $array['DOCUMENT_NUMBER']
//                    ],
//                    'user' => [
//
//                        'First_Name' => $array["First_Name"],
//                        'Last_Name' => $array["Last_Name"],
//                        'Patronymic_Name' => $array["Patronymic_Name"],
//                        'Born' => $array['Born'],
//                        'DOCUMENT_GIVED_DATE' => $array['DOCUMENT_GIVED_DATE'],
//                        'DOCUMENT_NUMBER' => $array['DOCUMENT_NUMBER'],
//                    ],
//                ],
//            ],
//        ]);
//
//        $writeToDataJson = array([
//            'Phone' => $array['Phone'],
//            'Email' => $array['Email'],
//            'Calc_Sum' => $array['Calc_Sum'],
//            'First_Name' => $array['First_Name'],
//            'Last_Name' => $array['Last_Name'],
//            'Patronymic_Name' => $array['Patronymic_Name'],
//            'Born' => $array['Born'],
//            'DOCUMENT_GIVED_DATE' => $array['DOCUMENT_GIVED_DATE'],
//            'DOCUMENT_NUMBER' => $array['DOCUMENT_NUMBER'],
//
//
//        ]);
//
//        $Covi = new Covid();
//        $Covi->Phone = $array['Phone'];
//        $Covi->Email = $array['Email'];
//        $Covi->Calc_Sum = $array['Calc_Sum'];
//        $json_array = json_encode($writeToDataJson);
//        $Covi->Order_Data = $json_array;
//        $Covi->save();
//
////
////        $dataOrder['DOCUMENT_GIVED_DATE'] = substr($dataOrder['DOCUMENT_GIVED_DATE'], 0, 1)
////            . "*.**.***" . substr($dataOrder['DOCUMENT_GIVED_DATE'], -1);
////
////        $dataOrder['DOCUMENT_NUMBER'] = substr($dataOrder['DOCUMENT_NUMBER'], 0, 2)
////            . "*****" . substr($dataOrder['DOCUMENT_NUMBER'], -2);
////                    return response()->json($dataOrder);
//    }
//
//}
//
