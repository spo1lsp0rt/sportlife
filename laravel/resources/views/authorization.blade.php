@extends('layout')

@section('title')Авторизация@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/authorization.css')}}">
@endsection

@section('main_content')

    <div class="authorize_menu">
        <div class="authorize_title">Авторизация</div>
        <form class="px-4 py-3">
            <div class="mb-3">
                <label for="exampleDropdownFormEmail1" class="form-label">Электронная почта</label>
                <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@sportlife.com">
            </div>
            <div class="mb-3">
                <label for="exampleDropdownFormPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Введите пароль">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                    <label class="form-check-label" for="dropdownCheck">
                        Запомнить меня
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Войти</button>
        </form>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Забыли пароль?</a>
    </div>

@endsection
