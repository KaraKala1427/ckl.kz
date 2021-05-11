<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFieldsNullableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles',function(Blueprint $table){
            $table->date('pubdat')->nullable()->change();
            $table->date('fromm')->nullable()->change();
            $table->date('too')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles',function(Blueprint $table){
            $table->date('pubdat')->nullable(false)->change();
            $table->date('fromm')->nullable(false)->change();
            $table->date('too')->nullable(false)->change();
        });
    }
}
