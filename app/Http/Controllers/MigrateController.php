<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigrateController extends Controller
{
    public function index(Request $request){

        if ($request->get('key') !== '124578963') {
            abort(403);
        }

        return Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true));
    }
}

