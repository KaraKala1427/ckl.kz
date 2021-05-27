<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldFileSizeTypeInFilemanager extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filemanager', function (Blueprint $table) {
            $table->bigInteger('file_size')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filemanager', function (Blueprint $table) {
            $table->float('file_size')->change();
        });
    }
}
