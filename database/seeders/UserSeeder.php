<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            "password" => bcrypt('yayulia321'),
            "role_id"  => Role::ADMIN
        ]);


    }
}
