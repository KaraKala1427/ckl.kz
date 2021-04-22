<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminlogs', function (Blueprint $table) {
            $table->id();
            $table->integer('aid')->default(null);
            $table->string('aname',250)->default('');
            $table->string('afio',250)->default('');
            $table->dateTime('adate')->default(null);
            $table->string('type',250)->default('');
            $table->string('tab',250)->default('');
            $table->integer('tabid')->default(null);
            $table->string('ip',50)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adminlogs');
    }
}
