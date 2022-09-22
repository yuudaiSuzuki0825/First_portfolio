@extends('common.app')

@section('content')
    <div class="flex">

    <section class="content">
        <h2 class="content-title">目標編集</h2>

        {!! Form::model($target, ['route' => 'tasks.updateTarget'], ['class' => 'form']) !!}
        <!-- 第二引数をurlにしてもOK。['url' => '/tasks']。 -->

        {!! Form::label('target', '目標:', ['class' => 'form-label']) !!}
        {!! Form::text('target', null, ['class' => 'form-input', "placeholder" => "255字以内"]) !!}
        @if ($errors->first('target'))
            <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('target') }}</p>
        @endif

        <!-- {!! Form::submit('作成する', ['class' => 'form-btn']) !!} -->
        <button type="submit"><i class="fa-solid fa-file-pen"></i>更新する</button>

        {!! Form::close() !!}

        <a href="{{ route('tasks.index') }}">戻る</a>
    </section>

    <aside class="sidebar" id="usage">
    <div class="usage-area">
            <dl>
                <dt>Usage</dt>
                <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。</dd>
                <dt>完了数</dt>
                <dd>{{ $count }}</dd>
            </dl>
        </div>
    </aside>
    </div>

@endsection