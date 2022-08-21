<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; // 記述方法に注意。

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全レコードの内，25件を取得。
        $tasks = Task::paginate(25);

        // index.blade.phpへ遷移。その際，$tasksを渡している。
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Task（モデルクラス）のインスタンス生成。create.blade.phpのフォームで使用。
        $task = new Task;

        // create.blade.phpへ遷移。その際，$taskを渡している。
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Task（モデルクラス）のインスタンス生成。
        $task = new Task;

        // ユーザーが入力したフォーム内容をレコードとして保存。
        $task->title = $request->title;
        $task->start = $request->start;
        $task->end = $request->end;
        $task->content = $request->content;
        $task->save();

        // リダイレクト。
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // id（主キー）を通じて該当レコードを特定し，取得。
        $task = Task::find($id);

        // edit.blade.phpへ遷移。その際，$taskを渡している。
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // id（主キー）を通じて該当レコードを特定し，取得。
        $task = Task::find($id);

        // タスクを更新。
        $task->title = $request->title;
        $task->start = $request->start;
        $task->end = $request->end;
        $task->content = $request->content;
        $task->save();

        // リダイレクト。
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // id（主キー）を通じて該当レコードを特定し，取得。
        $task = Task::find($id);

        // タスクを削除。
        $task->delete();

        // リダイレクト。
        return redirect('/');
    }
}
