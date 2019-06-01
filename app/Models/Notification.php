<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];
    public static $STATUS = [
        'addComment' => 'addComment', // Добавли коммент к записи автора
        'replyComment' => 'replyComment', // Добавли коммент к записи автора
        'disslikeComment' => 'disslikeComment', //
        'disslikePost' => 'disslikePost', //
        'likeComment' => 'likeComment',
        'likePost' => 'likePost',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function post()
    {
        return $this->belongsTo("App\Models\Post");
    }

}
