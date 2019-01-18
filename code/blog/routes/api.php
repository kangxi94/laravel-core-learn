<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/topics', '\App\Api\Controllers\TopicController@index');

Route::middleware('auth:api')->group(function($router) {
    // 点赞
    $router->get('/post/is-zan/{zan_post}','\App\Api\Controllers\PostController@isZan');
    $router->get('/post/zan-or-cancel/{zan_post}','\App\Api\Controllers\PostController@zanOrCancel');

    // 关注用户
    $router->get('/user/is-follow/{follow_user}','\App\Api\Controllers\UserController@isFollow');
    $router->get('/user/follow-or-cancel/{follow_user}','\App\Api\Controllers\UserController@followOrCancel');

    // 文章评论
    Route::post('/post/{post}/comment','\App\Api\Controllers\PostController@comment');

});

