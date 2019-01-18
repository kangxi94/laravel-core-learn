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

// use App\Events\RssCreatedEvent;
// event(new RssCreatedEvent());

use App\Post;

Post::find(1);

Route::get('/', 'IndexController@index');
Route::get('/category/{category}', 'IndexController@index');

// auth
Auth::routes();

Route::get('confirm', 'Auth\ConfirmController@confirm')->name('confirm');
Route::get('send-confirm-mail', 'Auth\ConfirmController@sendMail')->name('send-confirm-mail');

// github 登录
$router->get('github', 'Auth\GithubController@redirectToProvider')->name('github');
$router->get('github/callback', 'Auth\GithubController@handleProviderCallback');

// 极验验证
Route::get('captcha','Auth\GeeCaptchaController@captcha');

Route::prefix('post')->group(function () {
    // 搜索文章
    Route::get('/search', 'PostController@search');
    // 创建文章
    Route::get('/create','PostController@create');
    // 查看文章
    Route::get('/{post}','PostController@show');
    Route::post('/store','PostController@store');
    // 更新文章
    Route::get('/{post}/edit','PostController@edit');
    Route::put('/{post}','PostController@update');
    // 删除文章
    Route::get('/{post}/delete','PostController@delete');

});










