@extends('common.app')

@section('content')

    <div class="main-top">
        <img src="{{ asset('img/gorimepresetV8_TP_V.jpg') }}" alt="">
        <div class="title-area">
            <h2 class="main-title">Plan management streamlines your work.</h2>
            <h3 class="main-sub-title">効率化を目指したい。</h3>
        </div>
        @if ($target === NULL)
            <a href="{{ route('tasks.createTarget') }}"><i class="fa-solid fa-circle-plus"></i>新規設定</a>
        @else
            <p>{{ $target->target }}</p>
            <a href="{{ route('tasks.editTarget') }}"><i class="fa-solid fa-pencil"></i></a>
        @endif
    </div>

    <div class="flex">
        <section class="content">
            <h2 class="content-title">計画一覧</h2>
            @if ($errors->first('keyword'))
                <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('keyword') }}</p>
            @endif
            <form action="{{ route('tasks.search') }}" method='get'>
                <!-- {{ csrf_field()}} -->
                @csrf
                <!-- {{method_field('get')}} -->
                <label>絞り込み:</label>
                <input type="text" placeholder="キーワードを入力して検索。" name="keyword">
                <button type="submit"><i class="fa-solid fa-magnifying-glass-plus"></i>検索</button>
            </form>
            <!-- {!! link_to_route('tasks.trace', '履歴を見る', []) !!} -->
            <a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴を見る</a>
            <a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-list"></i>中断計画を見る</a>

            <p>全{{ $tasks_num }}件</p>

            @if (count($tasks) > 0)
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
                        @foreach ($tasks as $task)
                        <tr>
                            <!-- <td>{!! link_to_route('tasks.edit', '🖌', ['task' => $task->id], ['class' => 'pencil']) !!}</td> -->
                            <td><a href="{{ route('tasks.edit', $task->id) }}" class="parent-balloon"><i class="fa-solid fa-pencil"></i><span class="balloon">編集する</span></a></td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->start }}</td>
                            <td>{{ $task->end }}</td>
                            <td>{{ $task->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
            @else
                <p class="alt">ここに作成した計画が表示されます。</p>
            @endif
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