<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Progress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   // tiến độ dự án
        Schema::create('progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project');
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
