@extends('common.app')

@section('content')
    <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST">
        <button type="submit">削除する。</button>
        @method('DELETE')
        @csrf
    </form>
@endsection