<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup','UsersController@create')->name('signup');
Route::resource('users','UsersController');

Route::get('login','SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::delete('logout','SessionController@destroy')->name('logout');

Route::get('signup/confirm/{token}','UsersController@confirm')->name('confirm');

Route::get('pwd/reset','pwdController@requestForm')->name('pwd.request');
Route::post('pwd/email','pwdController@sendLink')->name('pwd.post');
Route::get('pwd/reset/{token}/{email}','pwdController@resetForm')->name('pwd.reset');
Route::post('pwd/reset','pwdController@reset')->name('pwd.update');

Route::resource('statuses','StatusesController',['only'=>['store','destroy']]);

Route::get('users/{user}/following','UsersController@following')->name('following');
Route::get('users/{user}/fans','UsersController@fans')->name('fans');

Route::post('users/follow/{user}','FollowController@store')->name('follow.store');
Route::delete('users/follow/{user}','FollowController@destroy')->name('follow.destroy');

Route::get('/like/{status}','UserLikeController@store')->name('like');
Route::get('/unlike/{status}','UserLikeController@cancle')->name('unlike');
Route::get('/liked/{status}','UserLikeController@liked')->name('liked');

Route::get('test','StaticPagesController@test');

Route::get('status/{status}','StatusesController@show')->name('detail');

Route::post('status/comment/{status}','commentController@store')->name('comment');
Route::delete('status/comment/{status}','commentController@destroy');
