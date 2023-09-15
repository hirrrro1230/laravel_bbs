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

# Users系の処理を呼び出す用
Route::resource('users', 'UsersController');
# Messages系の処理を呼び出す用
Route::resource('messages', 'MessagesController');
# Messageの削除
Route::delete('/message/{id}', 'MessagesController@destroy')->name('messages.destroy');
# Comments系の処理を呼び出す用
Route::resource('comments', 'CommentsController');
# Commentの削除
Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
