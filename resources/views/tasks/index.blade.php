@extends('common.app')

@section('content')

    <!-- ここから新規構造。 -->

    <div class="main-area">
        <!-- サイドパネル。 -->
        <aside id="left-panel">
            <!-- ここに「目標」を書く。 -->
            <!-- クリックするとモーダルウインドウにて「目標」の設定操作が出来るようにしたい。後日実装予定。 -->
            <i class="fa-solid fa-bullseye"></i>目標
        </aside>

        <!-- メインコンテンツ。 -->
        <section class="content">
            <!-- サイドパネルボタン（サイドパネルを開くボタン）。 -->
            <div id="left-panel-button"><i class="fa-solid fa-chevron-right"></i></div>

            <!-- コンテンツエリア。 -->
            <div class="content-area">
                <!-- タブメニュー。タブは「計画一覧」「完了履歴」「中断計画」の3種類。 -->
                <div class="tabMenu">
                    <!-- 各タブはリンクになっており，各タブのリスト一覧へ遷移することが出来る。 -->
                    <!-- spanタグで各リストの全件数を表示させる（バッチ）。 -->
                    <!-- 「計画一覧」の全件数は{{ $tasks_num }}で表示させている。 -->
                    <h2 class="planListTitle active"><a><i class="fa-solid fa-list"></i>計画一覧<span class="badge">{{ $tasks_num }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴<span class="badge">{{ $count }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-rectangle-list"></i>中断計画<span class="badge">{{ $suspentions_num }}</span></a></h2>
                </div>

            <!-- 「並び替え」機能ここから。-->
                <div class="provisional">ここに「並び替え」を設置する予定。</div>
            <!-- 「並び替え」機能ここまで。 -->

            <!-- 「検索」機能ここから。 -->

            <!-- 「検索」機能のエラーメッセージ。 -->
            @if ($errors->first('keyword'))
                <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('keyword') }}</p>
            @endif

                <!-- 「検索」機能のフォーム。 -->
                <form action="{{ route('tasks.search') }}" method='get'>
                    <!-- {{ csrf_field()}} -->
                    @csrf
                    <!-- {{method_field('get')}} -->
                    <!-- <label>絞り込み:</label> -->
                    <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                    <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                </form>

            <!-- 「検索」機能ここまで。 -->

            <!-- 「計画一覧」の表示ここから。 -->

            @if (count($tasks) > 0)
                <table class="table">
                    <tbody>
                        @foreach ($tasks as $task)
                        <!-- モーダルウインドウ部分。 -->
                        <tr id="modalWindow" class="hidden">
                            <!-- trの中に子要素として何か挿入したい場合はtdを挟むこと。試しにtdを除いてformタグがどの位置に移動するか確認してみて。 -->
                            <td>
                                <p>本当に完了しますか。完了した計画は履歴から閲覧できます。</p>
                                <div>
                                    <span>キャンセル</span>
                                    <!-- ここに本命の「完了する」ボタンを設置。 -->
                                    <form action="{{ route('tasks.suspend', $task->id) }}" method="POST" style="background-color: #00A690;">
                                        <button type="submit">完了</button>
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td class="FirstAid"><a href="{{ route('tasks.edit', $task->id) }}" class="parent-balloon"><i class="fa-solid fa-pencil"></i><span class="balloon">編集する</span></a></td>
                            <!-- お試し。ここに「完了する」アイコン（ダミー）を設置する予定。 -->
                            <td id="modalWindowOpen" class="parent-balloon">
                                <i class="fa-solid fa-circle-check"></i><span class="balloon">完了する</span>
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>開始日:{{ $task->start }}</td>
                            <td>完了日:{{ $task->end }}</td>
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i></td>
                        </tr>
                        <!-- 計画の概要。アコーディオンメニューのように表示させる。 -->
                        <tr id="planDetailRow">
                            <td>{{ $task->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ページネーション。コントローラーのpaginate()とセット。 -->
                <!-- 「https://laravel.com/api/6.x/Illuminate/Pagination/LengthAwarePaginator.html#method_onEachSide」 -->
                {{ $tasks->onEachSide(2)->links() }}
            @else
                <p class="alt">ここに作成した計画が表示されます。</p>
            @endif
            </div>
        </section>

        <!-- 「計画一覧」表示ここまで。 -->
    </div>

    <!-- ページトップへ遷移するボタン。 -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection