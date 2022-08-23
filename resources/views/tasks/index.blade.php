@extends('common.app')

@section('content')

    <div class="main-top">
        <img src="{{ asset('img/gorimepresetV8_TP_V.jpg') }}" alt="">
        <div class="title-area">
            <h2 class="main-title">Task management streamlines your work.</h2>
            <h3 class="main-sub-title">効率化を目指したい。</h3>
        </div>
    </div>

    <div class="flex">
        <section class="content">
            <h2 class="content-title">タスク一覧</h2>

            @if (count($tasks) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>テーマ</th>
                            <th>開始日</th>
                            <th>完了日</th>
                            <th>内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{!! link_to_route('tasks.edit', $task->id, ['task' => $task->id]) !!}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->start }}</td>
                            <td>{{ $task->end }}</td>
                            <td>{{ $task->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="alt">ここに作成したタスクが表示されます。</p>
            @endif
        </section>

        <aside class="sidebar" id="usage">
            <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>テーマと開始日，完了日，内容を記述してください。<br><br>作成した内容に変更がある場合は，変更したいタスクのidをクリックしてタスク修正ページへ移動してください。タスクの削除もそのページから行えます。</dd>
                </dl>
            </div>
            <!-- <div class="make-btn">{!! link_to_route('tasks.create', 'make', [])!!}</div> -->
        </aside>
    </div>

    <a href="#" class="go-to-top">トップへ戻る</a>

@endsection