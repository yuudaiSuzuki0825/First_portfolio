@extends('common.app')

@section('content')

    <!-- @if (count($errors) > 0) -->
        <!-- @foreach ($errors->all() as $error) -->
            <!-- <p class="error-message">{{ $error }}</p> -->
        <!-- @endforeach -->
    <!-- @endif -->

    <div class="flex">

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
                @endif

                <!-- {!! Form::submit('更新する', ['class' => 'form-btn'])!!} -->
                <button type="submit"><i class="fa-solid fa-file-pen"></i>更新する</button>

                <!-- インラインブロックレベル要素に変える必要がある。 -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                @method('DELETE')
                @csrf
                </form>

                <a href="{{ route('tasks.breakScreen', $task->id) }}"><i class="fa-solid fa-ban"></i>計画を中断する</a>


            </form>

            {!! Form::close() !!}

            <!-- {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete'], ['class' => 'delete'])!!} -->
                <!-- {!! Form::submit('完了する', ['class' => 'delete-btn']) !!} -->
            <!-- {!! Form::close() !!} -->

            <!-- <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                <button type="submit"><i class="fa-solid fa-circle-check"></i>完了する</button>
                @method('DELETE')
                @csrf
            </form> -->

            <!-- <a href="{{ route('tasks.breakScreen', $task->id) }}"><i class="fa-solid fa-ban"></i>計画を中断する</a> -->
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