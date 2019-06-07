<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\User;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;
use application\lib\Codex;

class ApiController extends Controller {
    public function __construct(){
        //$this->middleware('csrf');
    }

    /**
     * Получает комментарии определенного поста по $id
     *
     * @param integer $id
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments($id, Comment $comment){
        $response = $comment::with(['childrenComments', 'user'])
            ->orderByDesc('id')
            ->where([
                ['parent_id', 0],
                ['post_id', $id],
            ])
            ->paginate(5);

        return new CommentResource($response);
    }

    /**
     * Получает комментарии определенного поста по $id
     *
     * @param integer $id комметария
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOneComment($id, Comment $comment){
        $response = $comment::getOneComment($id);

        return response()->json($response);
    }

    public function getPost($type){
        $data = Post::getData($type);
        foreach($data as $key => $item){
            $codex = new Codex(json_decode($item->body, true)['blocks']);
            $data[$key]['content'] = $codex->returnHtml();
            $data[$key]['attach'] = Codex::generateDesc(json_decode($item->body));
        }

        return new PostResource($data);
    }

    public function topComment(Comment $comment){

        $comment = $comment::with(['user', 'post'])->whereDate('created_at', date("Y-m-d"))->orderBy('rating', 'desc')->first();

        return $comment !== null? response(['data' => $comment]): response(['error' => 'Нет комментария']);
    }

    /**
     * Лента комментов
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function liveComments(Comment $comment){
        $comments = $comment::with(['user', 'post'])->orderBy('id', 'desc')->take(5)->get();

        return new CommentResource($comments);

    }

    public function notifications(Notification $notification){
        $notifications = \auth()->user()->notifications->take(5);

        return response()->json(['notifications' => $notifications]);
    }

    public function currentUser(Request $request){
        return response()->json(['user' => $request->user()]);
    }

    public function like($id){
        $rating = Rating::where([['model_id', $id], ['user_id', auth()->user()->id], ['model', \request('model')]])->first();
        $post = call_user_func_array([\request("model"), "find"], [$id]);
        if($rating === null){
            Rating::create([
                'type'     => 1,
                'user_id'  => auth()->user()->id,
                'model_id' => $id,
                'model'    => \request("model"),
            ]);
            $post->increment('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        } elseif($rating && $rating->type == 1) {
            //$rating->delete();
            $rating->update([
                'type' => -1,
            ]);
            $post->decrement('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        } elseif($rating && $rating->type == 0) {
            $rating->update([
                'type' => -1,
            ]);
            $post->increment('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        } elseif($rating && $rating->type == -1) {
            $rating->update([
                'type' => 1,
            ]);
            $post->increment('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        }

    }

    public function disslike($id){
        $rating = Rating::where([['model_id', $id], ['user_id', auth()->user()->id], ['model', \request('model')]])->first();
        $post = call_user_func_array([\request("model"), "find"], [$id]);
        if($rating === null){
            Rating::create([
                'type'     => 0,
                'user_id'  => auth()->user()->id,
                'model_id' => $id,
                'model'    => \request("model"),

            ]);
            $post->decrement('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        } elseif($rating && $rating->type == 0) {
            //$rating->delete();
            $rating->update([
                'type' => -1,
            ]);
            $post->increment('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        } elseif($rating && $rating->type == 1) {
            $rating->update([
                'type' => -1,
            ]);
            $post->decrement('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        } elseif($rating && $rating->type == -1) {
            $rating->update([
                'type' => 0,
            ]);
            $post->decrement('rating');

            return response()->json(['rating' => $post->rating, 'success' => true], 200);
        }
    }

}
