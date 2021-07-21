<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DevController extends Controller
{

    public function link(Request $request)
    {
        if ($request->get('key') !== '11155') {
            abort(403);
        }

        return Artisan::call('storage:link');
    }
}
