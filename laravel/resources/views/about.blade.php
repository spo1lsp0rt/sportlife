@php
    $allUsers = DB::select('select * from user');
    $currentUser = null;
        if (array_key_exists('login', $_COOKIE))
            {
                foreach($allUsers as $user)
                {
                    if($user->ID_User == $_COOKIE['ID_User'])
                    {
                        $currentUser = $user;
                        break;
                    }
                }
            }
@endphp

@extends('layout')

@section('title')О нас@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/about.css')}}">
@endsection

@section('main_content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="about_welcome">
                    <div class="about_title">
                        <h2>Добро пожаловать в SportLife</h2>
                    </div>
                    <img class="about_img" src="/img/about/logo2.svg" alt="">
                    <div class="about_info">SportLife - это учебный сайт, который предоставляет упрощенное взаимодействие между студентом и преподавателем на занятиях физической культуры. В данный момент на сайте доступно заполнение студентом собственных результатов по итоговым нормативам сессии и онлайн прохождение тестов.</div>
                    <div class="about_info"><i>Ниже описаны основные функции сайта</i></div>
                    <img class="about_down" src="/img/about/down_arrows.svg" alt="">
                </div>
            </div>
        </div>
        @if($currentUser === null)
        <div class="row">
            <div class="col">
                <div class="content_field">
                    <div class="content_field_header">Регистрация на сайте</div>
                    <div class="content_field_info">Для прохождения регистрации на сайте необходимо получить у администратора ключ-код, созданный на ваше имя. Данный ключ-код позволяет вам получить доступ к регистрации. После его ввода в соответствующее поле и проверки будут открыты для заполнения поля регистрации.</div>
                    <img class="content_field_img" src="/img/about/user_registration.gif" alt="">
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col">
                <div class="content_field">
                    <div class="content_field_header">Тестирование</div>
                    <div class="content_field_info">На главной странице сайта в верхней части страницы располагается навигационное меню. На нем отображен весь доступный функционал сайта. Студенту доступна возможность прохождения теста. Для этого необходимо перейти на вкладку "Тесты" и выбрать тест заданный преподавателем.</div>
                    <img class="content_field_img" src="/img/about/tests_usage.gif" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="content_field">
                    <div class="content_field_header">Результаты тестирования</div>
                    <div class="content_field_info">При прохождении тестирования необходимо выполнять упражнения и вводить ответы в точности как указано в задании. Это позволит достигнуть успешного результата при выводе результатов, которые обязательно отображаются по окончании выполнения теста, а также в профиле.</div>
                    <img class="content_field_img" src="/img/about/test_result.gif" alt="">
                    <div class="content_field_info"><span class="text-danger"><b>Важно!</b></span><br>После прохождения тестирования студенту будет закрыт доступ к тесту. Для повторного прохождения необходимо, чтобы преподаватель открыл ему доступ.</div>
                </div>
            </div>
        </div>
        @endif
        @if($currentUser->ID_Role == 1)
        <div class="row">
            <div class="col">
                <div class="content_field">
                    <div class="content_field_header">Заполнение результатов ОФП (ГТО)</div>
                    <div class="content_field_info">В течение сессии студенты выполняют нормативы, подготовленные преподавателем. Данные нормативы позволяют оценить подготовленность студента к физическим нагрузкам. Во вкладке "ОФП" студенту необходимо ввести свои результаты по сданному нормативу, чтобы преподаватель мог записать их в журнал.</div>
                    <img class="content_field_img" src="/img/about/ofp_usage.gif" alt="">
                </div>
            </div>
        </div>
        @elseif($currentUser->ID_Role == 2)
            <div class="row">
                <div class="col">
                    <div class="content_field">
                        <div class="content_field_header">Открытие доступа к тесту</div>
                        <div class="content_field_info">После прохождения теста студент получает результаты тестирования и лишается возможности снова проходить тест без разрешения преподавателя. Преподавателю необходимо выбрать в профиле строку с содержанием соответствующего теста и студента, после чего откроется страница с результатами. На этой же странице преподаватель может открыть доступ студенту к тесту.</div>
                        <img class="content_field_img" src="/img/about/ofp_teacher_usage.gif" alt="">
                        <div class="content_field_info"><span class="text-danger"><b>Важно!</b></span><br>После открытия доступа к повторному прохождению теста старые результаты студента пропадут.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="content_field">
                        <div class="content_field_header">Заполнение результатов ОФП (ГТО)</div>
                        <div class="content_field_info">В течение сессии студенты выполняют нормативы, подготовленные преподавателем. Данные нормативы позволяют оценить подготовленность студента к физическим нагрузкам. Во вкладке "ОФП" преподаватель может посмотреть и изменить результаты по нормативам у необходимой группы.</div>
                        <img class="content_field_img" src="/img/about/ofp_teacher_usage.gif" alt="">
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
