<?php

namespace App\Http\Controllers;

use App\Models\Ads\Category;
use App\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\AddComment;
use App\Models\TagAndPostRelation;
use App\Models\Tag;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
//        $tags = DB::select("SELECT COUNT(tag_and_post_relations.id) as cnt, tags.title, tags.id FROM `tag_and_post_relations` JOIN tags ON tag_and_post_relations.tag_id = tags.id GROUP BY
//tag_and_post_relations.tag_id ORDER BY  cnt DESC LIMIT 10");

        return view('index');
    }

    public function logout(Request $request){
        Auth::logout();

        return redirect("/");
    }

    public function clear(){
        Artisan::call("migrate");
        Artisan::call("db:seed");
//        Artisan::call("route:cache");
//        Artisan::call("view:clear");
//        Artisan::call("config:cache");
    }

    public function test(){
        //        \auth()->user()->notify(new AddComment());
        foreach(\auth()->user()->notifications as $notification){
            echo $notification->data['message'] . "<br>";
        }
    }

    public function about()
    {
        return view('about');
    }

    /**
     * Для вывода записей по тегам
     *
     */
    public function tag($tag){

        return view('posts.tag', compact('tag'));
    }

}
