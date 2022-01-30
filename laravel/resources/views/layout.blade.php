<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SportLife - @yield('title')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @yield('stylesheet')
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="icon" href="/icons/favicon.svg">
</head>
<body>
<header>
    <nav>
        <div class="container">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="row">
                <div class="col-7 col-sm-12 col-md-4 offset-md-0 col-lg-3">
                    <a class="logo_link" href="/"><img src="/img/logo.svg" alt="logo" class="menu_img"></a>
                </div>
                <div class="col-1 col-sm-9 offset-sm-0 col-md-6 offset-md-0 col-lg-6 offset-lg-0">
                    <ul class="menu">
                        <div class="mobile_menulogin">
                            <a href="/user_profile">
                                <div class="mobile_menulogin_round"><img src="/icons/user_log.png" alt="" class="mobile_menulogin_icon"></div>
                            </a>
                            @php if(array_key_exists('login', $_COOKIE)) { @endphp
                            <a href="/exit" class="mobile_menulogin_link">Выйти</a>
                            @php }else{ @endphp
                            <a href="/authorization" class="mobile_menulogin_link">Войти</a>
                            @php }@endphp
                        </div>
                        <li class="menu_item"><a href="/" class="menu_link">Главная</a></li>
                        <li class="menu_item"><a href="/tests" class="menu_link">Тесты</a></li>
                        <li class="menu_item"><a href="/about" class="menu_link">О сервисе</a></li>
                        <li class="menu_item"><a href="/contacts" class="menu_link">Контакты</a></li>
                    </ul>
                </div>
                <div class="col-4 col-sm-2 offset-sm-0 col-md-2 offset-md-0 col-lg-2 offset-lg-1">
                    <div class="menulogin">
                        <a href="/user_profile">
                            <div class="menulogin_round"><img src="/icons/user_log.png" alt="" class="menulogin_icon"></div>
                        </a>
                        @php if(array_key_exists('login', $_COOKIE)) { @endphp
                        <a href="/exit" class="menulogin_link">Выйти</a>
                        @php }else{ @endphp
                        <a href="/authorization" class="menulogin_link">Войти</a>
                        @php }@endphp
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="main_content">
    @yield('main_content')
</div>

<footer>
    <div class="footer_descr">
        <a href="#">Служба поддержки</a>
        <a href="/privacy">Политика конфиденциальности</a>
        <br>
        Позвоните нам 8-800-555-01-21
    </div>
</footer>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/hamburger.js') }}"></script>
</body>
</html>
