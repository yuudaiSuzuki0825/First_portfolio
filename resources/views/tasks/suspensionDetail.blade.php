@extends('common.app')

@section('content')

    <div class="flex">
        <section class="content">
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
                    <tr>
                        <td>未定</td>
                        <td>{{ $suspension->title }}</td>
                        <td>{{ $suspension->start }}</td>
                        <td>{{ $suspension->end }}</td>
                        <td>{{ $suspension->content }}</td>
                    </tr>
                </tbody>
            </table>
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