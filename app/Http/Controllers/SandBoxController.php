<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class SandBoxController extends Controller
{
    public function sandbox(){

        User::create([
            "username" => "Ruslan",
            "password" => bcrypt('2221904r'),
            "role_id"  => Role::ADMIN
        ]);


    }

}
