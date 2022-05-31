@extends('layout')

@section('title')Авторизация@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/authorization.css')}}">
@endsection

@section('main_content')

    @if(session('reg_success'))
        <div class="alert alert-success">{{session('reg_success')}}</div>
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
                    <a class="dropdown-item" href="/registration">Пройти регистрацию</a>
                </div>
            </div>
        </div>
    </div>

@endsection
