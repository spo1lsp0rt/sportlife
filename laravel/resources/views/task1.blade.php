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
                <div class='title_field_last'>Результат</div>
            </div>
            <div class='col col-md-2'>
                <div class='title_field_last'>НВП</div>
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
                    <div class='data_field_last'>{{$exercise->Value}}</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>{{$exercise->Norma}}</div>
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
