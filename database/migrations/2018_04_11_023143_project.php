<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('name');
            $table->string('short_description');
            $table->string('place');
            $table->string('video_slide');
            $table->integer('hidden');
            $table->integer('money');
            $table->integer('min_money')->nullable();
            $table->longText('tag')->nullable();
            $table->string('status')->nullable();
            
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
        Schema::dropIfExists('project');
    }
}
