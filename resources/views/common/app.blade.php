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
</head>
<body>
    <header class="header">
        <h1 class="header-title"><a href="/">TaskManagement</a></h1>
        <button class="toggle-menu-button"><img src="{{ asset('img/sozai_cman_jp_20220822223728.png') }}" alt=""></button>
        <div class="header-site-menu">
            <ul>
                <li>{!! link_to_route('tasks.create', 'Make', [])!!}</li>
                <li><a href="#usage">Usage</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class="wrapper">
            @yield('content')
        </div>
    </main>

    <footer id="footer">
        <p class="copyright">&copy; 2022 TaskManagement</p>
    </footer>

    <!-- JQueryのCDN。-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- JavaScriptのパス。 -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>