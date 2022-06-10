@php
    if (array_key_exists('login', $_COOKIE)){
        header('Location: /');
        exit;
    }
@endphp

@extends('layout')

@section('title')Регистрация@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/registration.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
@endsection

@section('main_content')

    <div class="registration_title">
        <h2>Регистрация</h2>
    </div>
    @php
        $groups = DB::select('select * from class');
        $arr_groups = array();
        foreach ($groups as $group) {
            $arr_groups[] = $group->Name;
        }
        $arr_genders = array('Юноша', 'Девушка');

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
    <script type="text/javascript">
        let arr_groups = <?php echo json_encode($arr_groups); ?>;
        let arr_genders = <?php echo json_encode($arr_genders); ?>;
        let arr_options = [arr_groups, arr_genders];
    </script>

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
                            <input @if($key_success) readonly @endif name="key" type="text" id="d1" class="form-control token_input" placeholder="XXX-XXX-XXX-XXX" autocomplete="off">
                            <button @if($key_success) disabled  @endif type="submit" class="token_check_btn">
                                <img src="/icons/tokencheck.svg" alt="" class="token_check_icon">
                            </button>
                        </div>
                    </form>
                    <form class="registration_form_border" method="post" action="/reg">
                        @csrf
                        <div class="personal_info">
                            <input readonly name="secondname" type="text" class="form-control second-name_input" autocomplete="off" value="{{$surname}}" placeholder="Фамилия ⃰">
                        </div>
                        <div class="personal_info">
                            <input readonly name="firstname" type="text" class="form-control first-name_input" value="{{$name}}" placeholder="Имя ⃰">
                        </div>
                        <div class="personal_info">
                            <input readonly name="lastname" type="text" class="form-control patronymic_input" value="{{$lastname}}" placeholder="Отчество ⃰">
                        </div>
                        <div class="personal_info">
                            <div name="group" class="combo js-combobox">
                                <input @if(!$key_success) disabled readonly @endif name="group" aria-autocomplete="none" aria-controls="groups-listbox" aria-haspopup="groups-listbox" id="groups-combo" class="combo-input" role="combobox" type="text">
                                <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                            </div>
                        </div>
                        <div class="personal_info">
                            <div name="gender" class="combo js-combobox">
                                <input @if(!$key_success) disabled readonly @endif name="gender" aria-autocomplete="none" aria-autocomplete="none" aria-controls="gender-listbox" aria-haspopup="gender-listbox" id="gender-combo" class="combo-input" role="combobox" type="text">
                                <div class="combo-menu" role="listbox" id="gender-listbox"></div>
                            </div>
                        </div>
                        <div class="personal_info">
                            <input @if(!$key_success) disabled readonly @endif name="email" type="text" class="form-control email_input" autocomplete="off" placeholder="Логин ⃰">
                        </div>
                        <div class="personal_info">
                            <input @if(!$key_success) disabled readonly @endif name="password" type="password" class="form-control password_input" autocomplete="off" placeholder="Пароль ⃰">
                        </div>
                        <div class="personal_info">
                            <input @if(!$key_success) disabled readonly @endif name="password_confirmation" type="password" class="form-control password_input" autocomplete="off" placeholder="Подтвердите пароль ⃰">
                        </div>
                        <button @if(!$key_success) disabled @endif type="submit" class="btn btn-dark registration_btn">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection
