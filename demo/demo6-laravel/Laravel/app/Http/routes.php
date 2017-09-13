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
