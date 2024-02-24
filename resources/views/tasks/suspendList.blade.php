@extends('common.app2')

@section('content')
    <!-- ここから新規構造。 -->

    <div class="main-area">
        <!-- サイドパネル。 -->
        <aside id="left-panel" class="open">
            <h2>計画作成</h2>
            {!! Form::model($task, ['route' => 'tasks.store'], ['class' => 'form']) !!}
                <!-- 第二引数をurlにしてもOK。['url' => '/tasks']。 -->

                {!! Form::label('title', 'テーマ', ['class' => 'form-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-input title-input', "placeholder" => "20字以内・未入力不可"]) !!}
                @if ($errors->first('title'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('title') }}</p>
                @endif

                {!! Form::label('start', '開始日', ['class' => 'form-label']) !!}
                {!! Form::date('start', \Carbon\Carbon::now(), ['class' => 'form-input start-input']) !!}
                <!-- {!! Form::text('start', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                @if ($errors->first('start'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('start') }}</p>
                @endif

                {!! Form::label('end', '完了日', ['class' => 'form-label']) !!}
                {!! Form::date('end', \Carbon\Carbon::now(), ['class' => 'form-input end-input']) !!}
                <!-- {!! Form::text('end', null, ['class' => 'form-input', "placeholder" => "15字以内"]) !!} -->
                @if ($errors->first('end'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('end') }}</p>
                @endif

                {!! Form::label('content', '概要', ['class' => 'form-label']) !!}
                {!! Form::textarea('content', null, ['class' => 'form-input textarea-input', "placeholder" => "255字以内・未入力不可"]) !!}
                @if ($errors->first('content'))
                    <p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>{{ $errors->first('content') }}</p>
                @endif

                <!-- {!! Form::submit('作成する', ['class' => 'form-btn']) !!} -->
                <button type="submit" class="create-button"><i class="fa-solid fa-file-circle-plus"></i> 作成する</button>
                <!-- <a href="{{ route('tasks.index') }}">戻る</a> -->

            {!! Form::close() !!}
        </aside>

        <!-- メインコンテンツ。 -->
        <section class="content open">
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
                <div class="provisional">カーソルキーをタイプすることでスムーズな操作が可能です。</div>
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
                            {{-- 計画の開始日と完了日の表示を変更するため。例）2022-11-28 → 11/28。 --}}
                            @php
                                // 開始日の西暦と西暦右隣の「-」を削除し、「-」と「/」の入れ替えを行っている。
                                $start = str_replace( "-", "/", substr($suspension->start, 5));
                                // 完了日も上記と同じ処理を行っている。
                                $end = str_replace( "-", "/", substr($suspension->end, 5));
                            @endphp
                            {{-- 加工済みの開始日を表示している。 --}}
                            <td>開始:{{ $start }}</td>
                            {{-- 加工済みの完了日を表示している。 --}}
                            <td>完了:{{ $end }}</td>
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

    <!-- サイドパネルボタン（サブ）。 -->
    <div id="sub-left-panel-button"><i class="fa-solid fa-chevron-right"></i></div>

    <!-- 全アコーディオンを開閉するボタン -->
    <div id="AllplanDetailButton"><i class="fa-solid fa-unlock"></i></div>

    <!-- ページトップへ遷移するボタン。 -->
    <a href="#" id="to_top"><i class="fa-solid fa-circle-chevron-up"></i></a>

    <!-- マスク部分。モーダルウィンドウで必要。 -->
    <div id="mask" class="hidden"></div>

@endsection
