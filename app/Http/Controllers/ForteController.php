<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForteController extends Controller
{
    public function forteLogin(Request $request)
    {
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/forte-bank/login', [
            "token" => "wesvk345sQWedva55sfsd*g",
            "username" => $request->username,
            "password" => $request->password
        ])->json();

        if ($response['code'] == 200) {
            session()->put('authenticated', time());
            session()->put('forteBankSession', $response);
            return response()->json($response);
        } else {
            return response()->json([
                'code' => 401,
                'result' => false
            ]);
        }
    }

    public function forteLogout()
    {
        if (session()->has('authenticated')) {
            session()->pull('authenticated');
            session()->pull('forteBankSession');
        }
        return redirect(route('agent.login'));
    }
}
