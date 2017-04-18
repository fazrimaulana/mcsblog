<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table){

            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->text('title');
            $table->text('slug');
            $table->text('content');
            $table->dateTime('published_at');
            $table->enum('type', ['post', 'page']);
            $table->enum('status', ['published', 'draft', 'trash']);
            $table->enum('visible', ['public', 'private']);
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('author')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('posts');
    }
}
