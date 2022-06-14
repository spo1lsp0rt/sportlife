@php
    $array = array();
    $OYFK = 0;

@endphp

<div class="result_title"><h2>Результаты тестирования</h2></div>

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered border-dark align-middle text-center">
                <thead class="align-middle">
                <tr>
                    <th scope="col">Тест</th>
                    <th scope="col">Результат</th>
                    <th scope="col">НВП</th>
                    <th scope="col">Оценка</th>
                </tr>
                </thead>
                <tbody id="myTable" style="line-height: 2; white-space: normal;">
                @foreach($result->Exercises as $key => $exercise)
                    <tr>
                        <th scope="row">{{$exercise->Name}}</th>
                        <td>{{$exercise->Value}}</td>
                        <td>{{$exercise->Norma}}</td>
                        <td>
                            @php
                                if ($exercise->Name == "Ловля падающей линейки."){
                                    $numerator = $exercise->Value - $exercise->Norma;
                                    if ($numerator === 0.0) {
                                        echo(round( $numerator / $exercise->Norma, 2));
                                    }
                                    else {
                                        echo((-1) * round( $numerator / $exercise->Norma, 2));
                                    }
                                }
                                else{
                                    echo(round(( $exercise->Value - $exercise->Norma) / $exercise->Norma, 2));
                                }
                            @endphp
                        </td>
                    </tr>
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
                </tbody>
            </table>
        </div>
    </div>

    @php
    $world = '';
    if(-1 > $OYFK)
        $world = 'Опасная зона';
    else if (-1 < $OYFK && -0.61 > $OYFK)
        $world = 'Нудовлетворительно';
    else if (-0.60 < $OYFK && -0.21 > $OYFK)
        $world = 'Удовлетворительно';
    else if (-0.2 < $OYFK && 0.2 > $OYFK)
        $world = 'Хорошо';
    else if(0.21 < $OYFK && 0.60 > $OYFK)
        $world = 'Отлично';
    else if (0.61 < $OYFK)
        $world = 'Супер';
    @endphp
    <div class="row">
        <div class="result_total">
            <h3>Общий уровень развития физических кондиций</h3>
            <div class="total_counting">ОУФК = (О + ПТ + Н + У + ЛЛ + УР + ТТ) : 7 = {{round($OYFK, 2)}} {{$world}}</div>
        </div>
    </div>
</div>

