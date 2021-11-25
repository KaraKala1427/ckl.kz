<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('iin', 12);
            $table->string('email');
            $table->string('phone');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('patronymic_name');
            $table->string('policy_result');
            $table->string('limit_sum');
            $table->string('agr_isn');
            $table->string('status');
            $table->string('order_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covid');
    }
}


