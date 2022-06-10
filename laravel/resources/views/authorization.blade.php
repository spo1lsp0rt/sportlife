@php
    if (array_key_exists('login', $_COOKIE)){
        header('Location: /');
        exit;
    }
@endphp


@extends('layout')

@section('title')Авторизация@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/authorization.css')}}">
@endsection

@section('main_content')

    @if(session('reg_success'))
        <div class="alert alert-success text-center">{{session('reg_success')}}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="authorize_menu">
                    <div class="authorize_title"><h2>Авторизация</h2></div>
                    <form class="px-4 py-3" method="post" action="/auth/check">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="exampleDropdownFormEmail1" class="form-label">Логин</label>
                            <input type="text" name="login" class="form-control" placeholder="Введите логин">
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormPassword1" class="form-label">Пароль</label>
                            <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Введите пароль">
                        </div>
                        <button type="submit" class="btn btn-dark login_btn">Войти</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center" href="/registration">Пройти регистрацию</a>
                </div>
            </div>
        </div>
    </div>

@endsection
