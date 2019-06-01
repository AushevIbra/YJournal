<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ReplyComment;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = ['text', 'user_id', 'post_id', 'imgs', 'parent_id', 'user_id_reply'];
    /**
     * @var ReplyComment $model
     */
    private static $model = ReplyComment::class;
    //

    /**
     * Метод добавляет комментарий в базу
     *
     * @param array $comment
     *
     * @return \App\Models\Comment $response
     */
    public static function addComment($comment)
    {
        $files = isset($comment['files']) ? implode($comment['files'], ';') : null;
        $response = self::create([
            'text' => $comment['text'],
            'imgs' => $files,
            'post_id' => $comment['posts_id'],
            'user_id' => auth()->user()->id,
            'parent_id' => $comment['parent_id'] ?? 0,
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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function userReply() {
        return $this->belongsTo('App\User', 'user_id_reply', 'id');
    }
    public function childrenComments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->with('user');
    }

    /**
     * Получает комментарии определенного поста по $id
     *
     * @param integer $id комметария
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getComments($id)
    {
        $comment = Comment::class;
        $response = $comment::with(['childrenComments', 'user'])->orderByDesc('id')->where([
                ['parent_id', 0],
                ['post_id', $id],
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
    public static function getOneComment($id)
    {
        $response = self::with(['childrenComments', 'user', 'post'])->find($id);

        return $response;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo("App\Models\Post");
    }
}
