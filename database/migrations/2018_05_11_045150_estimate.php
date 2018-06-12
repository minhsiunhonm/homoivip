<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Estimate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('soluong');
            $table->string('donvi');
            $table->string('sotiensv');
            $table->string('sotienkhac');
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
        Schema::dropIfExists('estimate');
    }
}
