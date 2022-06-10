@php
    $allUsers = DB::select('select * from user');
    $currentUser = null;
    if (array_key_exists('login', $_COOKIE))
    {
        foreach($allUsers as $user)
        {
            if($user->ID_User == $_COOKIE['ID_User'])
            {
                $currentUser = $user;
                break;
            }
        }
    }
    else
    {
        header('Location: /authorization');
        exit;
    }
@endphp

@extends('layout')

@section('title')Тесты@endsection

@section('stylesheet')
    @yield('testform_stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/tests.css')}}">
@endsection

@section('main_content')


    @if($currentUser->ID_Role == 1 || $currentUser->ID_Role == 2 || $currentUser->ID_Role == 3)
        <div class="tests">
            <div class="tests_title"><h2>Выбор нужного теста</h2></div>
        </div>

        @php
            $user_test = null;
            if(array_key_exists('ID_User', $_COOKIE))
            {
                $user_test = DB::select("select * from test_user where ID_User = ".$_COOKIE['ID_User']);
            }

        @endphp

        @foreach($tests as $test)


            @php
                $access = false;
                    if(array_key_exists('ID_User', $_COOKIE))
                    {
                        foreach($user_test as $key)
                        {
                            if($test->ID_Test == $key->ID_Test && $_COOKIE['ID_User'] == $key->ID_User)
                           {
                               $access = true;
                            }
                        }
                    }
            @endphp

            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href='@php if($access) { @endphp# @php } else { @endphp/test/{{$test->ID_Test}}@php } @endphp' class='form_link'>
                            <div class='tests_form'>
                                <div class='form_title'>Тест №{{$test->ID_Test}}</div>
                                <div class='form_divider'></div>
                                <div class='testname_case'>
                                    <div class='form_testname'> <b>Название:</b> {{$test->Name}}</div>
                                </div>
                                <div class='testdescr_case'>
                                    <div class='form_testdescr'><b>Описание:</b> {{$test->Description}}</div>
                                </div>
                                @php if($access) { @endphp
                                <div class="testlock">
                                    <img src="/img/lock.png" alt="lock" class="lock_img">
                                </div>
                                @php } @endphp
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection
