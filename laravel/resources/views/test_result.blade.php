@extends('layout')

@section('title')Результат@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_result.css')}}">
@endsection

@section('main_content')

    @php
        $matrix = ([

        [40, 42, 43, 44, 44, 44, 43],

        [23, 24, 25, 25, 25, 25, 24],

        [11, 11, 10, 10, 9, 9, 8],

        [70, 80, 90, 100, 110, 110, 100],

        [17, 18, 19, 19, 20, 22, 22],

        [20.7, 21, 22, 22, 23, 23, 22],

        [77, 76.5, 73.5, 66.5, 64.5, 64, 63.5]
    ]);

    $OYFK = 0;
    @endphp

    <div class="result_title"><h2>Результаты тестирования</h2></div>

    <div class="result_table">
        <div class='container'>
            <div class='row'>
                <div class='col col-md-5'>
                    <div class='title_field'>Тест</div>
                </div>
                <div class='col col-md-3'>
                    <div class='title_field'>Результат</div>
                </div>
                <div class='col col-md-2'>
                    <div class='title_field'>НВП</div>
                </div>
                <div class='col col-md-2'>
                    <div class='title_field_last'>Оценка</div>
                </div>
            </div>
            @foreach($result->Exercises as $key => $exercise)
                {{--@php dd($result) @endphp--}}
                <div class='row'>
                    <div class='col col-md-5'>
                        <div class='data_field'>{{$exercise->Name}}</div>
                    </div>
                    <div class='col col-md-3'>
                        <div class='data_field'>{{$exercise->Value}}</div>
                    </div>
                    <div class='col col-md-2'>
                        <div class='data_field'>{{$matrix[$key][0]}}</div>
                    </div>
                    <div class='col col-md-2'>
                        <div class='data_field_last'>{{round(( $exercise->Value - $matrix[$key][0]) / $matrix[$key][0], 2)}}</div>
                    </div>
                </div>
                @php
                    $OYFK += round(( $exercise->Value - $matrix[$key][0]) / $matrix[$key][0], 2);
                @endphp
            @endforeach

        </div>
    </div>

    <div class="result_total">
        <h3>Общий уровень развития физических кондиций</h3>
        <div class="total_counting">ОУФК = (О + ПТ + Н + У + ЛЛ + УР + ТТ) : 7 = {{$OYFK}}</div>
    </div>



@endsection
