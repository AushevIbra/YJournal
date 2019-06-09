<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->text('content');
            $table->integer('views')->default(0);
            $table->string('address');
            $table->string('name');
            $table->string('number');
            $table->string('price');
            $table->boolean('isFree')->default(false);
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->json('imgs')->nullable();
            $table->foreign("user_id")->references('id')->on('users');
            $table->foreign("category_id")->references('id')->on('categories');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
