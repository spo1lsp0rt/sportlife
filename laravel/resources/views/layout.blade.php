<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SportLife - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    @yield('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
    <link rel="icon" href="/icons/favicon.svg">
</head>
<body>
<header>
    <nav>
        <div class="container">
            <div class="row">
                <div class="header_menu">
                    <a class="logo_link" href="/"><img src="/img/logo.svg" alt="logo" class="menu_img"></a>

                    <div class="hamburger_field">
                        <div class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="menu_field">
                        <ul class="menu">
                            <div class="mobile_menulogin">
                                <a class="menu_element" href="/profile">
                                    <div class="mobile_menulogin_round"><img src="/icons/user_log.png" alt="" class="mobile_menulogin_icon"></div>
                                </a>
                                @php if(array_key_exists('login', $_COOKIE)) { @endphp
                                <a href="/exit" class="mobile_menulogin_link menu_element">Выйти</a>
                                @php }else{ @endphp
                                <a href="/authorization" class="mobile_menulogin_link menu_element">Войти</a>
                                @php }@endphp
                            </div>
                            <li class="menu_item menu_element"><a href="/" class="menu_link">Главная</a></li>
                            <li class="menu_item menu_element"><a href="/tests" class="menu_link">Тесты</a></li>
                            <li class="menu_item menu_element"><a href="/normatives" class="menu_link">ОФП</a></li>
                            <li class="menu_item menu_element"><a href="/about" class="menu_link">О сайте</a></li>
                            <li class="menu_item menu_element"><a href="/contacts" class="menu_link">Контакты</a></li>
                        </ul>
                    </div>

                    <div class="menulogin">
                        <a href="/profile">
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
<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/hamburger.js') }}"></script>
@yield('scriptsheet')
</body>
</html>
