<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMediameta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediameta', function(Blueprint $table){

            $table->increments('id');
            $table->integer('media_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('size');
            $table->string('dimension');
            $table->timestamps();

            $table->foreign('media_id')->references('id')->on('media')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediameta');
    }
}
