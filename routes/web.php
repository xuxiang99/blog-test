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

Route::get('/', 'IndexController@index');
Route::any('search', 'IndexController@index');

Route::group(['middleware' => 'auth', 'prefix' => 'article'], function(){
	Route::get('create', 'ArticleController@create');
	Route::post('image/upload', 'ArticleController@imageUpload');
	Route::post('store', 'ArticleController@store');
	Route::get('{article}/edit', 'ArticleController@edit');
	Route::put('{article}/update', 'ArticleController@update');
	Route::get('{article}/delete', 'ArticleController@delete');
	Route::get('{article}/zan', 'ArticleController@zan');
	Route::get('{article}/unzan', 'ArticleController@unzan');
});

Route::group(['prefix' => 'article'], function() {
	Route::get('{article}', 'ArticleController@detail');
	Route::post('{article}/comment', 'ArticleController@comment');
	Route::get('{year}/{month}', 'ArticleController@time');
});

Route::group(['prefix' => 'tag'], function(){
	Route::get('{tag}', 'TagController@index');
	Route::post('{tag}/submit', 'TagController@submit');
});

Route::get('contact', 'ContactController@index');
Route::post('contact/store', 'ContactController@store');

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function(){
	Route::get('{user}', 'UserController@index');
	Route::post('{user}/fan', 'UserController@fan');
	Route::post('{user}/unfan', 'UserController@unfan');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
