@extends('common.app')

@section('content')


    <!-- @if (count($errors) > 0) -->
        <!-- @foreach ($errors->all() as $error) -->
        <!-- <p class="error-message">{{ $error }}</p> -->
        <!-- @endforeach -->
    <!-- @endif -->

    <div class="flex">

        <section class="content">
            <h2 class="content-title">計画作成</h2>

            {!! Form::model($task, ['route' => 'tasks.store'], ['class' => 'form']) !!}
            <!-- 第二引数をurlにしてもOK。['url' => '/tasks']。 -->

            {!! Form::label('title', 'テーマ:', ['class' => 'form-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-input', "placeholder" => "20字以内"]) !!}
            <p class="error-message">{{ $errors->first('title') }}</p>

            {!! Form::label('start', '開始日:', ['class' => 'form-label']) !!}
            {!! Form::date('start', \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
            <!-- {!! Form::text('start', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
            <p class="error-message">{{ $errors->first('start') }}</p>

            {!! Form::label('end', '完了日:', ['class' => 'form-label']) !!}
            {!! Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-input']) !!}
            <!-- {!! Form::text('end', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
            <p class="error-message">{{ $errors->first('end') }}</p>

            {!! Form::label('content', '概要:', ['class' => 'form-label']) !!}
            {!! Form::text('content', null, ['class' => 'form-input', "placeholder" => "255字以内"]) !!}
            <p class="error-message">{{ $errors->first('content') }}</p>

            {!! Form::submit('作成する', ['class' => 'form-btn']) !!}

            {!! Form::close() !!}
        </section>

        <aside class="sidebar" id="usage">
        <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。</dd>
                </dl>
            </div>
        </aside>
    </div>

@endsection