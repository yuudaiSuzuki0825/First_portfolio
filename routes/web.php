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
// 目標作成画面に遷移する。（未定）
Route::get('tasks/makeTarget', 'TasksController@createTarget')->name('tasks.createTarget');
// 目標を作成する。（未定）
Route::post('tasks/makeTarget', 'TasksController@storeTarget')->name('tasks.storeTarget');
// 目標編集画面に移動する。（未定）
Route::get('tasks/updateTarget', 'TasksController@editTarget')->name('tasks.editTarget');
// 目標を編集する。（未定）
Route::post('tasks/updateTarget', 'TasksController@updateTarget')->name('tasks.updateTarget');
// 過去の計画完了の履歴を閲覧する。
Route::get('tasks/trace', 'TasksController@trace')->name('tasks.trace');
// 過去の計画完了の履歴の絞り込み。
Route::get('tasks/trace/search', 'TasksController@searchHistory')->name('tasks.searchHistory');
// 過去の計画完了を削除する画面に遷移する。（削除予定）
Route::get('tasks/trace/{id}', 'TasksController@goToEraseScreen')->name('tasks.goToEraseScreen');
// 過去の計画完了の履歴を削除する。（修正予定）
Route::delete('tasks/trace/{id}', 'TasksController@traceDestroy')->name('tasks.traceDestroy');
// 計画を中断する画面に遷移する。（削除予定）
Route::get('tasks/{id}/suspend', 'TasksController@breakScreen')->name('tasks.breakScreen');
// 遂行中の計画を完了する。
Route::delete('tasks/{id}/suspend', 'TasksController@suspend')->name('tasks.suspend');
// ソフトデリートされた計画の一覧を閲覧する。
Route::get('tasks/suspendList', 'TasksController@suspensionList')->name('tasks.suspensionList');
// 中断された計画の詳細を閲覧する。（削除予定）
Route::get('tasks/suspendList/{id}', 'TasksController@suspensionDetail')->name('tasks.suspensionDetail');
// ソフトデリートされた計画を復元する。
// Route::delete('tasks/suspendList/{id}', 'TasksController@replay')->name('tasks.replay');
Route::patch('tasks/suspendList/{trashed_task}', 'TasksController@replay')->name('tasks.replay');
// 中断された計画を削除する画面に遷移する。（削除予定）
Route::get('tasks/suspendList/{id}/delete', 'TasksController@eraseScreen')->name('tasks.eraseScreen');
// ソフトデリートされた計画を物理削除する。
Route::delete('tasks/suspendList/{trashed_task}', 'TasksController@completeErase')->name('tasks.completeErase');