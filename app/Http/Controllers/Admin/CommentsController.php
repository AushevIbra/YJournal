<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentsController extends Controller
{
    /**
     * @var \App\Models\Comment $model
     */
    private static $model;

    /**
     * CommentsController constructor.
     *
     * @param \App\Models\Comment $model
     */
    public function __construct(Comment $model)
    {
        self::$model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreComment $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request)
    {
        $response = $request->only('text', 'files', 'posts_id', 'parent_id', 'userID');
        $comment = self::$model::addComment($response);
        $comment = self::$model::getOneComment($comment->id);
        event(new \App\Events\CommentEvent($comment));
        event(new \App\Events\LiveCommentEvent($comment));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
