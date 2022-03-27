@extends('layout')

@section('title'){{$test->Name}}@endsection

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
            @if($test->ID_Test == 4)
                <div class="container test_task">Теоретическим обоснованием данной пробы является закон экономизации функций по мере повышения уровня трениро-ванности, а также прямая зависимость между интенсивностью физической нагрузки и ЧСС. Характеристики физического развития, определение физического состояния и работоспособности, безусловно, несут косвенную информацию о состоянии здоровья. Однако следует помнить, что рекомендуемый тест позволяет увидеть границы приспособительных реакций, диапазон которых и характеризует состояние здоровья. Поэтому более адекватными могут быть методики балльной и процентной оценки здоровья, учитывающие в комплексе морфологические и функциональные показатели, а также результаты нагрузочных тестов.
                </div>
            @endif
            <div class="container">
                @foreach($test->Exercises as $key => $exercise)
                    <div class="row">
                        <div class="col">
                            <div class="test_task">
                                <div class="test_header">Задание {{$key + 1}}. {!! ($exercise->Name) !!}
                                </div>
                                <div class="test_info">{!! $exercise->Description !!}
                                </div>

                                <input type="text" placeholder="Введите результат" class="test_result"
                                       class="@error($exercise->getInputName()) is-invalid @enderror" name="{{$exercise->getInputName()}}" value="{{$exercise->Value}}">
                                @error($exercise->getInputName())
                                <div class="alert alert-danger">{{ 'Поле заполнено некорректно' }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($test->ID_Test == 1 || $test->ID_Test == 2 || $test->ID_Test == 3 || $test->ID_Test == 5)

                <div class="person_info">
                    <div class="gender_info">
                        <div class="gender_title">Выберите ваш пол:</div>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio"  value = "муж" id="btnradio1" autocomplete="off" checked >
                            <label class="btn btn-outline-dark" for="btnradio1">Мужской</label>

                            <input type="radio" class="btn-check" name="btnradio" value = "жен" id="btnradio2" autocomplete="off" >
                            <label class="btn btn-outline-dark" for="btnradio2">Женский</label>
                        </div>
                    </div>

                    @if($test->ID_Test == 1)
                        <div class="age_info">
                            <div class="age_title">Введите ваш возраст:</div>
                            <input type="text" placeholder="Например: 18" class="age_input" name = "age"
                                   class="@error("age") is-invalid @enderror" value= >
                        </div>
                        @error("age")
                        <div class="alert alert-danger">{{ 'Введите число от 16 до 45' }}</div>
                        @enderror
                    @endif

                    @if($test->ID_Test == 5)
                        <div class="gender_info">
                            <div class="gender_title">Выберите вашу форму грудной клетки:</div>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio2"  value = "Astenik" id="btnradio3" autocomplete="on" checked >
                                <label class="btn btn-outline-dark" for="btnradio3">Астеники</label>

                                <input type="radio" class="btn-check" name="btnradio2" value = "Normostenik" id="btnradio4" autocomplete="off" >
                                <label class="btn btn-outline-dark" for="btnradio4">Нормастеники </label>

                                <input type="radio" class="btn-check" name="btnradio2" value = "Hypersthenic" id="btnradio5" autocomplete="off" >
                                <label class="btn btn-outline-dark" for="btnradio5">Гиперстеник </label>
                            </div>
                        </div>
                    @endif

                </div>
            @endif

            <button class="result_btn">Получить результат</button>
        </section>
    </form>


@endsection
