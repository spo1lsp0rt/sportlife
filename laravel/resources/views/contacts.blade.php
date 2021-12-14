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
                <div class="col-md-2">
                    <div class="info_text">Адрес: </div>
                </div>
                <div class="col-md-3">
                    <div class="info_text">г.Астрахань, ул. Татищева, 16</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="info_text">График работы: </div>
                </div>
                <div class="col-md-2">
                    <div class="info_text">Понедельник - суббота <br>8:30 - 17:00</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="info_text">Звоните: </div>
                </div>
                <div class="col-md-2">
                    <div class="info_text"><a href="tel:8-800-555-01-21">8-800-555-01-21</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="info_text">Электронная почта: </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info_text"><a href="mailto:sportlife@mail.ru">sportlife@mail.ru</div>
                </div>
            </div>
        </div>
    </div>
@endsection
