<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

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
        if($rating->model === "App\Models\Comment"){
            $model = Rating::with("comment")->find($rating->id)->comment;
            Notification::where([['notifiable_type', "App\Models\Comment"], ["notifiable_id", $model->id]])->delete();
            return $model;
        }

        if($rating->model === "App\Models\Post"){
            $model = Rating::with("post")->find($rating->id)->post;
            Notification::where([['notifiable_type', "App\Models\Post"], ["notifiable_id", $model->id]])->delete();
            return $model;

        }
    }
}
