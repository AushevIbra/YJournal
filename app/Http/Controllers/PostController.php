<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\TagAndPostRelation;
use Illuminate\Http\Request;
use App\Models\Post;
use application\lib\Codex;

class PostController extends Controller
{
    /**
     * @var Post
     */
    private $repository;

    public function __construct(Post $repository)
    {
        $this->middleware('auth', ['except' => 'show']);
        $this->repository = $repository;
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
    public function create(Tag $tag)
    {
        return view('posts.create', ['tags' => $tag::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, TagAndPostRelation $tagAndPostRelation)
    {
        $tagsIds = $tag::add($request->post('data')['tags'] ?? []);
        $model = new $this->repository($request->all()['data']);
        $post = $model->add();
        if ($post['slug']) {
            $tagAndPostRelation::add($tagsIds, $post['id']);
            return response()->json(['slug' => $post['slug']], 200);
        } else {
            return response()->json(['error' => 'Не удалось добавить запись'], 401);
        }
    }

    public function show($slug, Comment $commentModel)
    {

        $data = $this->repository->findPost($slug);
        if ($data) {
            $this->repository::increment('views');
//            $comments = $commentModel::where([['post_id', $data->id], ['parent_id', 0]])->orderByDesc('updated_at')->with('childrenComments')->get();
            $body = json_decode($data->body, true)['blocks'];
            $codex = new Codex($body, ['img' => 'responsive-img']);
            return view('posts.show', ['data' => $data, 'body' => $body, 'codex' => $codex]);
        } else {
            return redirect('/404');
        }
    }

    public function edit($id)
    {
        //
    }

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
