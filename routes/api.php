<?php

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//DB::listen(function($query) {
//    var_dump($query->sql, $query->bindings);
//});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/upload-image", function (Request $req) {
    $file = $req->file('image')->store('uploads', 'public');

    return response()->json([
        'success' => 1,
        'file' => ["url" => '/storage/'.$file],
    ], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
});

Route::group(['prefix' => 'post'], function () {
    Route::get('/{type}', 'ApiController@getPost');
});

Route::group(['prefix' => 'asks'], function () {
    Route::get('/{type}', 'AskController@getAsk');
});


Route::post('/day-comment', 'ApiController@topComment');

Route::get('/clear', 'HomeController@clear');


