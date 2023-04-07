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
Route::resource('todos', 'TodoController');

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

Route::get('/mycolle', 'MycolleController@index')->name('mycolle');
Route::get('/mycolle/settings', 'SettingsController@list')->name('settings');

// TODO fix
Route::group(['prefix' => '/apis/v1'], function () {
    Route::get('get-mycolle/{mycolle_id?}', 'MycolleApiController@getMycolle');
    Route::post('edit-mycolle/{mycolle_id}', 'MycolleApiController@editMycolle');
    Route::get('search-mycolle/{collection_type}/{search_keywords}', 'MycolleApiController@searchMycolle');
    Route::get('get-mysites/{mysite_id?}', 'MycolleApiController@getMysites');
    Route::post('edit-mysites/{mysite_id}', 'MycolleApiController@editMysites');
    Route::get('search-mysites/{site_type}/{search_keywords}', 'MycolleApiController@searchMysites');
    Route::get('get-mysite-ids/', 'MycolleApiController@getMysiteIds');
    Route::get('get-mysite-contents/{mysite_id?}', 'MycolleApiController@getMysiteContents');
});
