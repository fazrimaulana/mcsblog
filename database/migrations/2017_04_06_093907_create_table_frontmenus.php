<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFrontmenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontmenus', function(Blueprint $table){

            $table->increments('id');
            $table->string('menu_id')->unique();
            $table->string('parent_id')->nullable();
            $table->integer('page_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('href');
            $table->enum('target', ["_blank", "_self", "_parent", "_top"]);
            $table->string('title');
            $table->string('icon');
            $table->string('module');
            $table->string('permission');
            $table->integer('sequence');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frontmenus');
    }
}
