<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
//            $table->string('name', 55)->nullable()->default('a')->index();
            $table->integer('orderid')->default(0);
            $table->integer('level')->default(0);
            $table->integer('subs')->default(0);
            $table->integer('goods')->default(0);
            $table->string('name_ru', 250);
            $table->string('name_kz', 250);
            $table->string('name_en', 250);
            $table->string('link', 250);
//            $table->enum('getlast', ['y', 'n'])->default('n');
            $table->set('getlast', ['y', 'n'])->default('n');
            $table->integer('depth')->default(0);
            $table->integer('user')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
