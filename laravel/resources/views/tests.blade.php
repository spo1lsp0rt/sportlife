@extends('layout')

@section('title')Тесты@endsection

@section('stylesheet')
    @yield('testform_stylesheet')
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

    @for ($i = 0; $i < 10; $i++)
        @yield('testform')
    @endfor

@endsection
