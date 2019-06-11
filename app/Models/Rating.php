<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rating extends Model {
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class, 'model_id');
    }

    public function comment(){
        return $this->belongsTo(Comment::class, 'model_id');
    }

    /**
     * Возвращает связь с моделью
     *
     * @param Rating $rating
     * @return mixed
     */
    public static function withModel(Rating $rating){
        $user_id = auth()->user()->id;
        if($rating->model === "App\Models\Comment"){
            $model = Rating::with("comment")->find($rating->id)->comment;
            DB::select("DELETE  FROM `notifications` WHERE JSON_EXTRACT(`data`, '$.comment_id') = {$model->id} and JSON_EXTRACT(`data`, '$.user_id') = {$user_id}");
            return $model;
        }

        if($rating->model === "App\Models\Post"){
            $model = Rating::with("post")->find($rating->id)->post;
            DB::select("DELETE  FROM `notifications` WHERE JSON_EXTRACT(`data`, '$.post_id') = {$model->id} and JSON_EXTRACT(`data`, '$.user_id') = {$user_id}");

            return $model;

        }
    }
}
