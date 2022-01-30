@extends('layout')

@section('title')Главная страница@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/home.css')}}">
@endsection

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="home">
                    <div class="home_descrblock">
                        <div class="home_title">Твой помощник в достижении результатов</div>
                        <div class="home_descr">Онлайн тестирование на основе упражнений,
                            предназначенных для проверки различных
                            областей вашего тела.</div>
                        <form action="/tests">
                            <button formaction="/tests" class="home_btn">Пройти тестирование</button>
                        </form>
                    </div>
                    <img src="/img/running_man.png" alt="man" class="home_img">
                </div>
            </div>
        </div>
    </div>

@endsection
