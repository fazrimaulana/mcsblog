<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function(Blueprint $table){

        	$table->increments('id');
        	$table->integer('user_id')->unsigned();
        	$table->string('url');
        	$table->string('title');
        	$table->string('caption')->nullable();
        	$table->string('alt')->nullable();
        	$table->text('description')->nullable();
            $table->timestamps();

        	$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
