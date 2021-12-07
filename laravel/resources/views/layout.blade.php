<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('fonts/Montserrat/fonts.css')}}">
    @yield('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
</head>
<body>
<header>
    <nav>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="/"><img src="/img/logo.png" alt="logo" class="menu_img"></a>
                </div>
                <div class="col-md-5">
                    <ul class="menu">
                        <li class="menu_item"><a href="/" class="menu_link">Главная</a></li>
                        <li class="menu_item"><a href="/tests" class="menu_link">Тесты</a></li>
                        <li class="menu_item"><a href="/about" class="menu_link">О сервисе</a></li>
                        <li class="menu_item"><a href="#" class="menu_link">Контакты</a></li>
                    </ul>
                </div>
                <div class="col-md-2 offset-md-2">
                    <div class="menulogin">
                        <div class="menulogin_round"><img src="/icons/user_log.png" alt="" class="menulogin_icon"></div>
                        <a href="#" class="menulogin_link">Войти</a>
                        <a href="#"><img src="icons/down_arrow.png" alt="" class="menulogin_downarrow"></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

@yield('main_content')

</body>
</html>
<script src="{{url('js/main.js')}}"></script>
