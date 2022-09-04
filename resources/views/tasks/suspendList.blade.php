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
            <h2 class="content-title">中断計画一覧</h2>

            <p>全{{ $suspensions_num }}件</p>

            @if (isset($suspensions))
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
                        @foreach ($suspensions as $suspension)
                        <tr>
                            <td><a href="{{ route('tasks.suspensionDetail', $suspension->id) }}">🖋</a></td>
                            <td>{{ $suspension->title }}</td>
                            <td>{{ $suspension->start }}</td>
                            <td>{{ $suspension->end }}</td>
                            <td>{{ $suspension->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $suspensions->links() }}
            @else
                <p class="alt">ここに作成した計画が表示されます。</p>
            @endif
        </section>

        <aside class="sidebar" id="usage">
            <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。計画の削除もそのページから行えます。</dd>
                </dl>
            </div>
        </aside>
    </div>

    <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a>

@endsection