<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModelToRating extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('ratings', function(Blueprint $table){
            $table->string("model")->default('App\Models\Post');
            $table->integer('model_id')->unsigned()->index();
            $table->dropForeign('ratings_post_id_foreign');
            $table->dropColumn('post_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('ratings', function(Blueprint $table){
            //
        });
    }
}
