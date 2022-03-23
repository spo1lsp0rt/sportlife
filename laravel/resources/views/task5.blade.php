<div class="result_title"><h2>Результаты тестирования</h2></div>
@php
$i = 1;
$arrvar = array();
@endphp
<div class='container statistic_table'>
    <div class='row'>
        <div class='col col-md-5'>
            <div class='title_field'>№</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field_last'>Соматометрические показатели</div>
        </div>
        <div class='col col-md-2'>
            <div class='title_field_last'>Полученные значения</div>
        </div>
    </div>

    @foreach($result->Exercises as $key => $exercise)
        @if($i != 3)
            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>{{$i}}</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field data_field_last'>{{rtrim($exercise->Name, 'женмужNormostenikAstenikHypersthenic')}}</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field data_field_last'>{{$exercise->Value}}</div>
                </div>
            </div>
        @else
            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>{{$i}}</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field data_field_last'>{{rtrim($exercise->Name, 'женмужNormostenikAstenikHypersthenic')}}</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field data_field_last'>
                        @php
                            if($exercise->Value <=  87)
                                echo 'Низкий КП';
                            elseif ($exercise->Value > 87 && $exercise->Value <= 92)
                                echo 'КП в норме';
                            elseif ($exercise->Value > 92)
                                echo 'Высокий КП';
                        @endphp
                    </div>
                </div>
            </div>
        @endif
        @php
            $i++;
            $arrvar[] = $exercise->Value
        @endphp
    @endforeach

    @for($j = $i; $j <= 15; $j++)
        <div class='row'>
            <div class='col col-md-5'>
                <div class='data_field'>{{$j}}</div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field data_field_last'>
                    @php
                    switch ($j){
                        case 10:
                            echo 'Экскурсия грудной клетки';
                            break;
                        case 11:
                            echo 'Пропорциональность развития грудной клетки по индексу Эрисмана';
                            break;
                        case 12:
                            echo 'Крепость сложения по индексу Пинье';
                            break;
                        case 13:
                            echo 'Окружность талии';
                            break;
                        case 14:
                           echo 'Окружность бедер';
                           break;
                        case 15:
                           echo 'Массо-ростовой индекс Кетле.';
                           break;
                    }
                    @endphp
                </div>
            </div>
            <div class='col col-md-2'>
                <div class='data_field data_field_last'>
                    @php
                        switch ($j){
                            case 10:
                                echo $arrvar[8] - $arrvar[9];
                                break;
                            case 11:
                                echo $arrvar[7] - 0.5 * $arrvar[0];
                                break;
                            case 12:
                                echo $arrvar[0] - $arrvar[4] + $arrvar[9];
                                break;
                            case 13:
                                echo $arrvar[0] - 100;
                                break;
                            case 14:
                                echo $arrvar[0] - 100 + 33;
                                break;
                            case 15:
                                if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 299)
                                    echo 'Истощение';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 299 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 319)
                                    echo 'Очень плохая';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 319 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 359)
                                    echo 'Плохая';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 359 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 389)
                                    echo 'Средняя';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 389 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 400)
                                    echo 'Наилучшая';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 400 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 415)
                                    echo 'Хорошая';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 415 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 450)
                                    echo 'Излишний вес';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 450 && round(($arrvar[4] / $arrvar[0]) * 1000, 2) <= 540)
                                    echo 'Чрезмерный вес';
                                else if(round(($arrvar[4] / $arrvar[0]) * 1000, 2) > 540)
                                    echo 'Ожирение';
                                break;
                        }
                    @endphp
                </div>
            </div>
        </div>
    @endfor
</div>
