@extends('common.app')

@section('content')
    <!-- ここから新規構造。 -->

    <div class="main-area">
        <!-- サイドパネル。 -->
        <aside id="left-panel">
            <!-- ここに「目標」を書く。 -->
            <!-- クリックするとモーダルウインドウにて「目標」の設定操作が出来るようにしたい。後日実装予定。 -->
            <i class="fa-solid fa-bullseye"></i>目標
        </aside>

        <!-- メインコンテンツ。 -->
        <section class="content">
            <!-- サイドパネルボタン（サイドパネルを開くボタン）。 -->
            <div id="left-panel-button"><i class="fa-solid fa-chevron-right"></i></div>

            <!-- コンテンツエリア。 -->
            <div class="content-area">
                <!-- タブメニュー。タブは「計画一覧」「完了履歴」「中断計画」の3種類。 -->
                <div class="tabMenu">
                    <!-- 各タブはリンクになっており，各タブのリスト一覧へ遷移することが出来る。 -->
                    <!-- spanタグで各リストの全件数を表示させる（バッチ）。 -->
                    <h2 class="planListTitle"><a href="/"><i class="fa-solid fa-list"></i>計画一覧<span class="badge">{{ $tasks_num }}</span></a></h2>
                    <h2 class="planListTitle"><a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴<span class="badge">{{ $count }}</span></a></h2>
                    <h2 class="planListTitle active"><a><i class="fa-solid fa-rectangle-list"></i>中断計画<span class="badge">{{ $suspensions_num }}</span></a></h2>
                </div>

            <!-- 「並び替え」機能ここから。-->
                <div class="provisional">ここに「並び替え」を設置する予定。</div>
            <!-- 「並び替え」機能ここまで。 -->

            <!-- 「中断計画」の表示ここから。 -->

            @if (count($suspensions) > 0)
                <table class="table">
                    <tbody>
                        @foreach ($suspensions as $suspension)
                        <!-- モーダルウインドウ部分。 -->
                        <tr id="modalWindow" class="hidden">
                            <td>
                                <p>本当に削除しますか。この操作は元に戻すことができません。</p>
                                <div>
                                    <span>キャンセル</span>
                                    <!-- 「完全削除する」ボタン（本命）。 -->
                                    <form action="{{ route('tasks.completeErase', $suspension->id) }}" method="POST">
                                        <button type="submit">削除</button>
                                        @method('delete')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td class="FirstAid">
                                <!-- 「復元する」ボタン。 -->
                                <form action="{{ route('tasks.replay', $suspension->id) }}" method="POST">
                                    <button type="submit" class="parent-balloon"><i class="fa-solid fa-trash-can" id="slashIconParent"><i class="fa-solid fa-slash" id="slashIcon"></i></i><span class="balloon">復元する</span></button>
                                    @method('patch')
                                    @csrf
                                </form>
                            </td>
                            <!-- 「完全削除する」アイコン（ダミー）。 -->
                            <!-- <i class="fa-solid fa-play"></i> -->
                            <td id="modalWindowOpen" class="parent-balloon">
                                <!-- <form action="{{ route('tasks.completeErase', $suspension->id) }}" method="POST">
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i>削除する</button>
                                    @method('delete')
                                    @csrf
                                </form> -->
                                <i class="fa-solid fa-trash-can"></i><span class="balloon">削除する</span>
                            </td>
                            <td>{{ $suspension->title }}</td>
                            <td>開始日:{{ $suspension->start }}</td>
                            <td>完了日:{{ $suspension->end }}</td>
                            <!-- アイコンをクリックすると計画概要がアコーディオンメニュー形式で表示される。 -->
                            <td id="planDetailButton" class="parent-balloon"><i class="fa-solid fa-chevron-down"></i></td>
                        </tr>
                        <!-- 計画の概要。アコーディオンメニューのように表示させる。 -->
                        <tr id="planDetailRow">
                            <td>{{ $suspension->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ページネーション。コントローラーのpaginate()とセット。 -->
                {{ $suspensions->onEachSide(2)->links() }}
            @else
                <p class="alt">中断した計画はありません。</p>
            @endif
            </div>
        </section>

        <!-- 「中断計画」表示ここまで。 -->
    </div>

    <!-- 全アコーディオンを開閉するボタン -->
    <div id="AllplanDetailButton"><i class="fa-solid fa-unlock"></i></div>

    <!-- ページトップへ遷移するボタン。 -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection