@extends('common.app')

@section('content')

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <p class="error-message">{{ $error }}</p>
        @endforeach
    @endif

    <div class="flex">

        <section class="content">
            <h2 class="content-title">タスク作成</h2>

            {!! Form::model($task, ['route' => 'tasks.store'], ['class' => 'form']) !!}

            {!! Form::label('title', 'テーマ:', ['class' => 'form-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-input', "placeholder" => "20字以内"]) !!}

            {!! Form::label('start', '開始日:', ['class' => 'form-label']) !!}
            {!! Form::text('start', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!}

            {!! Form::label('end', '完了日:', ['class' => 'form-label']) !!}
            {!! Form::text('end', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!}

            {!! Form::label('content', '内容:', ['class' => 'form-label']) !!}
            {!! Form::text('content', null, ['class' => 'form-input', "placeholder" => "255字以内"]) !!}

            {!! Form::submit('作成', ['class' => 'form-btn'])!!}

            {!! Form::close() !!}
        </section>

        <aside class="sidebar" id="usage">
        <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>idを入力する必要はありません。<br>テーマと開始日，完了日，内容を記述してください。<br>作成した内容に変更がある場合は，変更したいタスクのidをクリックしてタスク修正ページへ移動してください。</dd>
                </dl>
            </div>
        </aside>
    </div>

@endsection