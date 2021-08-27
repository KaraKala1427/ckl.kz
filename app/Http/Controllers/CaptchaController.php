<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function index() {
        return view('pages.checkpolicy');
    }

    public function capthcaFormValidate(Request $request) {

        $request->validate([
            'code' => 'required',
            'captcha' => 'required|captcha'
        ]);
        $data = array('code' => ['code'], 'captcha' => ['captcha']);
echo 'true';
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
