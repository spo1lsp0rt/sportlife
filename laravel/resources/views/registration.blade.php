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
    @endphp

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="registration_form">
                    <form class="registration_form_border" action="#">
                        <div class="token_field">
                            <div class="token_title">Введите ключ:</div>
                            <input type="text" id="d1" class="form-control token_input" placeholder="XXX-XXX-XXX-XXX">
                            <button type="submit" class="token_check_btn">
                                <img src="/icons/tokencheck.svg" alt="" class="token_check_icon">
                            </button>
                        </div>
                        <div class="personal_info">
                            <input type="text" class="form-control second-name_input" autocomplete="off" placeholder="Фамилия ⃰">
                        </div>
                        <div class="personal_info">
                            <input type="text" class="form-control first-name_input" placeholder="Имя ⃰">
                        </div>
                        <div class="personal_info">
                            <input type="text" class="form-control patronymic_input" placeholder="Отчество">
                        </div>
                        <div class="personal_info">
                            <select name="faculties" class="form-select faculties_combobox" aria-label="Default select example">
                                @foreach($faculties as $faculty)
                                    <option name="group{{$faculty->id_faculty}}" value="{{$faculty->id_faculty}}">{{$faculty->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="personal_info">
                            <select name="groups" class="form-select group_combobox" aria-label="Default select example">
                                @foreach($groups as $group)
                                    <option name="group{{$group->ID_Class}}" value="{{$group->ID_Class}}">{{$group->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="personal_info">
                            <input type="text" class="form-control email_input" autocomplete="off" placeholder="Email ⃰">
                        </div>
                        <div class="personal_info">
                            <input type="text" class="form-control password_input" autocomplete="off" placeholder="Пароль ⃰">
                        </div>
                        <div class="personal_info">
                            <input type="text" class="form-control password_input" autocomplete="off" placeholder="Подтвердите пароль ⃰">
                        </div>
                        <div class="registration_agreement_field">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Я принимаюм условия <a class="agreement_link" href="/privacy">Пользовательского соглашения</a></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark registration_btn">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection