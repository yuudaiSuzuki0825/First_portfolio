@extends('common.app')

@section('content')

    <!-- 以前作成したもの。消してもOK。 -->
    <!-- <div class="main-top">
        <img src="{{ asset('img/gorimepresetV8_TP_V.jpg') }}" alt="">
        <div class="title-area">
            <h2 class="main-title">Plan management streamlines your work.</h2>
            <h3 class="main-sub-title">効率化を目指したい。</h3>
        </div>
    </div>

    <div class="flex">
        <section class="content">
            <h2 class="content-title">中断計画一覧</h2>

            @if (count($suspensions) > 0)
                <p>全{{ $suspensions_num }}件</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>テーマ</th>
                            <th>開始日</th>
                            <th>完了日</th>
                            <th>概要</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suspensions as $suspension)
                        <tr>
                            <td><a href="{{ route('tasks.suspensionDetail', $suspension->id) }}"><i class="fa-solid fa-pencil"></i></a></td>
                            <td>{{ $suspension->title }}</td>
                            <td>{{ $suspension->start }}</td>
                            <td>{{ $suspension->end }}</td>
                            <td>{{ $suspension->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $suspensions->links() }}
            @else
                <p class="alt">中断計画はありません。</p>
            @endif

            <a href="{{ route('tasks.index') }}">戻る</a>
        </section>

        <aside class="sidebar" id="usage">
            <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。計画の削除もそのページから行えます。</dd>
                    <dt>完了数</dt>
                    <dd>{{ $count }}</dd>
                </dl>
            </div>
        </aside>
    </div>

    ページトップへ遷移するボタン。
    <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a> -->

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
                    <h2 class="planListTitle"><a href="/"><i class="fa-solid fa-list"></i>計画一覧<span class="badge">{{ $tasks_num }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴<span class="badge">{{ $count }}</span></a></h2>
                    <h2 class="planListTitle active"><a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-rectangle-list"></i>中断計画<span class="badge">{{ $suspensions_num }}</span></a></h2>
                </div>

            <!-- 「並び替え」機能ここから。-->
                <div class="provisional">ここに「並び替え」を設置する予定。</div>
            <!-- 「並び替え」機能ここまで。 -->

            <!-- 「中断計画」の表示ここから。 -->

            @if (count($suspensions) > 0)
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
                        @foreach ($suspensions as $suspension)
                        <!-- モーダルウインドウ部分。 -->
                        <tr id="modalWindow" class="hidden">
                            <td>
                                <!-- 「完全削除する」ボタン（本命）。 -->
                                <form action="{{ route('tasks.completeErase', $suspension->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <tr class="tr">
                            <!-- ここに「復元する」と「完全削除する」のフォームを設置する予定。tasks.suspensionDetailは廃棄予定。 -->
                            <!-- <td><a href="{{ route('tasks.suspensionDetail', $suspension->id) }}"><i class="fa-solid fa-pencil"></i></a></td> -->
                            <td class="FirstAid">
                                <!-- 「復元する」ボタン。 -->
                                <form action="{{ route('tasks.replay', $suspension->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-play"></i>復元する</button>
                                    @method('patch')
                                    @csrf
                                </form>
                            </td>
                            <!-- 「完全削除する」アイコン（ダミー）。 -->
                            <td id="modalWindowOpen">
                                <!-- <form action="{{ route('tasks.completeErase', $suspension->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button>
                                    @method('delete')
                                    @csrf
                                </form> -->
                                <i class="fa-solid fa-trash-can"></i>削除する
                            </td>
                            <td>{{ $suspension->title }}</td>
                            <td>開始日:{{ $suspension->start }}</td>
                            <td>完了日:{{ $suspension->end }}</td>
                            <!-- アイコンをクリックすると計画概要がアコーディオンメニュー形式で表示される。 -->
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i><span class="balloon">開く</span></td>
                        </tr>
                        <!-- 計画の概要。アコーディオンメニューのように表示させる。 -->
                        <tr id="planDetailRow">
                            <td>{{ $suspension->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ページネーション。コントローラーのpaginate()とセット。 -->
                {{ $suspensions->links() }}
            @else
                <p class="alt">中断した計画はありません。</p>
            @endif
            </div>
        </section>

        <!-- 「中断計画」表示ここまで。 -->
    </div>

    <!-- ページトップへ遷移するボタン。 -->
    <!-- <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a> -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection