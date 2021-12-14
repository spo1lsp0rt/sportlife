@extends('layout')

@section('title')Оценка собственного уровня физической кондиции@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_test.css')}}">
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

            <div class="container">
                @foreach($test->Exercises as $key => $exercise)
                    <div class="row">
                        <div class="col">
                            <div class="test_task">
                                <div class="test_header">Задание {{$key + 1}}. {!! nl2br(htmlspecialchars($exercise->Name)) !!}
                                </div>
                                <div class="test_info">{!! nl2br(htmlspecialchars($exercise->Description)) !!}
                                </div>

                                <input type="text" placeholder="Введите результат" class="test_result"
                                       class="@error($exercise->getInputName()) is-invalid @enderror" name="{{$exercise->getInputName()}}" value="">
                                @error($exercise->getInputName())
                                <div class="alert alert-danger">{{ 'Поле заполнено некорректно' }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="person_info">
                <div class="gender_info">
                    <div class="gender_title">Выберите ваш пол:</div>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-outline-dark" for="btnradio1">Мужской</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-dark" for="btnradio2">Женский</label>
                    </div>
                </div>

                <div class="age_info">
                    <div class="age_title">Введите ваш возраст:</div>
                    <input type="text" placeholder="Например: 18" class="age_input">
                </div>

            </div>
            <button class="result_btn">Получить результат</button>
        </section>
    </form>


@endsection
