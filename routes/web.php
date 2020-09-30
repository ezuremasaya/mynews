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

// Route::groupでいくつかのrouting設定をgroup化している
// group化したのは、['prefix' => 'admin']の設定を無名関数 function(){} の中の全てのRouting設定に適用させるため
// ['prefix' => 'admin']は、無名関数 function() {} の中の設定のURLを http://XXXXXX.jp/admin/ で始まるものにしている
Route::group(['prefix' => 'admin'], function () {
    // 第一引数：アドレス、第二引数：処理、関数など
    // ルート情報の設定は、getメソッドでアドレスと処理を割り当てるのが基本
    // http://XXXXXX.jp/admin/news/create にアクセスできたら、Admin\NewsControllerのAction addに渡すという設定をしている
    Route::get('news/create', 'Admin\NewsController@add');
});

// admin/profile/createにアクセスしたら、ProfileControllerのAction addに割り当てるよう設定
Route::get('admin/profile/create', 'Admin\ProfileController@add');

// admin/profile/editにアクセスしたら、ProfileContorollerのAction editに割り当てるよう設定
Route::get('admin/profile/edit', 'Admin\ProfileController@edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログインしていない状態で管理画面にアクセスしたとき、ログイン画面にリダイレクトするよう設定
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // GETリクエストの場合はadd Actionを呼び出している
    // 通常のページ表示には「get」を受け取る
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');

    // 以下を追加
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');

    // 以下を課題で追加
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile', 'Admin\ProfileController@index');

    // 以下を追記
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::get('news/delete', 'Admin\NewsController@delete');

    // 以下を課題で追記
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    Route::get('profile/delete', 'Admin\ProfileController@delete');

    // POSTリクエストの場合はcreate Actionを呼び出している
    // フォームを送信した時に受け取るには「post」で指定する
    Route::post('news/create', 'Admin\NewsController@create'); # 追記
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// 以下を追加
Route::get('/', 'NewsController@index');