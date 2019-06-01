<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create('reply_comment', function (Blueprint $table) {
        //    $table->integer('ancestor')->unsigned();
        //    $table->integer("descendant")->unsigned();
        //    $table->primary(['ancestor', 'descendant']);
        //
        //    $table->foreign('ancestor')->references('id')->on('comments');
        //    $table->foreign('descendant')->references('id')->on('comments');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply_comment');
    }
}
