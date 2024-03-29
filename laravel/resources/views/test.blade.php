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
    $user_test = DB::select("select ID from test_user where ID_User = ".$_COOKIE['ID_User']." AND ID_Test = ".$id);
    if(!empty($user_test)){
        header('Location: /tests');
        exit;
    }
@endphp

@extends('layout')

@section('title'){{$test->Name}}@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_test.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
@endsection

@section('main_content')

    <form action="/test/{{$id}}" method="POST">
        @csrf
        <section class="test">
            <div class="container">
                <h1>Контрольная работа №{{$id}}</h1>
            </div>
            <div class="container">
                <h2>{{$test->Name}}</h2>
            </div>
            @if($test->Explanation != '')
                <div class="container test_task">{{$test->Explanation}}</div>
            @endif

            <div class="container">
                @foreach($test->Exercises as $key => $exercise)
                    <div class="row">
                        <div class="col">
                            <div class="test_task">
                                <div class="test_header">{!! ($exercise->Name) !!}
                                </div>

                                <div class="test_info">{!! $exercise->Description !!}
                                </div>
                                @if($exercise->img)
                                    <img class="img-fluid test_img" src={{"/img/".$exercise->img}} alt="">
                                @endif


                                @if($exercise->Timer_seconds != NULL)
                                    {{--------------------------Таймер------------------------------}}
                                    <div id="{{$exercise->Timer_seconds}}">
                                        <div class="timer" id="timer{{$key + 1}}"></div>
                                        <input value="Запустить таймер" class="timer_btn"
                                               onclick="" id="timer_btn{{$key + 1}}" type="button">
                                    </div>
                                @endif
                                @if($test->ID_Test == 6)
                                    <p>
                                    <center>
                                        <p>Введите число час и минуты начала занятия:</p>
                                        <input type="time" name="{{$exercise->getInputName().'begtime'}}" min="09:00" max="18:00" required  class="@error($exercise->getInputName().'begtime') is-invalid @enderror" value="09:00">
                                        <p>Введите число час и минуты конца занятия:</p>
                                        <input type="time" name="{{$exercise->getInputName().'endtime'}}" min="09:00" max="18:00" required value="09:00">
                                    </center>
                                    </p>
                                    @error($exercise->getInputName().'begtime')
                                    <div class="alert alert-danger text-center mt-2 mb-0">{{ 'Поле заполнено некорректно' }} @enderror
                                @else
                                    <input type="number" step="any" placeholder="Введите результат" class="input_number test_result @error($exercise->getInputName()) is-invalid @enderror" name="{{$exercise->getInputName()}}" value="{{$exercise->Value}}">
                                    @error($exercise->getInputName())
                                    <div class="alert alert-danger text-center mt-2 mb-0">{{ 'Поле заполнено некорректно' }}</div>
                                @endif
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($test->ID_Test == 1 || $test->ID_Test == 2 || $test->ID_Test == 3 || $test->ID_Test == 5)
                <div class="person_info">
                @if(!array_key_exists('Gender', $_COOKIE))
                        <div class="gender_info">
                            <div class="gender_title">Выберите ваш пол:</div>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio"  value = "муж" id="btnradio1" autocomplete="off" checked >
                                <label class="btn btn-outline-dark" for="btnradio1">Мужской</label>

                                <input type="radio" class="btn-check" name="btnradio" value = "жен" id="btnradio2" autocomplete="off" >
                                <label class="btn btn-outline-dark" for="btnradio2">Женский</label>
                            </div>
                        </div>
                @endif
                    @if($test->ID_Test == 1)
                        <div class="age_info">
                            <div class="age_title">Введите ваш возраст:</div>
                            <input type="number" min="17" max="23" placeholder="Например: 18" class="age_input" name = "age"
                                   class="@error("age") is-invalid @enderror" value= >
                        </div>
                        @error("age")
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger text-center mt-2 mb-0">{{ 'Введите число от 17 до 23' }}</div>
                                </div>
                            </div>
                        </div>
                        @enderror
                    @endif

                </div>
            @endif

            <button class="result_btn">Получить результат</button>
        </section>

    </form>


@endsection

@section('scriptsheet')
    <script src="{{ asset('js/timer.js') }}"></script>
    <script src="{{ asset('js/number_handler.js') }}"></script>
@endsection
