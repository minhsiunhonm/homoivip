<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Very extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('very', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('status');
            $table->string('code');
            $table->string('thesv')->nullable();
            $table->string('hdld')->nullable();
            $table->string('mattruoccmt')->nullable();
            $table->string('matsaucmt')->nullable();
            $table->string('masothue')->nullable();
            $table->string('giayphepdkkd')->nullable();
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
        Schema::dropIfExists('very');
    }
}
