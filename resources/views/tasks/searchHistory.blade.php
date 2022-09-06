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
            <h2 class="content-title">完了履歴一覧</h2>

            @if (count($histories) > 0)
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
                                <form action="{{ route('tasks.traceDestroy', $history->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button>
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->start }}</td>
                            <td>{{ $history->end }}</td>
                            <td>{{ $history->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="alt">完了した計画はありません。</p>
            @endif
        </section>

        <aside class="sidebar" id="usage">
            <div class="usage-area">
                <dl>
                    <dt>Usage</dt>
                    <dd>Makeをクリックして計画作成ページへ移動してください。<br><br>作成した計画に変更がある場合は，変更したい計画のidをクリックして計画修正ページへ移動してください。計画の削除もそのページから行えます。</dd>
                    <dt>完了数</dt>
                    <dt>{{ $count }}</dt>
                </dl>
            </div>
        </aside>
    </div>

    <div class="go-to-top-parent"></div><a href="#" class="go-to-top">トップへ戻る</a>
@endsection