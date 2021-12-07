@extends('layout')

@section('title')Тесты@endsection

@section('stylesheet')
    {{--@yield('testform_stylesheet')--}}
    {{--<link rel="stylesheet" type="text/css" href="{{url('css/testform.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{url('css/tests.css')}}">
@endsection

@section('main_content')

    <div class="tests">
        <div class="tests_title">Выбор нужного теста</div>
        <div class="tests_search">
            <div class="search_title">Название:</div>
            <input type="text" placeholder="Введите название теста" class="search_field" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <div class="tests_vision">
                        <div class="vision_title">Отображение:</div>
                        <a href="#" class="vision_link"><div class="vision_columns"><img src="/icons/columns_grid.png" alt="columns" class="columns_img"></div></a>
                        <a href="#" class="vision_link"><div class="vision_rows"><img src="/icons/rows_grid.png" alt="rows" class="rows_img"></div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--@yield('testform')--}}
    <a href="/" class="form_link">
        <div class="tests_form">
            @yield('testform_title')  @yield('testform_name')  @yield('testform_descr')
            <div class="form_title">Тест №1</div>
            <div class="form_divider"></div>
            <div class="testname_case">
                <div class="form_testname_title">Название:</div>
                <div class="form_testname">Работа с собственным весом</div>
            </div>
            <div class="testdescr_case">
                <div class="form_testdescr_title">Описание:</div>
                <div class="form_testdescr_field">
                    <div class="form_testdescr">Представленные в тесте упражнения рассчитаны на силовую нагрузку мышц ног и
                        работе с собственным весом в домашних условиях для повышения тонуса.</div>
                </div>
            </div>
        </div>
    </a>

@endsection
