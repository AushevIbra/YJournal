<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {
    protected $guarded = [];
    /**
     * Метод добавляет комментарий в базу
     *
     * @param array $comment
     *
     * @return \App\Models\Comment $response
     */
    public static function addComment($comment){
        $response = self::create([
            'text'          => $comment['text'],
            'ask_id'       => $comment['ask_id'],
            'user_id'       => auth()->user()->id,
            'parent_id'     => $comment['parent_id'] ?? 0,
            'user_id_reply' => $comment['userID'] ?? null,
        ]);

        return $response;
    }

    /**
     * Функция возвращает комментарии определенного поста
     *
     * @param integer $id_post
     *
     * @return array
     */
    //public static function getComments($id_post)
    //{
    //    $comments = ;
    //
    //    return $comments;
    //}

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function userReply(){
        return $this->belongsTo('App\User', 'user_id_reply', 'id');
    }

    public function childrenComments(){
        return $this->hasMany(Answer::class, 'parent_id', 'id')->with('user');
    }

    /**
     * Получает комментарии определенного поста по $id
     *
     * @param integer $id комметария
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getComments($id){
        $comment = Comment::class;
        $response = $comment::with(['childrenComments', 'user'])->orderByDesc('id')->where([
            ['parent_id', 0],
            ['ask_id', $id],
        ])->get();

        return $response;
    }

    /**
     * Получает комментарий определенного поста по $id
     *
     * @param integer $id комметария
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getOneComment($id){
        $response = self::with(['childrenComments', 'user', 'ask'])->find($id);

        return $response;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ask(){
        return $this->belongsTo("App\Ask");
    }
}
