<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('orderid')->default(0);
            $table->string('raz')->default('0');
            $table->integer('razid')->default(0);
            $table->dateTime('dat')->default(null);
            $table->date('pubdat')->default(null);
            $table->date('fromm')->default(null);
            $table->date('too')->default(null);
            $table->string('name_ru', 250)->default('');
            $table->text('head_ru')->nullable();
            $table->text('keywords_ru')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('img_ru', 250)->default('');
            $table->longText('tex_ru')->nullable();
            $table->string('name_en', 250)->default('');
            $table->text('head_en')->nullable();
            $table->text('keywords_en')->nullable();
            $table->text('description_en')->nullable();
            $table->string('img_en', 250)->default('');
            $table->longText('tex_en')->nullable();
            $table->string('name_kz', 250)->default('');
            $table->text('head_kz')->nullable();
            $table->text('keywords_kz')->nullable();
            $table->text('description_kz')->nullable();
            $table->string('img_kz', 250)->default('');
            $table->longText('tex_kz')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
