@extends('common.app')

@section('content')
            {!! Form::model($task, ['route' => ['tasks.suspend', $task->id], 'method' => 'delete'])!!}
                {!! Form::submit('中断する') !!}
            {!! Form::close() !!}
@endsection