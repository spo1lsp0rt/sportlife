<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SportLife - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
    <link rel="icon" href="/icons/favicon.svg">
    @yield('stylesheet')
</head>
<body>

<div class="loader">
    <div class="ring"></div>
</div>
<header>
    <nav>
        <div class="container">
            <div class="row">
                <div class="header_menu">
                    <a class="logo_link" href="/"><img src="/img/logo.svg" alt="logo" class="menu_img"></a>

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

                    <div class="hamburger_field">
                        <div class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
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
        <a href="https://astu.org/Content/PageChair/3553">Кафедра физического воспитания</a>
        <br>
        Наш телефон: 614-517
    </div>
</footer>

<script>
    const loader = document.querySelector(".loader");
    window.onload = function(){
        setTimeout(function(){
            loader.style.opacity = "0";
            setTimeout(function(){
                loader.style.display = "none";
            }, 500);
        },100);
    }
</script>
<script>
    "use strict";
    (() => {
        const modified_inputs = new Set;
        const defaultValue = "defaultValue";
// store default values
        addEventListener("beforeinput", (evt) => {
            const target = evt.target;
            if (!(defaultValue in target || defaultValue in target.dataset)) {
                target.dataset[defaultValue] = ("" + (target.value || target.textContent)).trim();
            }
        });
// detect input modifications
        addEventListener("input", (evt) => {
            const target = evt.target;
            let original;
            if (defaultValue in target) {
                original = target[defaultValue];
            } else {
                original = target.dataset[defaultValue];
            }
            if (original !== ("" + (target.value || target.textContent)).trim()) {
                if (!modified_inputs.has(target)) {
                    modified_inputs.add(target);
                }
            } else if (modified_inputs.has(target)) {
                modified_inputs.delete(target);
            }
        });
// clear modified inputs upon form submission
        addEventListener("submit", (evt) => {
            modified_inputs.clear();
            // to prevent the warning from happening, it is advisable
            // that you clear your form controls back to their default
            // state with evt.target.reset() or form.reset() after submission
        });
// warn before closing if any inputs are modified
        addEventListener("beforeunload", (evt) => {
            if (modified_inputs.size) {
                const unsaved_changes_warning = "Changes you made may not be saved.";
                evt.returnValue = unsaved_changes_warning;
                return unsaved_changes_warning;
            }
        });
    })();
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/hamburger.js') }}"></script>
@yield('scriptsheet')
</body>
</html>
