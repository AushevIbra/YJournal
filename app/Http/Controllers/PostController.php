<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\TagAndPostRelation;
use Illuminate\Http\Request;
use App\Models\Post;
use application\lib\Codex;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller {
    /**
     * @var Post
     */
    private $repository;

    public function __construct(Post $repository){
        $this->middleware('auth', ['except' => 'show']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = $this->post->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tag $tag){
        return view('posts.create', ['tags' => $tag::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, TagAndPostRelation $tagAndPostRelation){
        $tagsIds = $tag::add($request->post('data')['tags'] ?? []);
        $post = Post::create([
            'title'   => $request->post('data')['title'],
            'body'    => json_encode($request->post('data')['data']),
            'user_id' => auth()->user()->id,
            'main_img' => request('data')['img']
        ]);
        if($post->slug){
            $tagAndPostRelation::add($tagsIds, $post['id']);

            return response()->json(['slug' => $post['slug']], 200);
        } else {
            return response()->json(['error' => 'Не удалось добавить запись'], 401);
        }
    }

    public function show($slug, Comment $commentModel){

        $data = $this->repository->findPost($slug);
        if($data){
            $this->repository::increment('views');
            //            $comments = $commentModel::where([['post_id', $data->id], ['parent_id', 0]])->orderByDesc('updated_at')->with('childrenComments')->get();
            $body = json_decode($data->body, true)['blocks'];
            $codex = new Codex($body, ['img' => 'responsive-img']);

            return view('posts.show', ['data' => $data, 'body' => $body, 'codex' => $codex]);
        } else {
            return redirect('/404');
        }
    }

    public function edit($slug){
        $post = Post::where("slug", $slug)->firstOrFail();
        $blocks = json_decode($post->body);
        $blocks = json_encode($blocks->blocks);
        $renderBlocks = "\"blocks\":" . $blocks;
        $tags = Tag::get();

        return view('posts.edit', compact('post', 'tags', 'renderBlocks'));
    }

    public function update(Request $request, $id){
        $tagsIds = Tag::add($request->post('data')['tags'] ?? []);
        $post = Post::find($id);
        $update = $post->update([
            'title'   => $request->post('data')['title'],
            'body'    => json_encode($request->post('data')['data']),
            'user_id' => auth()->user()->id,
        ]);
        if($update){
            TagAndPostRelation::add($tagsIds, $post->id);

            return response()->json(['slug' => $post->slug], 200);
        } else {
            return response()->json(['error' => 'Не удалось отредактировать запись'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $post = Post::with('comments')->find($id);
        if(Gate::allows('delete-post', $post)){
            //$post->comments;
            $post->comments()->delete();
            $post->delete();
        }
    }
}
