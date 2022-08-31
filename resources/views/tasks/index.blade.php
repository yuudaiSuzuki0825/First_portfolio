@extends('common.app')

@section('content')

    <div class="main-top">
        <img src="{{ asset('img/gorimepresetV8_TP_V.jpg') }}" alt="">
        <div class="title-area">
            <h2 class="main-title">Plan management streamlines your work.</h2>
            <h3 class="main-sub-title">効率化を目指したい。</h3>
        </div>
    </div>

    <div class="flex">
        <section class="content">
            <h2 class="content-title">計画一覧</h2>
            <form action="{{ route('tasks.search') }}" method='get'>
                <!-- {{ csrf_field()}} -->
                @csrf
                <!-- {{method_field('get')}} -->
                <label>テーマ:</label>
                <input type="text" placeholder="テーマを入力して検索。" name="title">
                <button type="submit">検索</button>
            </form>

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
                            <td>{!! link_to_route('tasks.edit', '🖌', ['task' => $task->id], ['class' => 'pencil']) !!}</td>
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