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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posted-chits', 'HomeController@getPostedChits')->name('post.list');
Route::post('/post/store', 'HomeController@postStore')->name('post.store');
Route::get('/follow-users/{followId?}', 'HomeController@followUsers')->name('followusers.list');
