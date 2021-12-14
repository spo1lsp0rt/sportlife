@extends('layout')

@section('title')Тесты@endsection

@section('stylesheet')
    @yield('testform_stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/tests.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/testform.css')}}">
@endsection

@section('main_content')

    <div class="tests">
        <div class="tests_title"><h2>Выбор нужного теста</h2></div>
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

    @foreach($tests as $test)
        <a href='/test/{{$test->ID_Test}}' class='form_link'>
        <div class='tests_form'>
            <div class='form_title'>Тест №{{$test->ID_Test}}</div>
            <div class='form_divider'></div>
            <div class='testname_case'>
                <div class='form_testname_title'>Название:</div>
                <div class='form_testname'> {{$test->Name}}</div>
            </div>
            <div class='testdescr_case'>
                <div class='form_testdescr_title'>Описание:</div>
                <div class='form_testdescr_field'>
                    {{$test->Description}}
                </div>
            </div>
        </div>
        </a>
    @endforeach

@endsection
