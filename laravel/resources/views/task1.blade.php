@php
    $array = array();
    $OYFK = 0;

@endphp

<div class="result_title"><h2>Результаты тестирования</h2></div>

    <div class='container statistic_table'>
        <div class='row'>
            <div class='col col-md-5'>
                <div class='title_field_head'>Тест</div>
            </div>
            <div class='col col-md-3'>
                <div class='title_field'>Результат</div>
            </div>
            <div class='col col-md-2'>
                <div class='title_field'>НВП</div>
            </div>
            <div class='col col-md-2'>
                <div class='title_field'>Оценка</div>
            </div>
        </div>

        @foreach($result->Exercises as $key => $exercise)
            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field_head textX_left'>{{$exercise->Name}}</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>{{$exercise->Value}}</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>{{$exercise->Norma}}</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>
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

        @php $OYFK = $OYFK / 7; @endphp
    </div>

<div class="result_total">
    <h3>Общий уровень развития физических кондиций</h3>
    <div class="total_counting">ОУФК = (О + ПТ + Н + У + ЛЛ + УР + ТТ) : 7 = {{round($OYFK, 2)}}</div>
</div>
