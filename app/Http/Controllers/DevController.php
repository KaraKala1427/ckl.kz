<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DevController extends Controller
{


    public function link()
    {
       return Artisan::call('storage:link');
    }
}
