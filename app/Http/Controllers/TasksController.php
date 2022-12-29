<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; // 名前空間。左記記述がないとコントローラー内で「App\Task::count();」のようにいちいち「App\」を書かないといけなくなる。

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
        // 全レコードを取得。具体的には完了日が昇順になるようにソートした上でペジネータ―により10件ずつ取得している。
        // paginate()は基本的には第一引数のみでOK。
        $tasks = Task::orderBy('end', 'asc')->paginate(10, ['*'], 'page', null);

        // tasksテーブルの全レコード数を取得。
        $tasks_num = Task::count();

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // ソフトデリート済みのTasksテーブルの全レコードを取得。
        $suspentions_num = Task::onlyTrashed()->count();

        // index.blade.phpへ遷移。その際，$tasksと$tasks_num, $count，$suspentions_numを渡している。
        return view('tasks.index', compact('tasks','tasks_num', 'count', 'suspentions_num'));
    }

    public function search(Request $request)
    {
        // バリデーション。
        $request->validate([
            // inputタグにおけるname属性の属性値である「request（name="request"より…）」に対応しているユーザーの入力値（value属性の属性値）が空かどうかチェックしている。
            // 空であればエラーメッセージを表示させる（index.blade.phpの$errors参照）。
            'keyword' => 'required',
        ]);

        // ユーザーが入力した値の取得。$requestからユーザーが入力した値にアクセスできる。
        // 「$request->keyword」でユーザーが入力欄（inputタグ）に入力した値を取り出し，$keywordに代入している。
        $keyword = $request->keyword;

        // ユーザーが入力した値を活用してレコードの絞り込みを行い，完了日を基準に昇順に並び替えた該当レコード群を10件ずつ取得。
        $tasks = Task::where('title', 'like', '%'.self::escapeLike($keyword) .'%')->orWhere('content', 'like', '%'.self::escapeLike($keyword) .'%')->orderBy('end', 'asc')->paginate(10);

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // Tasksテーブルの全レコード数を取得。
        $tasks_num = Task::count();

        // ソフトデリート済みのTasksテーブルの全レコード数を取得。
        $suspensions_num = Suspension::count();

        // 絞り込んだレコードの総数を取得。現状この値を使ってはない…。
        $tasks_search_count = $tasks->count();

        // search.blade.phpへ遷移。その際，$tasksと$count, $tasks_search_count, $tasks_num, $suspensions_numを渡している。
        return view('tasks.search', compact('tasks', 'count', 'tasks_search_count', 'tasks_num', 'suspensions_num'));
    }

    // 検索機能で使用。詳細については理解不足…（コピペ）。
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
        // create()を使うためにはTaskモデルクラス内で$fillableの指定をする必要がある（Task.php参照）。
        $task->create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'content' => $request->content,
        ]);

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

        // 複数カラムの更新を行っている。fill()はcreate()のように記述する。最後にsave()を付ける事。
        // $task->fill([
        //     'title' => $request->title,
        //     'start' => $request->start,
        //     'end' => $request->end,
        //     'content' => $request->content,
        // ])->save();

        // 実はこれだけで上記の処理が出来てしまう。$requestからall()を呼び出すことで全てのカラム(プロパティ)の値にアクセスしている？
        $task->fill($request->all())->save();

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

        // タスクを削除（ソフトデリート）。
        $task->delete();

        // リダイレクト。
        return redirect('/');
    }

    // 以下のアクションは未定（フォルダ機能）。
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

    // 以下のアクションは未定（フォルダ機能）。
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

    // 以下のアクションは未定（フォルダ機能）。
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

    // 以下のアクションは未定（フォルダ機能）。
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
        // 完了日を基準に昇順にレコードを並べ替え, 10件取得。
        $histories = History::orderBy('end', 'asc')->paginate(10);
        // historiesテーブルの全レコードをカウント。
        $count = History::count();
        // tasksテーブルの全レコードをカウント。
        $tasks_num = Task::count();
        // ソフトデリート済みのTasksテーブルの全レコードをカウント。
        $suspensions_num = Task::onlyTrashed()->count();
        // trace.blade.phpに遷移。その際，$historiesと$count, $tasks_num, $suspensions_numを渡している。
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
            // inputタグにおけるname属性の属性値である「request（name="request"より…）」に対応しているユーザーの入力値（value属性の属性値）が空かどうかチェックしている。
            // 空であればエラーメッセージを表示させる（trace.blade.phpの$errors参照）。
            'keyword' => 'required',
        ]);

        // ユーザーが入力した値の取得。$requestからユーザーが入力した値にアクセスできる。
        // 「$request->keyword」でユーザーが入力欄（inputタグ）に入力した値を取り出し，$keywordに代入している。
        $keyword = $request->keyword;

        // historiesテーブルの全レコードをカウント。
        $count = History::count();
        // Tasksテーブルの全レコードをカウント。
        $tasks_num = Task::count();
        // ソフトデリート済みのTasksテーブルの全レコードをカウント。
        $suspensions_num = Task::onlyTrashed()->count();
        // ユーザーが入力した値を活用してレコードの絞り込みを行い，完了日を基準に昇順に並び替えた該当レコード群を10件ずつ取得。
        $histories = History::where('title', 'like', '%'.self::escapeLike($keyword) .'%')->orWhere('content', 'like', '%'.self::escapeLike($keyword) .'%')->orderBy('end', 'asc')->paginate(10);

        // searchHistory.blade.phpへ遷移。その際，$historiesと$count, $tasks_num, $suspensions_numを渡している。
        return view('tasks.searchHistory', [
            'histories' => $histories,
            'count' => $count,
            'tasks_num' => $tasks_num,
            'suspensions_num' => $suspensions_num
        ]);
    }

    // 削除予定。
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
        // URLパラメータから受け取ったidを活用してHistoriesテーブルから該当レコードを取得。
        $history = History::find($id);
        // 該当レコードの削除。ソフトデリートではない。
        $history->delete();
        // リダイレクト。
        return redirect('tasks/trace');
    }

    // 削除予定。
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

        // Tasksテーブルの該当レコードを元にHistoriesテーブルの新規レコードを作成している。
        $history->create([
            'title' => $task->title,
            'start' => $task->start,
            'end' => $task->end,
            'content' => $task->content,
        ]);

        // タスクを削除。ここまでは論理削除。
        $task->delete();
        // データベースにはまだ残っているので，delete()の後に以下を呼び出す必要がある。
        // 以下を実行することで物理削除を行える。
        $task->forceDelete();

        // リダイレクト。
        return redirect('/');
    }

    public function suspensionList()
    {
        // （追記）
        // このアクションはソフトデリート済みの計画一覧にアクセスするために使用する。

        // ソフトデリート済みのTasksテーブルのレコードを10件ずつ取得。
        $suspensions = Task::onlyTrashed()->orderBy('end', 'asc')->paginate(10);

        // ソフトデリート済みのTasksテーブルの全レコード数を取得。
        $suspensions_num = Task::onlyTrashed()->count();

        // Historiesテーブルの全レコード数を取得。
        $count = History::count();

        // Tasksテーブルの全レコードを取得。こちらはソフトデリートではない方。
        $tasks_num = Task::count();

        // suspendList.blade.phpに遷移。その際，$suspensionsと$suspensions_num, $count, $tasks_numを渡している。
        return view('tasks.suspendList', [
            'suspensions' => $suspensions,
            'suspensions_num' => $suspensions_num,
            'count' => $count,
            'tasks_num' => $tasks_num,
        ]);
    }

    // 削除予定。
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
        // （追記）
        // このアクションはソフトデリート済みのレコードを復元するために使用する。
        // 復元処理。メソッドインジェクションで受け取ったソフトデリート済みのTaskモデルのインスタンスからrestore()を呼び出している。
        $task->restore();

        // ソフトデリート済みのレコード一覧ページへリダイレクト。こちらはgetメソッドにて指定されたURIにアクセスすることを意味している。
        return redirect('tasks/suspendList');
        // もしくは以下の記述でもOK。こちらはルーティングを指定している。
        // return redirect()->route('tasks.suspensionList');
    }

    // 削除予定。
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
        // （追記）
        // このアクションはソフトデリート済みのレコードを物理削除するために使用する。
        // 物理削除処理。メソッドインジェクションで受け取ったソフトデリート済みのTaskモデルのインスタンスからforceDelete()を呼び出している。
        $task->forceDelete();

        // ソフトデリート済みのレコード一覧ページへリダイレクト。
        return redirect()->route('tasks.suspensionList');
        // もしくは以下のように書いてもOK。リダイレクトはgetメソッドになるので後はurlを引数として渡すだけでOK。
        // return redirect('tasks/suspendList');
    }
}
