@extends('common.app')

@section('content')

    <!-- 以前作成したもの。消してもOK。 -->
    <!-- @if (count($errors) > 0) -->
        <!-- @foreach ($errors->all() as $error) -->
            <!-- <p class="error-message">{{ $error }}</p> -->
        <!-- @endforeach -->
    <!-- @endif -->

    <!-- <div class="flex">

        <section class="content">
            <h2 class="content-title">計画更新</h2>

            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put'], ['class' => 'form']) !!}

                {!! Form::label('title', 'テーマ:', ['class' => 'form-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-input']) !!}
                @if ($errors->first('title'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p>
                @endif

                {!! Form::label('start', '開始日:', ['class' => 'form-label']) !!}
                {!! Form::date('start',  \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
                @if ($errors->first('start'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                @endif

                {!! Form::label('end', '完了日:', ['class' => 'form-label']) !!}
                {!! Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
                @if ($errors->first('end'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                @endif

                {!! Form::label('content', '概要:', ['class' => 'form-label']) !!}
                {!! Form::text('content', null, ['class' => 'form-input']) !!}
                @if ($errors->first('content'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                @endif -->

                <!-- {!! Form::submit('更新する', ['class' => 'form-btn'])!!} -->
                <!-- <button type="submit"><i class="fa-solid fa-file-pen"></i>更新する</button> -->

                <!-- インラインブロックレベル要素に変える必要がある。 -->
                <!-- <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                @method('DELETE')
                @csrf
                </form>

                <a href="{{ route('tasks.breakScreen', $task->id) }}"><i class="fa-solid fa-ban"></i>計画を中断する</a>

            {!! Form::close() !!} -->

            <!-- {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete'], ['class' => 'delete'])!!} -->
                <!-- {!! Form::submit('完了する', ['class' => 'delete-btn']) !!} -->
            <!-- {!! Form::close() !!} -->

            <!-- <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                @method('DELETE')
                @csrf
            </form> -->

            <!-- <a href="{{ route('tasks.breakScreen', $task->id) }}"><i class="fa-solid fa-ban"></i>計画を中断する</a> -->
        <!-- </section> -->

        <!-- <aside class="sidebar" id="usage">
        <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。</dd>
                </dl>
            </div>
        </aside>
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
                <h2>計画更新</h2>

                {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put'], ['class' => 'form']) !!}

                    {!! Form::label('title', 'テーマ:', ['class' => 'form-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-input']) !!}
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
                    {!! Form::text('content', null, ['class' => 'form-input']) !!}
                    @if ($errors->first('content'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                    @endif

                    <!-- {!! Form::submit('更新する', ['class' => 'form-btn'])!!} -->
                    <button type="submit"><i class="fa-solid fa-file-pen"></i>更新する</button>

                {!! Form::close() !!}

                <!-- 「完了する」はindex.blade.phpに移す。 -->
                <!-- <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                    @method('DELETE')
                    @csrf
                </form> -->

                <!-- 削除予定。代わりにソフトデリート出来るようにする。 -->
                <!-- <a href="{{ route('tasks.breakScreen', $task->id) }}"><i class="fa-solid fa-ban"></i>計画を中断する</a> -->

                <!-- ソフトデリート。 -->
                <div id="modalWindow" class="hidden">
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button>
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
                <!-- ソフトデリート（ダミー）。 -->
                <div id="modalWindowOpenButton"><i class="fa-solid fa-trash-can"></i>削除する</div>
            </div>
        </section>

        <!-- 「計画一覧」表示ここまで。 -->
    </div>

    <!-- ページトップへ遷移するボタン。 -->
    <!-- <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a> -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection