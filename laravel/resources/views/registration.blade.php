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

        $faculties = DB::select('select * from faculty');
        $arr_faculties = array();
        foreach ($faculties as $faculty)
            $arr_faculties[] = $faculty->Name;

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
        var arr_groups = <?php echo json_encode($arr_groups); ?>;
        var arr_faculties = <?php echo json_encode($arr_faculties); ?>;

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
                            <div class="combo js-combobox">
                                <input name="group" aria-activedescendant="combo2-0" aria-autocomplete="none" aria-controls="listbox" aria-expanded="false"
                                       aria-haspopup="listbox" id="combo" class="combo-input" role="combobox" type="text">
                                <div class="combo-menu" role="listbox" id="listbox"></div>
                            </div>
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
                                <label class="form-check-label" for="flexSwitchCheckDefault">Я принимаю условия <a class="agreement_link" href="/privacy">Пользовательского соглашения</a></label>
                            </div>
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
