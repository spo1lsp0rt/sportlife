@extends('layout')

@section('title')Контакты@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/contacts.css')}}">
@endsection

@section('main_content')
    <div class="info">
        <div class="container">
            <h1>Контактная информация</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-5 col-sm-4 col-md-4 col-lg-3">
                    <div class="info_text">Адрес: </div>
                </div>
                <div class="col">
                    <div class="info_text">г.Астрахань, ул. Татищева, 16 , <br>корпус 7, аудитория 107</div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-4 col-md-4 col-lg-3">
                    <div class="info_text">График работы: </div>
                </div>
                <div class="col">
                    <div class="info_text">Понедельник - суббота <br>8:30 - 17:00</div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-4 col-md-4 col-lg-3">
                    <div class="info_text">Звоните: </div>
                </div>
                <div class="col">
                    <div class="info_text"><a href="tel:614-517">614-517</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 col-sm-4 col-md-4 col-lg-3">
                    <div class="info_text">Электронная почта:
                    </div>
                </div>
                <div class="col">
                    <div class="info_text"><a href="mailto:a.burov@astu.org">a.burov@astu.org</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
