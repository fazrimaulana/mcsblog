<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePostsHasTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_has_tags', function(Blueprint $table){

            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_has_tags');
    }
}
