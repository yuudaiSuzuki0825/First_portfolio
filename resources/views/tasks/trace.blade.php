@extends('common.app')

@section('content')
<div class="flex">
        <section class="content">
            <h2 class="content-title">完了履歴一覧</h2>

            @if (count($histories) > 0)
                @if ($errors->first('keyword'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('keyword') }}</p>
                @endif
                <form action="{{ route('tasks.searchHistory') }}" method='get'>
                    <!-- {{ csrf_field()}} -->
                    @csrf
                    <!-- {{method_field('get')}} -->
                    <label>絞り込み:</label>
                    <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i>検索</button>
                </form>

                <p>全{{ $count }}件</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>テーマ</th>
                            <th>開始日</th>
                            <th>完了日</th>
                            <th>概要</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                        <tr>
                            <td>
                            <!-- {!! Form::model($history, ['route' => ['tasks.traceDestroy', $history->id], 'method' => 'delete'])!!} -->
                                <!-- {!! Form::submit('削除する') !!} -->
                            <!-- {!! Form::close() !!} -->
                            <!-- <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST"> -->
                                <!-- <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button> -->
                                <!-- @method('DELETE') -->
                                <!-- @csrf -->
                            <!-- </form> -->
                            <a href="{{ route('tasks.goToEraseScreen', $history->id) }}"><i class="fa-solid fa-trash-can"></i>削除する</a>
                            </td>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->start }}</td>
                            <td>{{ $history->end }}</td>
                            <td>{{ $history->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $histories->links() }}
            @else
                <p class="alt">完了した計画はありません。</p>
            @endif

            <a href="{{ route('tasks.index') }}">戻る</a>
        </section>

        <aside class="sidebar" id="usage">
            <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。計画の削除もそのページから行えます。</dd>
                    <dt>完了数</dt>
                    <dd>{{ $count }}</dd>
                </dl>
            </div>
            <!-- <div class="make-btn">{!! link_to_route('tasks.create', 'make', [])!!}</div> -->
        </aside>
    </div>

    <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a>
@endsection