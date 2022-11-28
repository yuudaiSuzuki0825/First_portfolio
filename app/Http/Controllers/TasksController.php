<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; // 記述方法に注意。

use App\History;

use App\Suspension;

use App\Target;

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

        // ソフトデリート済みのTasksテーブルの全レコードを取得。
        $suspentions_num = $query->onlyTrashed()->count();

        // $query = Target::query();
        // if ($query->count() < 0) {
        //     $target = NULL;
        // } else {
        //     $target = $query->first();
        // }

        // index.blade.phpへ遷移。その際，$tasksと$tasks_num, $countを渡している。
        return view('tasks.index', compact('tasks','tasks_num', 'count', 'suspentions_num'));
    }

    public function search(Request $request)
    {
        // バリデーション。
        $request->validate([
            // inputタグにおけるname属性の属性値（ユーザーが入力した値）が空かどうかチェックしている。
            // 空であればエラーメッセージを表示させる（index.blade.phpの$errors参照）。
            'keyword' => 'required',
        ]);

        // ユーザーが入力した値の取得。$requestからユーザーが入力した値にアクセスできる。
        // 「$request->keyword」でユーザーが入力欄（inputタグ）に入力した値を取り出し，$keywordに代入している。
        $keyword = $request->keyword;

        // ユーザーが入力した値を活用してレコードの絞り込みを行い，完了日を基準に昇順に並び替えた該当レコード群を取得。
        $query = Task::query();
        $tasks = $query->where('title', 'like', '%'.self::escapeLike($keyword) .'%')->orWhere('content', 'like', '%'.self::escapeLike($keyword) .'%')->orderBy('end', 'asc')->get();

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // Tasksテーブルの全レコード数を取得。
        $tasks_num = Task::count();

        // Suspensionsテーブルの全レコード数を取得。
        $suspensions_num = Suspension::count();

        // 絞り込んだレコードの総数を取得。
        $tasks_search_count = $tasks->count();

        return view('tasks.search', compact('tasks', 'count', 'tasks_search_count', 'tasks_num', 'suspensions_num'));
    }

    // 検索機能で使用。
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

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // create.blade.phpへ遷移。その際，$taskを渡している。
        return view('tasks.create', [
            'task' => $task,
            'count' => $count,
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
        $task->create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'content' => $request->content,
        ]);
        // $task->title = $request->title;
        // $task->start = $request->start;
        // $task->end = $request->end;
        // $task->content = $request->content;
        // $task->save();

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
        // ＊createメソッドを使うと，開始日と完了日がデフォルト指定（予め入力されている日付）の状態でそのほかの内容が一致している全く新しいレコードが作成される現象が起こった。create()ではなく，代わりにfill()を使う必要があった。
        // $task->create([
            // 'title' => $request->title,
            // 'start' => $request->start,
            // 'end' => $request->end,
            // 'content' => $request->content,
        // ]);

        $task->fill([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'content' => $request->content,
        ])->save();

        // $task->title = $request->title;
        // $task->start = $request->start;
        // $task->end = $request->end;
        // $task->content = $request->content;
        // $task->save();

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
        // このアクションはソフトデリートするためのもの。

        // id（主キー）を通じて該当レコードを特定し，取得。
        $task = Task::find($id);

        // 完了したTasksテーブルの該当レコードをhistoriesテーブルのレコードとして保存（移動）。
        // $history = new History;
        // $history->title = $task->title;
        // $history->start = $task->start;
        // $history->end = $task->end;
        // $history->content = $task->content;
        // $history->save();

        // タスクを削除。
        $task->delete();

        // リダイレクト。
        return redirect('/');
    }

    public function createTarget()
    {
        $target = new Target;

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        return view('tasks.makeTarget', [
            'target' => $target,
            'count' => $count,
        ]);
    }

    public function storeTarget(Request $request)
    {
        $request->validate([
            'target' => 'required|max:255',
        ]);

        $target = new Target;
        $target->target = $request->target;
        $target->save();
        return redirect('/');
    }

    public function editTarget()
    {
        $target = Target::first();

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        return view('tasks.updateTarget', [
            'target' => $target,
            'count' => $count,
        ]);
    }

    public function updateTarget(Request $request)
    {
        $request->validate([
            'target' => 'required|max:255',
        ]);

        $target = Target::first();
        $target->target = $request->target;
        $target->save();
        return redirect('/');
    }

    public function trace()
    {
        // クエリ。
        $query = History::query();
        // 完了日を基準に昇順にレコードを並べ替え, 10件取得。
        $histories = $query->orderBy('end', 'asc')->paginate(10);
        // historiesテーブルの全レコードをカウント。
        $count = $query->count();
        // tasksテーブルの全レコードをカウント。
        $tasks_num = Task::count();
        // ソフトデリート済みのTasksテーブルの全レコードをカウント。
        $suspensions_num = Task::onlyTrashed()->count();
        // viewに渡す。
        return view('tasks.trace', [
            'histories' => $histories,
            'count' => $count,
            'tasks_num' => $tasks_num,
            'suspensions_num' => $suspensions_num,
        ]);
    }

    public function searchHistory(Request $request)
    {
        // バリデーション。
        $request->validate([
            // inputタグにおけるname属性の属性値（ユーザーが入力した値）が空かどうかチェックしている。
            // 空であればエラーメッセージを表示させる（trace.blade.phpの$errors参照）。
            'keyword' => 'required',
        ]);

        // ユーザーが入力した値の取得。$requestからユーザーが入力した値にアクセスできる。
        // 「$request->keyword」でユーザーが入力欄（inputタグ）に入力した値を取り出し，$keywordに代入している。
        $keyword = $request->keyword;

        // クエリ。
        $query = History::query();
        // historiesテーブルの全レコードをカウント。
        $count = $query->count();
        // Tasksテーブルの全レコードをカウント。
        $tasks_num = Task::count();
        // Suspensionsテーブルの全レコードをカウント。
        $suspensions_num = Suspension::count();
        // ユーザーが入力した値を活用してレコードの絞り込みを行い，完了日を基準に昇順に並び替えた該当レコード群を取得。
        $histories = $query->where('title', 'like', '%'.self::escapeLike($keyword) .'%')->orWhere('content', 'like', '%'.self::escapeLike($keyword) .'%')->orderBy('end', 'asc')->get();

        // 絞り込んだレコードの総数を取得。
        $histories_count = $histories->count();

        return view('tasks.searchHistory', [
            'histories' => $histories,
            'count' => $count,
            'histories_count' => $histories_count,
            'tasks_num' => $tasks_num,
            'suspensions_num' => $suspensions_num,
        ]);
    }

    public function goToEraseScreen($id)
    {
        $query = History::query();
        $history = $query->find($id);
        return view('tasks.historyErase', [
            'history' => $history,
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
        // （追記）
        // このアクションは「完了する」機能のために使用する。後で名称などの変更を済ませておくこと。

        // id（主キー）を通じて該当レコードを特定し，取得。
        $task = Task::find($id);

        // 完了したTasksテーブルの該当レコードをhistoriesテーブルのレコードとして保存（移動）。
        $history = new History;
        $history->title = $task->title;
        $history->start = $task->start;
        $history->end = $task->end;
        $history->content = $task->content;
        $history->save();

        // タスクを削除。ここまでは論理削除。
        $task->delete();
        // データベースにはまだ残っているので，delete()の後に以下を呼び出す必要がある。
        // 以下を実行することで物理削除を行える。
        $task->forceDelete();

        // リダイレクト。
        return redirect('/');

        // 以前までの処理。参考までに。
        // $query = Task::query();
        // $task = $query->find($id);
        // $suspension = new Suspension;
        // $suspension->title = $task->title;
        // $suspension->start = $task->start;
        // $suspension->end = $task->end;
        // $suspension->content = $task->content;
        // $suspension->save();
        // $task->delete();
        return redirect('/');
    }

    public function suspensionList()
    {
        // このアクションはソフトデリート済みの計画一覧にアクセスするために使用する。

        $query = Task::query();
        $suspensions = $query->onlyTrashed()->orderBy('end', 'asc')->paginate(10);
        $suspensions_num = $query->onlyTrashed()->count();

        // 以下6行は以前の処理。参考までに。
        // クエリ。以降$queryと書くと「Suspension::」と同じ意味として機能する？
        // $query = Suspension::query();
        // suspensionsテーブルの全レコードを完了日を基準に昇順ソートした上で，最初の10件を取得し$suspensionsに代入。
        // $suspensions = $query->orderBy('end', 'asc')->paginate(10);
        // suspensionsテーブルの全レコード数を取得。これが中断計画の全件数と対応している。
        // $suspensions_num = $query->count();

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // Tasksテーブルの全レコードを取得。
        $tasks_num = Task::count();

        return view('tasks.suspendList', [
            'suspensions' => $suspensions,
            'suspensions_num' => $suspensions_num,
            'count' => $count,
            'tasks_num' => $tasks_num,
        ]);
    }

    public function suspensionDetail($id)
    {
        // 廃棄予定。

        // 以下3行は以前の処理。参考までに。
        // $query = Suspension::query();
        // $suspension = $query->find($id);
        // $suspensions_num = $query->count();

        $tasks_num = Task::count();
        $count = History::count();
        return view('tasks.suspensionDetail', [
            'suspension' => $suspension,
            'suspensions_num' => $suspensions_num,
            'tasks_num' => $tasks_num,
            'count' => $count,
        ]);
    }

    // 「Task $task」は「Request $request」と同じ仕組み（メソッドインジェクション）。
    // モデルクラスのインスタンスを引数として受け取る時は，依存定義（モデルクラス名，今回はTask）とそのインスタンス変数（今回は$task）を仮引数として記述すること。
    public function replay(Task $task)
    {
        // このアクションはソフトデリート済みのレコードを復元するために使用する。
        // 復元処理。メソッドインジェクションで受け取ったソフトデリート済みのTaskモデルのインスタンスからrestore()を呼び出している。
        $task->restore();

        // 以下9行は以前の処理。参考までに。
        // $query = Suspension::query();
        // $suspension = $query->find($id);
        // $task = new Task;
        // $task->title = $suspension->title;
        // $task->start = $suspension->start;
        // $task->end = $suspension->end;
        // $task->content = $suspension->content;
        // $task->save();
        // $suspension->delete();

        // ソフトデリート済みのレコード一覧ページへリダイレクト。
        return redirect()->route('tasks.suspensionList');
    }

    public function eraseScreen($id)
    {
        $query = Suspension::query();
        $suspension = $query->find($id);
        return view('tasks.erase', [
            'suspension' => $suspension,
        ]);
    }

    // 「Task $task」は「Request $request」と同じ仕組み（メソッドインジェクション）。
    // モデルクラスのインスタンスを引数として受け取る時は，依存定義（モデルクラス名，今回はTask）とそのインスタンス変数（今回は$task）を仮引数として記述すること。
    public function completeErase(Task $task)
    {
        // このアクションはソフトデリート済みのレコードを物理削除するために使用する。
        // 物理削除処理。メソッドインジェクションで受け取ったソフトデリート済みのTaskモデルのインスタンスからforceDelete()を呼び出している。
        $task->forceDelete();

        // 以下4行は以前の処理。参考までに。
        // $query = Suspension::query();
        // $suspension = $query->find($id);
        // $suspension->delete();
        // return redirect('tasks/suspendList');

        // ソフトデリート済みのレコード一覧ページへリダイレクト。
        return redirect()->route('tasks.suspensionList');
    }
}
