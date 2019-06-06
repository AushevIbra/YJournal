<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//DB::listen(function($query) {
//    var_dump($query->sql, $query->bindings);
//});

use Laravel\Socialite\Facades\Socialite;

Route::get('/', 'HomeController@index')->name('index');

Route::get('/test', function (Request $request){
   dd(Auth::user()->name);
});

Route::resource('post', 'PostController');
Route::get('/tag/{title}', 'HomeController@tag');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::post('/ulogin', 'UloginController@login');

Route::group(['prefix' => 'user'], function()
{

    Route::get('/profile/{id}', 'UserController@index')->name('user.profile');
    Route::get('/setting', 'UserController@setting')->name('user.setting')->middleware('auth');
    Route::post('/setting', 'UserController@setting')->name('user.setting')->middleware('auth');

});

Route::resource('comments', 'Admin\CommentsController')->middleware('auth')->only([
    'store', 'update', 'destroy'
]);

Route::resource('asks', 'AskController')->only([
    'index', 'update', 'destroy', 'store', 'create', 'show'
]);


Route::group(['prefix' => 'api'], function (){
    Route::group(['prefix' => 'comments'], function () {
        Route::post('/{id}', 'ApiController@getComments'); // Получает комменты по id поста
        Route::post('/one-comment/{id}', 'ApiController@getOneComment');
        Route::get('/live', 'ApiController@liveComments');
    });

    Route::group(['prefix' => 'answers'], function () {
        Route::post('/{id}', 'AnswerController@getComments'); // Получает комменты по id поста
    });

    Route::group(['prefix' => 'notification'], function (){
        Route::get('/', 'ApiController@notifications')->middleware('auth');
    });

    Route::get('/current-user', 'ApiController@currentUser')->middleware('auth');
    Route::get('/like/{id}', 'ApiController@like')->middleware('auth');
    Route::get('/disslike/{id}', 'ApiController@disslike')->middleware('auth');
});
Route::post('answers', 'AnswerController@addComment'); // Получает комменты по id поста
Route::get('logout', 'HomeController@logout')->middleware('auth')->name('logout');

Route::get('/top-comment', function(){
    return view('index');
});

Route::get('/notifications', function(){
    return view('index');
});

Route::get('/test-n', 'HomeController@test');

Route::get('/login/vk', 'Auth\SocialLoginController@vk');
Route::get('/social/vk', function(){
    return Socialite::with('vkontakte')->redirect();
});
