@extends('common.app')

@section('content')

    <!-- <div class="main-top">
        <img src="{{ asset('img/gorimepresetV8_TP_V.jpg') }}" alt=""> -->
        <!-- <div class="title-area">
            <h2 class="main-title">Plan management streamlines your work.</h2>
            <h3 class="main-sub-title">効率化を目指したい。</h3>
        </div>
        @if ($target === NULL)
            <a href="{{ route('tasks.createTarget') }}"><i class="fa-solid fa-circle-plus"></i>新規設定</a>
        @else
            <p>{{ $target->target }}</p>
            <a href="{{ route('tasks.editTarget') }}"><i class="fa-solid fa-pencil"></i></a>
        @endif
    </div> -->

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
                    <label>絞り込み:</label>
                    <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i>検索</button>
                </form>

            <!-- 「検索」機能ここまで。 -->

            <!-- 「計画一覧」の表示ここから。 -->

            @if (count($tasks) > 0)
                <table class="table">
                    <!-- theadは無くす予定。 -->
                    <!-- <thead>
                        <tr>
                            <th></th>
                            <th>テーマ</th>
                            <th>開始日</th>
                            <th>完了日</th>
                            <th>概要</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        @foreach ($tasks as $task)
                        <!-- モーダルウインドウ部分。 -->
                        <tr id="modalWindow" class="hidden">
                            <!-- trの中に子要素として何か挿入したい場合はtdを挟むこと。試しにtdを除いてformタグがどの位置に移動するか確認してみて。 -->
                            <td>
                                <!-- ここに本命の「完了する」ボタンを設置。 -->
                                <form action="{{ route('tasks.suspend', $task->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td class="FirstAid"><a href="{{ route('tasks.edit', $task->id) }}" class="parent-balloon"><i class="fa-solid fa-pencil"></i><span class="balloon">編集する</span></a></td>
                            <!-- お試し。ここに「完了する」アイコン（ダミー）を設置する予定。 -->
                            <td id="modalWindowOpen">
                                <!-- <form action="{{ route('tasks.suspend', $task->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                                    @method('DELETE')
                                    @csrf
                                </form> -->
                                <i class="fa-solid fa-circle-check"></i>完了する
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>開始日:{{ $task->start }}</td>
                            <td>完了日:{{ $task->end }}</td>
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i><span class="balloon">開く</span></td>
                        </tr>
                        <!-- 計画の概要。アコーディオンメニューのように表示させる。 -->
                        <tr id="planDetailRow">
                            <td>{{ $task->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ページネーション。コントローラーのpaginate()とセット。 -->
                {{ $tasks->links() }}
            @else
                <p class="alt">ここに作成した計画が表示されます。</p>
            @endif
            </div>
        </section>

        <!-- 「計画一覧」表示ここまで。 -->

        <!-- <aside class="sidebar" id="usage">
            <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。計画の削除もそのページから行えます。</dd>
                    <dt>完了数</dt>
                    <dd>{{ $count }}</dd>
                </dl>
            </div>
        </aside> -->
    </div>

    <!-- ページトップへ遷移するボタン。 -->
    <!-- <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a> -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection