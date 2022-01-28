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
            <div class="row">
                <div class="col-md-3">
                    <a href="/"><img src="/img/logo.svg" alt="logo" class="menu_img"></a>
                </div>
                <div class="col-md-5">
                    <ul class="menu">
                        <li class="menu_item"><a href="/" class="menu_link">Главная</a></li>
                        <li class="menu_item"><a href="/tests" class="menu_link">Тесты</a></li>
                        <li class="menu_item"><a href="/about" class="menu_link">О сервисе</a></li>
                        <li class="menu_item"><a href="/contacts" class="menu_link">Контакты</a></li>
                        <li class="menu_item"><a href="/add_users" class="menu_link">Добавить студентов</a></li>
                    </ul>
                </div>
                <div class="col-md-2 offset-md-2">
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

@yield('main_content')

<footer>
    <div class="footer_descr">
        <a href="#">Служба поддержки</a> | <a href="/privacy">Политика конфиденциальности</a>
        <br>
        Позвоните нам 8-800-555-01-21
    </div>
</footer>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
