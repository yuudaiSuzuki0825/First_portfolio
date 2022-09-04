<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; // 記述方法に注意。

use App\History; // 記述方法に注意。

use App\Suspension; // 記述方法に注意。

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
        $tasks = $query->orderBy('end', 'asc')->paginate(10);

        // tasksテーブルの全レコード数を取得。
        $tasks_num = $query->count();

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // index.blade.phpへ遷移。その際，$tasksを渡している。
        return view('tasks.index', compact('tasks','tasks_num','count'));
    }

    public function search(Request $request)
    {
        // バリデーション。
        $request->validate([
            'title' => 'required',
        ]);

        // ユーザーが入力した値の取得。
        $keyword_title = $request->title;

        // ユーザーが入力した値を活用してレコードの絞り込みを行い，完了日を基準に昇順に並び替えた該当レコード群を取得。
        $query = Task::query();
        $tasks = $query->where('title', 'like', '%'.self::escapeLike($keyword_title) .'%')->orderBy('end', 'asc')->get();

        return view('tasks.search', compact('tasks'));
    }

    // searchアクションで使用。
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

        // 完了したTasksテーブルの該当レコードをhistoriesテーブルのレコードとして保存（移動）。
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

    public function trace()
    {
        // クエリ。
        $query = History::query();
        // 完了日を基準に昇順にレコードを並べ替え，10件取得。
        $histories = $query->orderBy('end', 'asc')->paginate(10);
        // historiesテーブルの全レコードをカウント。
        $count = $query->count();
        // viewに渡す。
        return view('tasks.trace', [
            'histories' => $histories,
            'count' => $count,
        ]);
    }

    public function traceDestroy($id)
    {
        // クエリ。
        $query = History::query();
        // パラメータから受け取ったidを活用して該当するレコードを取得。
        $history = $query->find($id);
        // 該当レコードの削除。
        $history->delete();
        // リダイレクト。
        return redirect('tasks/trace');
    }

    public function breakScreen($id)
    {
        $task = Task::find($id);
        return view('tasks.suspend', [
            'task' => $task,
        ]);
    }

    public function suspend($id)
    {
        $query = Task::query();
        $task = $query->find($id);
        $suspension = new Suspension;
        $suspension->title = $task->title;
        $suspension->start = $task->start;
        $suspension->end = $task->end;
        $suspension->content = $task->content;
        $suspension->save();
        $task->delete();
        return redirect('/');
    }

    public function suspensionList()
    {
        $query = Suspension::query();
        $suspensions = $query->orderBy('end', 'asc')->paginate(10);
        $suspensions_num = $query->count();
        return view('tasks.suspendList', [
            'suspensions' => $suspensions,
            'suspensions_num' => $suspensions_num,
        ]);
    }

    public function suspensionDetail($id)
    {
        $query = Suspension::query();
        $suspension = $query->find($id);
        return view('tasks.suspensionDetail', [
            'suspension' => $suspension,
        ]);
    }

    public function replay($id)
    {
        $query = Suspension::query();
        $suspension = $query->find($id);
        $task = new Task;
        $task->title = $suspension->title;
        $task->start = $suspension->start;
        $task->end = $suspension->end;
        $task->content = $suspension->content;
        $task->save();
        $suspension->delete();
        return redirect('/');
    }

    public function eraseScreen($id)
    {
        $query = Suspension::query();
        $suspension = $query->find($id);
        return view('tasks.erase', [
            'suspension' => $suspension,
        ]);
    }

    public function completeErase($id)
    {
        $query = Suspension::query();
        $suspension = $query->find($id);
        $suspension->delete();
        return redirect('tasks/suspendList');
    }
}
