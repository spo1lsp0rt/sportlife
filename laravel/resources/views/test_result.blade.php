@extends('layout')

@section('title')Результат@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_result.css')}}">
@endsection

@section('main_content')

    @if($result->ID_Test == 1)
        @php
            $array = array();
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
                    <div class='row'>
                        <div class='col col-md-5'>
                            <div class='data_field'>{{$exercise->Name}}</div>
                        </div>
                        <div class='col col-md-3'>
                            <div class='data_field'>{{$exercise->Value}}</div>
                        </div>
                        <div class='col col-md-2'>
                            <div class='data_field'>{{$exercise->Norma}}</div>
                        </div>
                        <div class='col col-md-2'>
                            <div class='data_field_last'>
                                @php
                                    if ($exercise->Name == "Ловля падающей линейки."){
                                        echo((-1) * round(( $exercise->Value - $exercise->Norma) / $exercise->Norma, 2));
                                    }
                                    else{
                                        echo(round(( $exercise->Value - $exercise->Norma) / $exercise->Norma, 2));
                                    }
                                @endphp</div>
                        </div>
                    </div>
                    @php
                        if ($exercise->Name == "Ловля падающей линейки.")
                        {
                            //dd($exercise);
                            $OYFK += (-1) * round(( $exercise->Value - $exercise->Norma) / $exercise->Norma, 2);
                        }
                        else
                            $OYFK += round(( $exercise->Value - $exercise->Norma) / $exercise->Norma, 2);
                    @endphp
                @endforeach

            </div>
        </div>

        <div class="result_total">
            <h3>Общий уровень развития физических кондиций</h3>
            <div class="total_counting">ОУФК = (О + ПТ + Н + У + ЛЛ + УР + ТТ) : 7 = {{$OYFK}}</div>
        </div>
    @endif

    @if($result->ID_Test == 2)
        <div class="result_table">
            <div class='container'>
                <div class='row'>
                    <div class='col col-md-5'>
                        <div class='title_field'>Проба</div>
                    </div>
                    <div class='col col-md-3'>
                        <div class='title_field'>Результат</div>
                    </div>
                    <div class='col col-md-2'>
                        <div class='title_field'>Уровнень</div>
                    </div>

                </div>
                @foreach($result->Exercises as $key => $exercise)
                    <div class='row'>
                        <div class='col col-md-5'>
                            <div class='data_field'>{{$exercise->Name}}</div>
                        </div>
                        <div class='col col-md-3'>
                            <div class='data_field'>{{$exercise->Value}}</div>
                        </div>
                        <div class='col col-md-2'>
                            <div class='data_field'>
                                @php
                                    //dd($exercise);
                                    if($exercise->Norma == 1) { echo "Низкий";}
                                    if($exercise->Norma == 2) { echo "Ниже среднего"; }
                                    if($exercise->Norma == 3) { echo "Средний"; }
                                    if($exercise->Norma == 4) { echo "Выше среднего"; }
                                    if($exercise->Norma == 5) { echo "Высокий"; }
                                @endphp
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
@endsection
