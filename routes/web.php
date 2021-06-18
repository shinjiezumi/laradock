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

use App\Jobs\Sample;

Auth::routes();

Route::get('/', static function () {
    return view('top');
})->name('top');

// 掲示板
Route::resource('boards', 'BoardController');
Route::post('/boards/{id}/comments', 'CommentController@store')->name('comments.store');
Route::delete('/boards/{id}/comments/{comment_id}', 'CommentController@destroy')->name('comments.destroy');

// PF
Route::get('/pf', static function () {
    return view('pf/index');
});

// TODOアプリ
Route::get('/todo', 'TodoController@index')->name('todo');
Route::get('/todo/add', 'TodoController@add')->name('add');
Route::post('/todo/add', 'TodoController@post_add');
Route::get('/todo/edit/{id}', 'TodoController@edit')->name('edit');
Route::post('/todo/edit/{id}', 'TodoController@post_edit');
Route::get('/todo/delete/{id}', 'TodoController@delete')->name('delete');
Route::post('/todo/delete/{id}', 'TodoController@post_delete');

// 応用
Route::get('/job', function () {
    $data = 'hoge';
    \Log::debug("dispatch job!!");
    Sample::dispatch($data)->delay(now()->addSeconds(3));
});

Route::get('/event', function () {
    $data = 'fuga';
    \Log::debug("event!!");

    event(new \App\Events\Sample($data));
});


Route::get('/home', 'HomeController@index')->name('home');
