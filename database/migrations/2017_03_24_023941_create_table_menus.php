<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function(Blueprint $table){
            $table->increments('id');
            $table->string('menu_id');
            $table->string('parent_id');
            $table->string('name');
            $table->string('href');
            $table->string('target');
            $table->string('title');
            $table->string('icon');
            $table->string('module');
            $table->string('permission');
            $table->string('sequence');
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
        Schema::dropIfExists('menus');
    }
}
