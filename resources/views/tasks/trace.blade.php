@extends('common.app2')

@section('content')
    <!-- ここから新規構造。 -->

    <div class="main-area">
        <!-- サイドパネル。 -->
        <aside id="left-panel" class="open">
            <h2>計画作成</h2>
            {!! Form::model($task, ['route' => 'tasks.store'], ['class' => 'form']) !!}
                <!-- 第二引数をurlにしてもOK。['url' => '/tasks']。 -->

                {!! Form::label('title', 'テーマ', ['class' => 'form-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-input title-input', "placeholder" => "20字以内"]) !!}
                @if ($errors->first('title'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p>
                @endif

                {!! Form::label('start', '開始日', ['class' => 'form-label']) !!}
                {!! Form::date('start', \Carbon\Carbon::now(), ['class' => 'form-input start-input']) !!}
                <!-- {!! Form::text('start', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                @if ($errors->first('start'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                @endif

                {!! Form::label('end', '完了日', ['class' => 'form-label']) !!}
                {!! Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-input end-input']) !!}
                <!-- {!! Form::text('end', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                @if ($errors->first('end'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                @endif

                {!! Form::label('content', '概要', ['class' => 'form-label']) !!}
                {!! Form::textarea('content', null, ['class' => 'form-input textarea-input', "placeholder" => "255字以内"]) !!}
                @if ($errors->first('content'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                @endif

                <!-- {!! Form::submit('作成する', ['class' => 'form-btn']) !!} -->
                <button type="submit" class="create-button"><i class="fa-solid fa-file-circle-plus"></i> 作成する</button>
                <!-- <a href="{{ route('tasks.index') }}">戻る</a> -->

            {!! Form::close() !!}
        </aside>

        <!-- メインコンテンツ。 -->
        <section class="content open">
            <!-- サイドパネルボタン（サイドパネルを開くボタン）。 -->
            <div id="left-panel-button"><i class="fa-solid fa-chevron-right"></i></div>

            <!-- コンテンツエリア。 -->
            <div class="content-area">
                <!-- タブメニュー。タブは「計画一覧」「完了履歴」「中断計画」の3種類。 -->
                <div class="tabMenu">
                    <!-- 「計画一覧」タブ以外はリンクになっており，各タブのリスト一覧へ遷移することが出来る。 -->
                    <!-- spanタグで各リストの全件数を表示させる（バッチ）。 -->
                    <h2 class="planListTitle"><a href="/"><i class="fa-solid fa-list"></i>計画一覧<span class="badge">{{ $tasks_num }}</span></a></h2>
                    <h2 class="planListTitle active"><a><i class="fa-solid fa-clock-rotate-left"></i>完了履歴<span class="badge">{{ $count }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-rectangle-list"></i>中断計画<span class="badge">{{ $suspensions_num }}</span></a></h2>
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
                <form action="{{ route('tasks.searchHistory') }}" method='get'>
                    <!-- {{ csrf_field()}} -->
                    @csrf
                    <!-- {{method_field('get')}} -->
                    <!-- <label>絞り込み:</label> -->
                    <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                    <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                </form>

            <!-- 「検索」機能ここまで。 -->

            <!-- 「完了履歴」の表示ここから。 -->

            @if (count($histories) > 0)
                <table class="table">
                    <tbody>
                        @foreach ($histories as $history)
                        <tr id="modalWindow" class="hidden">
                            <td>
                                <p>本当に削除しますか。この操作は元に戻すことができません。</p>
                                <div>
                                    <span>キャンセル</span>
                                    <!-- 「削除する」アイコン（本命）。 -->
                                    <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST">
                                        <button type="submit">削除</button>
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td></td> <!-- JavaScriptの方で致命的なバグ発生。その対処としてtdの空タグを設置した。 -->
                            <td id="modalWindowOpen" class="parent-balloon">

                                <!-- LaravelCollectiveライブラリを使用した場合。 -->
                                <!-- {!! Form::model($history, ['route' => ['tasks.traceDestroy', $history->id], 'method' => 'delete'])!!}
                                    {!! Form::submit('削除する') !!}
                                {!! Form::close() !!} -->

                                <!-- 「削除する」アイコン（ダミー）。 -->
                                <i class="fa-solid fa-trash-can"></i><span class="balloon">削除する</span>
                            </td>
                            <td>{{ $history->title }}</td>
                            <td>開始日:{{ $history->start }}</td>
                            <td>完了日:{{ $history->end }}</td>
                            <!-- アイコンをクリックすると計画概要がアコーディオンメニュー形式で表示される。 -->
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i></td>
                        </tr>
                        <!-- 計画の概要。アコーディオンメニューのように表示させる。 -->
                        <tr id="planDetailRow">
                            <td>{{ $history->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ページネーション。コントローラーのpaginate()とセット。 -->
                {{ $histories->onEachSide(2)->links() }}
            @else
                <p class="alt">完了した計画はありません。</p>
            @endif
            </div>
        </section>

        <!-- 「完了履歴」表示ここまで。 -->
    </div>

    <!-- サイドパネルボタン（サブ）。 -->
    <div id="sub-left-panel-button"><i class="fa-solid fa-chevron-right"></i></div>

    <!-- 全アコーディオンを開閉するボタン -->
    <div id="AllplanDetailButton"><i class="fa-solid fa-unlock"></i></div>

    <!-- ページトップへ遷移するボタン。 -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection