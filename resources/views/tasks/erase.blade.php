@extends('common.app')

@section('content')
    <p>本当に削除しますか。一度計画を中断して，再度挑戦する選択肢もあります。</p>
    <form action="{{ route('tasks.completeErase', $suspension->id) }}" method="POST">
        <button type="submit">削除する。</button>
        @method('DELETE')
        @csrf
    </form>
@endsection