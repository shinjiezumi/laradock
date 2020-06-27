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
    return view('welcome');
});

Route::resource('boards', 'BoardController');

/**
 * 基本
 */
Route::get('/basic', 'BasicController@index');

// HTML直書き
Route::get('/basic/route/1', static function(){
    return '<html><body><h1>Hello</h1><p>This is sample page.</p></body></html>';
});

// 引数あり
Route::get('/basic/route/2/{msg}', static function($msg){
    return <<<EOF
	<html>
		<body>
			<p>{$msg}</p>
		</body>
	</html>
EOF;
});

// 引数任意
Route::get('/basic/route/3/{msg?}', static function($msg='no message'){
    return <<<EOF
	<html>
		<body>
			<p>{$msg}</p>
		</body>
	</html>
EOF;
});

// コントローラー利用：引数なし
Route::get('/basic/controller/1', 'BasicController@index1')->name('controller1');

// コントローラー利用：引数あり
Route::get('/basic/controller/2/{name}/{age?}', 'BasicController@index2')->name('controller2');

// コントローラー利用：クエリパラメータあり
Route::get('/basic/controller/3', 'BasicController@index3')->name('controller3');

// Viewテンプレート利用：パラメータ渡しなし
Route::get('/basic/controller/4', 'BasicController@index4')->name('controller4');

// Viewテンプレート利用：Postパラメータ
Route::get('/basic/controller/5', 'BasicController@index5')->name('controller5');
Route::post('/basic/controller/5', 'BasicController@postIndex5');

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
