@extends('layout')

@section('title')Регистрация@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/registration.css')}}">
@endsection

@section('main_content')

    <div class="registration_title">
        <h2>Регистрация</h2>
    </div>

    @php
        $groups = DB::select('select * from class');
        $faculties = DB::select('select * from faculty');
        $key_success = false;
        $name = "";
        $surname = "";
        $lastname = "";
        if(session('fio')){
            $fio = session('fio');
            $key_success = true;
            $temp = explode(' ', $fio);
            $surname = $temp[0];
            $name = $temp[1];
            $lastname = $temp[2];
        }
    @endphp

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="registration_form">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="registration_form_border" method="post" action="/check_key">
                        @csrf
                        <div class="token_field">
                            <div class="token_title">Введите ключ:</div>
                            <input @if($key_success) readonly @endif name="key" type="text" id="d1" class="form-control token_input" placeholder="XXX-XXX-XXX-XXX">
                            <button @if($key_success) disabled  @endif type="submit" class="token_check_btn">
                                <img src="/icons/tokencheck.svg" alt="" class="token_check_icon">
                            </button>
                        </div>
                    </form>
                    <form class="registration_form_border" method="post" action="/reg">
                        @csrf
                        <div class="personal_info">
                            <input readonly name="secondname" type="text" class="form-control second-name_input" autocomplete="off" value="{{$surname}}" placeholder="Фамилия ">
                        </div>
                        <div class="personal_info">
                            <input readonly name="firstname" type="text" class="form-control first-name_input" value="{{$name}}" placeholder="Имя ⃰">
                        </div>
                        <div class="personal_info">
                            <input readonly name="lastname" type="text" class="form-control patronymic_input" value="{{$lastname}}" placeholder="Отчество">
                        </div>
                        <div class="personal_info">
                            <select @if(!$key_success) disabled @endif name="faculties" class="form-select faculties_combobox" aria-label="Default select example">
                                @foreach($faculties as $faculty)
                                    <option name="group{{$faculty->id_faculty}}" value="{{$faculty->id_faculty}}">{{$faculty->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="personal_info">
                            <select @if(!$key_success) disabled @endif name="groups" class="form-select group_combobox" aria-label="Default select example">
                                @foreach($groups as $group)
                                    <option name="group{{$group->ID_Class}}" value="{{$group->ID_Class}}">{{$group->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="personal_info">
                            <input @if(!$key_success) readonly @endif name="email" type="text" class="form-control email_input" autocomplete="off" placeholder="Email ⃰">
                        </div>
                        <div class="personal_info">
                            <input @if(!$key_success) readonly @endif name="password" type="text" class="form-control password_input" autocomplete="off" placeholder="Пароль ⃰">
                        </div>
                        <div class="personal_info">
                            <input @if(!$key_success) readonly @endif name="password_confirmation" type="text" class="form-control password_input" autocomplete="off" placeholder="Подтвердите пароль ⃰">
                        </div>
                        <div class="registration_agreement_field">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Я принимаюм условия <a class="agreement_link" href="/privacy">Пользовательского соглашения</a></label>
                            </div>
                        </div>
                        <button @if(!$key_success) disabled @endif type="submit" class="btn btn-dark registration_btn">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
