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

Route::get('/', function () {
    return view('welcome');
});

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
