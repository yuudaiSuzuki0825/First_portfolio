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

            <div class="content-area">
                <h2>計画更新</h2>

                {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put'], ['class' => 'form']) !!}

                    {!! Form::label('title', 'テーマ:', ['class' => 'form-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-input', "placeholder" => "20字以内"]) !!}
                    @if ($errors->first('title'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p>
                    @endif

                    {!! Form::label('start', '開始日:', ['class' => 'form-label']) !!}
                    <!-- Carbonライブラリを活用していても他と同じく第二引数にnullを指定すればLaravelCollectiveライブラリの仕様により自動的にデータベース上の開始日の値が入った状態で表示出来る。 -->
                    {!! Form::date('start',  null, ['class' => 'form-input']) !!}
                    @if ($errors->first('start'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                    @endif

                    {!! Form::label('end', '完了日:', ['class' => 'form-label']) !!}
                    <!-- Carbonライブラリを活用していても他と同じく第二引数にnullを指定すればLaravelCollectiveライブラリの仕様により自動的にデータベース上の完了日の値が入った状態で表示出来る。 -->
                    {!! Form::date('end', null, ['class' => 'form-input']) !!}
                    @if ($errors->first('end'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                    @endif

                    {!! Form::label('content', '概要:', ['class' => 'form-label']) !!}
                    {!! Form::text('content', null, ['class' => 'form-input', "placeholder" => "255字以内"]) !!}
                    @if ($errors->first('content'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                    @endif

                    <!-- {!! Form::submit('更新する', ['class' => 'form-btn'])!!} -->
                    <button type="submit"><i class="fa-solid fa-file-pen"></i>更新する</button>

                {!! Form::close() !!}

                <!-- ソフトデリート。 -->
                <div id="modalWindow" class="hidden">
                    <p>本当に削除しますか。削除した計画はゴミ箱から閲覧できます。</p>
                    <div>
                        <span id="cancelButton">キャンセル</span>
                        <!-- 「削除する」ボタン（本命）。 -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            <button type="submit">削除</button>
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
                <!-- ソフトデリート（ダミー）。 -->
                <div id="modalWindowOpenButton"><i class="fa-solid fa-trash-can"></i>削除する</div>
            </div>
        </section>

        <!-- 「計画一覧」表示ここまで。 -->
    </div>

    <!-- 全アコーディオンを開閉するボタン -->
    <div id="AllplanDetailButton"><i class="fa-solid fa-unlock" id="AllplanDetailButtonChild"></i></div>

    <!-- ページトップへ遷移するボタン。 -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection