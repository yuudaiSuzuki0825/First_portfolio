<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; // 記述方法に注意。

use App\History; // 記述方法に注意。

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全レコードを取得。
        // $tasks = Task::paginate(10);
        $query = Task::query();
        $tasks = $query->paginate(10);

        // Historiesテーブルのレコード数を取得。
        $count = History::count();

        // index.blade.phpへ遷移。その際，$tasksを渡している。
        return view('tasks.index', compact('tasks', 'count'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $keyword_title = $request->title;

        $query = Task::query();
        $tasks = $query->where('title', 'like', '%'.self::escapeLike($keyword_title) .'%')->get();

        return view('tasks.search', compact('tasks'));
    }

    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
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
        // バリデーション
        $request->validate([
            'title' => 'required|max:20',
            'start' => 'required|max:15',
            'end' => 'required|max:15',
            'content' => 'required|max:255',
        ]);

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
        // バリデーション
        $request->validate([
            'title' => 'required|max:20',
            'start' => 'required|max:15',
            'end' => 'required|max:15',
            'content' => 'required|max:255',
        ]);

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

        $history = new History;

        $history->title = $task->title;
        $history->start = $task->start;
        $history->end = $task->end;
        $history->content = $task->content;
        $history->save();

        // タスクを削除。
        $task->delete();

        // リダイレクト。
        return redirect('/');
    }
}
