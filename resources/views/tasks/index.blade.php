@extends('common.app')

@section('content')

    <!-- ここから新規構造。 -->

    <div class="main-area">
        <!-- サイドパネル。 -->
        <aside id="left-panel" class="open">
            <h2>計画作成</h2>
            {!! Form::model($task, ['route' => 'tasks.store'], ['class' => 'form']) !!}
                <!-- 第二引数をurlにしてもOK。['url' => '/tasks']。 -->

                {!! Form::label('title', 'テーマ', ['class' => 'form-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-input title-input', "placeholder" => "20字以内・未入力不可"]) !!}
                {{-- @if ($errors->first('title'))
                     <!-- <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p> -->
                     <!-- <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>字数制限と未入力にご注意下さい。</p> -->
                @endif --}}

                {!! Form::label('start', '開始日', ['class' => 'form-label']) !!}
                {!! Form::date('start', \Carbon\Carbon::now(), ['class' => 'form-input start-input']) !!}
                <!-- {!! Form::text('start', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                <!-- @if ($errors->first('start'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                @endif -->

                {!! Form::label('end', '完了日', ['class' => 'form-label']) !!}
                {!! Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-input end-input']) !!}
                <!-- {!! Form::text('end', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                <!-- @if ($errors->first('end'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                @endif -->

                {!! Form::label('content', '概要', ['class' => 'form-label']) !!}
                {!! Form::textarea('content', null, ['class' => 'form-input textarea-input', "placeholder" => "255字以内・未入力不可"]) !!}
                <!-- @if ($errors->first('content'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                @endif -->

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
                <p class="error-message" id="non-keyword-error"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('keyword') }}</p>
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
                        <!-- モーダルウインドウ部分その１。 -->
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
                        <!-- モーダルウインドウ部分その２。 -->
                        <tr id="subModalWindow" class="hidden">
                            <td>
                                <!-- 計画更新。 -->

                                {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put'], ['class' => 'form']) !!}

                                    {!! Form::label('title', 'テーマ', ['class' => 'form-label']) !!}
                                    {!! Form::text('title', null, ['class' => 'form-input title-input', "placeholder" => "20字以内・未入力不可", 'id' => 'title-input']) !!}
                                    <!-- @if ($errors->first('title'))
                                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p>
                                    @endif -->

                                    {!! Form::label('start', '開始日', ['class' => 'form-label']) !!}
                                    <!-- Carbonライブラリを活用していても他と同じく第二引数にnullを指定すればLaravelCollectiveライブラリの仕様により自動的にデータベース上の開始日の値が入った状態で表示出来る。 -->
                                    {!! Form::date('start',  null, ['class' => 'form-input start-input']) !!}
                                    <!-- @if ($errors->first('start'))
                                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                                    @endif -->

                                    {!! Form::label('end', '完了日', ['class' => 'form-label']) !!}
                                    <!-- Carbonライブラリを活用していても他と同じく第二引数にnullを指定すればLaravelCollectiveライブラリの仕様により自動的にデータベース上の完了日の値が入った状態で表示出来る。 -->
                                    {!! Form::date('end', null, ['class' => 'form-input end-input']) !!}
                                    <!-- @if ($errors->first('end'))
                                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                                    @endif -->

                                    {!! Form::label('content', '概要', ['class' => 'form-label']) !!}
                                    {!! Form::textarea('content', null, ['class' => 'form-input textarea-input', "placeholder" => "255字以内・未入力不可", 'id' => 'textarea-input']) !!}
                                    <!-- @if ($errors->first('content'))
                                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                                    @endif -->

                                    <!-- {!! Form::submit('更新する', ['class' => 'form-btn'])!!} -->
                                    <button type="submit" id="update-button"><i class="fa-solid fa-file-pen"></i>更新する</button>

                                {!! Form::close() !!}

                                <button id="task-delete-decoying"><i class="fa-regular fa-circle-stop"></i>中断する</button>

                                <button id="return-button"><i class="fa-solid fa-rotate-left"></i>戻る</button>

                                {{-- ユーザーが視認できない本命の削除ボタン。 --}}
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" id="task-delete-form">
                                        <button type="submit" id="task-delete">削除</button>
                                        @method('DELETE')
                                        @csrf
                                </form>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td class="FirstAid"><button><a href="#" class="parent-balloon"><i class="fa-solid fa-pencil"></i><span class="balloon">編集する</span></a></button></td>
                            <!-- 「完了する」アイコン（ダミー）。 -->
                            <td id="modalWindowOpen" class="parent-balloon">
                                <i class="fa-solid fa-circle-check"></i><span class="balloon">完了する</span>
                            </td>
                            <td>{{ $task->title }}</td>
                            {{-- 計画の開始日と完了日の表示を変更するため。例）2022-11-28 → 11/28。 --}}
                            @php
                                // 開始日の西暦と西暦右隣の「-」を削除し、「-」と「/」の入れ替えを行っている。
                                $start = str_replace( "-", "/", substr($task->start, 5));
                                // 完了日も上記と同じ処理を行っている。
                                $end = str_replace( "-", "/", substr($task->end, 5));
                            @endphp
                            {{-- 加工済みの開始日を表示している。 --}}
                            <td>開始:{{ $start }}</td>
                            {{-- 加工済みの完了日を表示している。 --}}
                            <td>完了:{{ $end }}</td>
                            <!-- アイコンをクリックすると計画概要がアコーディオンメニュー形式で表示される。 -->
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

    <!-- サイドパネルボタン（サブ）。 -->
    <div id="sub-left-panel-button"><i class="fa-solid fa-chevron-right"></i></div>

    <!-- 全アコーディオンを開閉するボタン -->
    <div id="AllplanDetailButton"><i class="fa-solid fa-unlock" id="AllplanDetailButtonChild"></i></div>

    <!-- ページトップへ遷移するボタン。 -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- 「正常に動作しました」メッセージ。 -->
    @if (session()->has('ok'))
        <div id="success-msg"><i class="fa-regular fa-circle-check" id="success-msg-icon"></i><br><br>Good job!<br>{{ session()->get('ok') }}</div>
    @endif

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection
