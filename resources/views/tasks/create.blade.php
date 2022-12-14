@extends('common.app')

@section('content')
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
                <h2>計画作成</h2>

                {!! Form::model($task, ['route' => 'tasks.store'], ['class' => 'form']) !!}
                <!-- 第二引数をurlにしてもOK。['url' => '/tasks']。 -->

                    {!! Form::label('title', 'テーマ:', ['class' => 'form-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-input', "placeholder" => "20字以内"]) !!}
                    @if ($errors->first('title'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p>
                    @endif

                    {!! Form::label('start', '開始日:', ['class' => 'form-label']) !!}
                    {!! Form::date('start', \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
                    <!-- {!! Form::text('start', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                    @if ($errors->first('start'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                    @endif

                    {!! Form::label('end', '完了日:', ['class' => 'form-label']) !!}
                    {!! Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
                    <!-- {!! Form::text('end', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                    @if ($errors->first('end'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                    @endif

                    {!! Form::label('content', '概要:', ['class' => 'form-label']) !!}
                    {!! Form::text('content', null, ['class' => 'form-input', "placeholder" => "255字以内"]) !!}
                    @if ($errors->first('content'))
                        <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                    @endif

                    <!-- {!! Form::submit('作成する', ['class' => 'form-btn']) !!} -->
                    <button type="submit"><i class="fa-solid fa-file-circle-plus"></i>作成する</button>
                    <a href="{{ route('tasks.index') }}">戻る</a>

                {!! Form::close() !!}
            </div>
        </section>

        <!-- 「計画一覧」表示ここまで。 -->
    </div>

    <!-- ページトップへ遷移するボタン。 -->
    <!-- <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a> -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

@endsection