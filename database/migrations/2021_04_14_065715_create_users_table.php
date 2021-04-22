<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',50);
            $table->string('fio',50);
            $table->string('password',50);
            $table->set('active', ['y', 'n'])->default('y');
            $table->date('dat');
            $table->integer('sid')->default(1);
            $table->set('grup', ['a', 'u'])->default('a');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
