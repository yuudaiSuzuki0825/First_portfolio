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

// 検索機能用。検索結果を表示する画面に遷移する。
Route::get('tasks/search', 'TasksController@search')->name('tasks.search');
Route::get('/', 'TasksController@index');
// showアクションを除いている。
// 参考「https://qiita.com/sympe/items/9297f41d5f7a9d91aa11」。
Route::resource('tasks', 'TasksController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy']]);
// 過去の計画完了の履歴を閲覧する。
Route::get('tasks/trace', 'TasksController@trace')->name('tasks.trace');
// 過去の計画完了の履歴を削除する。
Route::delete('tasks/trace/{id}', 'TasksController@traceDestroy')->name('tasks.traceDestroy');