<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('notifications', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('title'); // Что он сделал ? // Ответил на коммент...n
//            $table->enum("type", [
//                'addComment', // Добавли коммент к записи автора
//                'replyComment', // Ответили на коммент автора
//                'disslikeComment',
//                'disslikePost',
//                'likeComment',
//                'likePost',
//            ]);
//            $table->string("from"); // Ссылка на событие
//            $table->integer('user_id')->unsigned()->nullable();
//            $table->integer('to')->unsigned()->nullable(); // КОму
//            $table->integer('post_id')->unsigned()->nullable();
//            $table->timestamps();
//
//            $table->foreign("user_id")->references('id')->on('users');
//            $table->foreign("to")->references('id')->on('users');
//            $table->foreign("post_id")->references('id')->on('posts');
//            $table->index(['user_id', 'post_id', 'to']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
