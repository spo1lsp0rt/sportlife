
@php
    $i = 1;
    $course = '';
@endphp

<div class="result_title"><h2>Результаты тестирования</h2></div>

<div class='container statistic_table'>
    <div class='row'>
        <div class='col col-md-4'>
            <div class='title_field'>Проба</div>
        </div>
        <div class='col col-md-2'>
            <div class='title_field_last'>Результат</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field_last'>Уровнень</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field_last'>Диапазон</div>
        </div>

    </div>
    @foreach($result->Exercises as $key => $exercise)
        <div class='row'>
            <div class='col col-md-4'>
                <div class='data_field'>{{rtrim($exercise->Name, 'женмуж')}}</div>
            </div>
            <div class='col col-md-2'>
                <div class='data_field data_field_last'>{{$exercise->Value}}</div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field data_field_last'>
                    @php
                        if($exercise->Norma == 1) { echo "Низкий";}
                        if($exercise->Norma == 2) { echo "Ниже среднего"; }
                        if($exercise->Norma == 3) { echo "Средний"; }
                        if($exercise->Norma == 4) { echo "Выше среднего"; }
                        if($exercise->Norma == 5) { echo "Высокий"; }
                    @endphp
                </div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field data_field_last'>
                    @php
                        if(stripos($exercise->Name, 'муж'))
                            $norma = DB::select("select Value from normatives2 where gender = 'муж' AND id_exercise = ".$i);
                        else
                            $norma = DB::select("select Value from normatives2 where gender = 'жен' AND id_exercise = ".$i);

                        foreach($norma as $key)
                        {
                            $array[] = $key->Value;
                        }


                        if($i != 9)
                        {
                            if($exercise->Value >= $norma[0]->Value)
                                echo $exercise->Value . " > " . $norma[0]->Value;
                            else if ($exercise->Value < $norma[0]->Value && $exercise->Value >= $norma[1]->Value)
                                echo $norma[0]->Value . " --- " . $exercise->Value . " --- " . $norma[1]->Value;
                            else if($exercise->Value < $norma[1]->Value && $exercise->Value >= $norma[2]->Value)
                                echo $norma[1]->Value . " --- " . $exercise->Value . " --- " . $norma[2]->Value;
                            else if($exercise->Value < $norma[2]->Value && $exercise->Value >= $norma[3]->Value)
                                echo $norma[2]->Value . " --- " . $exercise->Value . " --- " . $norma[3]->Value;
                            else if($exercise->Value < $norma[3]->Value)
                                echo $exercise->Value . " < " . $norma[3]->Value;
                        }else
                        {

                            if($exercise->Value >= $norma[0]->Value)
                                echo $exercise->Value . " > " . $norma[0]->Value;
                            else if ($exercise->Value < $norma[0]->Value && $exercise->Value >= $norma[1]->Value)
                                echo $norma[0]->Value . " --- " . $exercise->Value . " --- " . $norma[1]->Value;
                            else if($exercise->Value < $norma[1]->Value && $exercise->Value >= $norma[2]->Value)
                                echo $norma[1]->Value . " --- " . $exercise->Value . " --- " . $norma[2]->Value;
                            else if($exercise->Value < $norma[2]->Value)
                                echo $exercise->Value . " < " . $norma[2]->Value;
                        }

                        $i++;
                    @endphp
                </div>
            </div>
        </div>
    @endforeach
</div>
