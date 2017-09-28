<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

// 路由规则 如果请求的是斜杠  则调用回调函数
// 则去调用视图中的欢迎页面
//Route::get('/', function () {
//    return view('welcome');
//});
// 调用路由类的get方法
// 如果请求斜杠 则调用xx控制器的home方法
Route::get('/', 'StaticPagesController@home')->name('home');
// 如果请求 /help 则调用 xx控制器的help方法
Route::get('/help', 'StaticPagesController@help')->name('help');
// 如果请求 /help 则调用 xx控制器的help方法
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

// restful API 调用机制
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
// 密码重设 调用控制器 password
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('password.reset');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password.reset');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.edit');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.update');
// 微博相关
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
Route::get('/users/{id}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{id}/followers', 'UsersController@followers')->name('users.followers');
Route::post('/users/followers/{id}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{id}', 'FollowersController@destroy')->name('followers.destroy');
// 微博头条
Route::get('/weibos', 'WeibosController@index')->name('weibos');