<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asks', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->longText("body");
            $table->integer('user_id')->unsigned();
            $table->integer('views')->default(0);
            $table->integer('rating')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("user_id")->references('id')->on('users');
            $table->index(['user_id', 'id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asks');
    }
}
