<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table){

            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('author')->unsigned();
            $table->string('ip_address')->nullable();
            $table->integer('parent_id')->nullable();
            $table->text('content');
            $table->enum('status', ['pending', 'approved', 'spam', 'bin']);
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('comments');
    }
}
