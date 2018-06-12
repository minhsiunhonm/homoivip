<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('vitri')->nullable();
            $table->string('id_project');
            $table->string('giatri')->nullable();
            $table->string('tengoi')->nullable();
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
        Schema::dropIfExists('kpi');
    }
}
