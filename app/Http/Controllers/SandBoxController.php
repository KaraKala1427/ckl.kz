<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class SandBoxController extends Controller
{
    public function sandbox(){

        User::create([
            "username" => "super_admin",
            "password" => bcrypt('password'),
            "role_id"  =>  Role::SUPER_ADMIN
        ]);

        User::create([
            "username" => "admin",
            "password" => bcrypt('password'),
            "role_id"  => Role::ADMIN
        ]);

        User::create([
            "username" => "yulia",
            "password" => bcrypt('Asdfgh123#'),
            "role_id"  => Role::ADMIN
        ]);
        User::create([
            "username" => "aizhan",
            "password" => bcrypt('Nahzia321!'),
            "role_id"  => Role::ADMIN
        ]);

        User::create([
            "username" => "Ruslan",
            "password" => bcrypt('2221904r'),
            "role_id"  => Role::ADMIN
        ]);


    }

}
