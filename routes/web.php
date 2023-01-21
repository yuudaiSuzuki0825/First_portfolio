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

/*　メソッドとURIが全く一緒のルーティングを複数作ってはいけない。URIを変更したりputからpatchに変えるなどの工夫を。 */

// 計画一覧の検索機能。検索結果を表示させる。
Route::get('tasks/search', 'TasksController@search')->name('tasks.search');
// 計画一覧を閲覧する。
Route::get('/', 'TasksController@index');
// 通常の計画（Task）に対するCRUDルーティング。showアクションは除いている。ここでのdestroyアクションは論理削除を行っている。
Route::resource('tasks', 'TasksController', ['only' => ['index', 'create', 'edit', 'store', 'update', 'destroy']]);
// 完了履歴を閲覧する。
Route::get('tasks/trace', 'TasksController@trace')->name('tasks.trace');
// 過去の計画完了の履歴を削除する。
Route::delete('tasks/trace/{id}', 'TasksController@traceDestroy')->name('tasks.traceDestroy');
// 完了履歴の検索機能。検索結果を表示させる。
Route::get('tasks/trace/search', 'TasksController@searchHistory')->name('tasks.searchHistory');
// 通常の計画（Task）を完了する。
Route::delete('tasks/{id}/suspend', 'TasksController@suspend')->name('tasks.suspend');
// ソフトデリートされた計画の一覧を閲覧する。
Route::get('tasks/suspendList', 'TasksController@suspensionList')->name('tasks.suspensionList');
// ソフトデリートされた計画を復元する。
Route::patch('tasks/suspendList/{trashed_task}', 'TasksController@replay')->name('tasks.replay');
// ソフトデリートされた計画を物理削除する。
Route::delete('tasks/suspendList/{trashed_task}', 'TasksController@completeErase')->name('tasks.completeErase');