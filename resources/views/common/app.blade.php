<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManagement</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="header-title">TaskManagement</h1>
        <div class="header-site-menu">
            <ul>
                <li>Make</li>
                <li>Usage</li>
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
</body>
</html>