<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('keyword');
            $table->string('version');
            $table->string('author');
            $table->string('web');
            $table->string('repository');
            $table->string('sequence');
            $table->string('license');
            $table->string('module');
            $table->string('status');
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
        //
        Schema::dropIfExists('modules');
    }
}
