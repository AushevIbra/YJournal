<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Events\AnswerEvent;
use App\Http\Requests\StoreAnswer;
use App\Http\Requests\StoreComment;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * @var Answer
     */
    private $answer;

    public function __construct(Answer $answer){

        $this->answer = $answer;
    }

    /**
     * Получает комментарии определенного поста по $id
     *
     * @param integer $id
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments($id, Answer $answer)
    {
        $response = $answer::with(['childrenComments', 'user'])
            ->orderByDesc('id')
            ->where([
                ['parent_id', 0],
                ['ask_id', $id],
            ])
            ->paginate(5);
        return new \App\Http\Resources\Answer($response);
    }

    public function addComment(StoreAnswer $request) {
        $response = $request->only('text', 'files', 'ask_id', 'parent_id', 'userID');
        $comment = $this->answer::addComment($response);
        $comment = $this->answer::getOneComment($comment->id);
        event(new AnswerEvent($comment));
    }
}
