<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('answers', function(Blueprint $table){
            $table->increments('id');
            $table->text("text");
            $table->text('imgs')->nullable();
            $table->integer("user_id")->unsigned();
            $table->integer('ask_id')->unsigned();
            $table->integer('user_id_reply')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('rating')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("user_id")->references('id')->on('users');
            $table->foreign("ask_id")->references('id')->on('asks');
            $table->index(['user_id', 'ask_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('answers');
    }
}
