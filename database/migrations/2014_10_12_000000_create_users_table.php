<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rule');
            $table->integer('hidden');
            $table->integer('very');
            $table->string('name');
            $table->string('avatar');
            $table->string('linkprofile');
            $table->string('email');
            $table->string('password');
            $table->string('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('cmt')->nullable();
            $table->string('gender')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
