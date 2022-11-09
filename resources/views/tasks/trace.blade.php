@extends('common.app')

@section('content')
    <!-- 以前作成したもの。消してもOK。 -->
    <!-- <div class="flex">
        <section class="content">
            <h2 class="content-title">完了履歴一覧</h2>

            @if (count($histories) > 0)
                @if ($errors->first('keyword'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('keyword') }}</p>
                @endif
                <form action="{{ route('tasks.searchHistory') }}" method='get'> -->
                    <!-- {{ csrf_field()}} -->
                    <!-- @csrf -->
                    <!-- {{method_field('get')}} -->
                    <!-- <label>絞り込み:</label>
                    <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i>検索</button>
                </form>

                <p>全{{ $count }}件</p>

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
                        @foreach ($histories as $history)
                        <tr>
                            <td> -->
                            <!-- {!! Form::model($history, ['route' => ['tasks.traceDestroy', $history->id], 'method' => 'delete'])!!} -->
                                <!-- {!! Form::submit('削除する') !!} -->
                            <!-- {!! Form::close() !!} -->
                            <!-- <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST"> -->
                                <!-- <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button> -->
                                <!-- @method('DELETE') -->
                                <!-- @csrf -->
                            <!-- </form> -->
                            <!-- <a href="{{ route('tasks.goToEraseScreen', $history->id) }}"><i class="fa-solid fa-trash-can"></i>削除する</a>
                            </td>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->start }}</td>
                            <td>{{ $history->end }}</td>
                            <td>{{ $history->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $histories->links() }}
            @else
                <p class="alt">完了した計画はありません。</p>
            @endif

        </section>
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
                    <!-- 「計画一覧」タブ以外はリンクになっており，各タブのリスト一覧へ遷移することが出来る。 -->
                    <!-- spanタグで各リストの全件数を表示させる（バッチ）。 -->
                    <h2 class="planListTitle"><a href="/"><i class="fa-solid fa-list"></i>計画一覧<span class="badge">{{ $tasks_num }}</span></a></h2>
                    <h2 class="planListTitle active"><a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴<span class="badge">{{ $count }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-rectangle-list"></i>中断計画<span class="badge">{{ $suspensions_num }}</span></a></h2>
                </div>

            <!-- 「検索」機能ここから。 -->

            <!-- 「検索」機能のエラーメッセージ。 -->
            @if ($errors->first('keyword'))
                <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('keyword') }}</p>
            @endif

                <!-- 「検索」機能のフォーム。 -->
                <form action="{{ route('tasks.searchHistory') }}" method='get'>
                    <!-- {{ csrf_field()}} -->
                    @csrf
                    <!-- {{method_field('get')}} -->
                    <label>絞り込み:</label>
                    <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i>検索</button>
                </form>

            <!-- 「検索」機能ここまで。 -->

            <!-- 「完了履歴」の表示ここから。 -->

            @if (count($histories) > 0)
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
                        @foreach ($histories as $history)
                        <tr class="tr">
                            <td>
                                <!-- LaravelCollectiveライブラリを使用した場合。 -->
                                <!-- {!! Form::model($history, ['route' => ['tasks.traceDestroy', $history->id], 'method' => 'delete'])!!}
                                    {!! Form::submit('削除する') !!}
                                {!! Form::close() !!} -->

                                <!-- ライブラリを使用しない場合。 -->
                                <!-- <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button>
                                    @method('DELETE')
                                    @csrf
                                </form> -->

                                <!-- モーダルウインドウを実装しない際の代用。 -->
                                <a href="{{ route('tasks.goToEraseScreen', $history->id) }}"><i class="fa-solid fa-trash-can"></i>削除する</a>
                            </td>
                            <td>{{ $history->title }}</td>
                            <td>開始日:{{ $history->start }}</td>
                            <td>完了日:{{ $history->end }}</td>
                            <!-- アイコンをクリックすると計画概要がアコーディオンメニュー形式で表示される。 -->
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i><span class="balloon">開く</span></td>
                        </tr>
                        <!-- 計画の概要。アコーディオンメニューのように表示させる。 -->
                        <tr id="planDetailRow">
                            <td>{{ $history->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $histories->links() }}
            @else
                <p class="alt">完了した計画はありません。</p>
            @endif
            </div>
        </section>

        <!-- 「完了履歴」表示ここまで。 -->
    </div>

    <!-- ページトップへ遷移するボタン。 -->
    <!-- <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a> -->

@endsection