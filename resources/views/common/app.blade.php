<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- レスポンシブ。 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManagement</title>
    <!-- リセットCSS。ress。 -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!-- google fonts。Abril Fatface。-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <!-- CSSのパス。 -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/efd87fdfef.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- ヘッダー。 -->
    <header class="header">
        <!-- ロゴ。 -->
        <h1 class="header-title"><a href="/">Revistart</a></h1>
        <!-- <button class="toggle-menu-button"><img src="{{ asset('img/sozai_cman_jp_20220822223728.png') }}" alt=""></button> -->

        <!-- ナビゲーションリンク。 -->
        <!-- PC用。 -->
        <div class="header-site-menu">
            <!-- ナビゲーションリンク。こちらはアイコンのみ表示。 -->
            <nav>
                <ul>
                    <li><a href="{{ route('tasks.create') }}" class="parent-balloon"><i class="fa-solid fa-circle-plus"><span class="header-balloon">作成する</span></i></a></li>
                    <li><a href="#usage" class="parent-balloon"><i class="fa-regular fa-message"></i><span class="header-balloon second">FAQ</span></a></li>
                    <li><a href="/#planList" class="parent-balloon"><i class="fa-solid fa-list"></i><span class="header-balloon">計画一覧</span></a></li>
                    <li><a href="{{ route('tasks.trace') }}" class="parent-balloon"><i class="fa-solid fa-clock-rotate-left"></i><span class="header-balloon">完了履歴</span></a></li>
                    <li><a href="{{ route('tasks.suspensionList') }}" class="parent-balloon"><i class="fa-solid fa-rectangle-list"></i><span class="header-balloon">中断計画</span></a></li>
                </ul>
            </nav>

            <div class="header-hamburger-menu">
                <span id="open"><i class="fa-solid fa-bars"></i></span>
            </div>
        </div>

        <!-- SP用。 -->
        <!-- モーダルウィンドウでナビゲーションリンクを表示。ハンバーガーメニューをクリックすると表示される。 -->
        <div class="overlay">
            <!-- 「閉じる」ボタン。 -->
            <span id="close"><i class="fa-solid fa-xmark"></i></span>
            <!-- ナビゲーションリンク。こちらはアイコンとテキスト両方表示。 -->
            <nav>
                <ul>
                    <li><a href="{{ route('tasks.create') }}"><i class="fa-solid fa-circle-plus"></i>作成する</a></li>
                    <li><a href="#usage"><i class="fa-regular fa-message"></i>FAQ</a></li>
                    <li><a href="/#planList"><i class="fa-solid fa-list"></i>計画一覧</a></li>
                    <li><a href="{{ route('tasks.trace') }}"><i class="fa-solid fa-clock-rotate-left"></i>完了履歴</a></li>
                    <li><a href="{{ route('tasks.suspensionList') }}"><i class="fa-solid fa-rectangle-list"></i>中断計画</a></li>
                </ul>
            </nav>
        </div>

    </header>

    <!-- メインコンテンツ。 -->
    <main>
        <div class="wrapper">
            @yield('content')
        </div>
    </main>

    <!-- フッター。 -->
    <footer id="footer">
        <p class="copyright">&copy; 2022 Revistart</p>
    </footer>

    <!-- JQueryのCDN。-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- JavaScriptのパス。 -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>