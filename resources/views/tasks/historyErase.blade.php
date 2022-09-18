@extends('common.app')

@section('content')
    <p>本当に削除しますか。削除すると，完了数も減少してしまいます。</p>
    <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST">
        <button type="submit">削除する。</button>
        @method('DELETE')
        @csrf
    </form>
@endsection