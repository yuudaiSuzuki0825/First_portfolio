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
                    <h2 class="planListTitle"><a href="/"><i class="fa-solid fa-list"></i>計画一覧<span>{{ $tasks_num }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴<span>{{ $count }}</span></a></h2>
                    <h2 class="planListTitle active"><a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-rectangle-list"></i>中断計画<span>{{ $suspensions_num }}</span></a></h2>
                </div>

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
                        <tr>
                            <td><a href="{{ route('tasks.suspensionDetail', $suspension->id) }}"><i class="fa-solid fa-pencil"></i></a></td>
                            <td>{{ $suspension->title }}</td>
                            <td>開始日:{{ $suspension->start }}</td>
                            <td>完了日:{{ $suspension->end }}</td>
                            <!-- アイコンをクリックすると計画概要がアコーディオンメニュー形式で表示される。 -->
                            <!-- <td>{{ $suspension->content }}</td> -->
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i><span class="balloon">開く</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

@endsection