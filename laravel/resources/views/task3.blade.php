
@php
    $i = 1;
    $course = '';
@endphp

<div class="result_title"><h2>Результаты тестирования</h2></div>

<div class='container statistic_table'>
    <div class='row'>
        <div class='col col-md-4'>
            <div class='title_field_head'>Проба</div>
        </div>
        <div class='col col-md-2'>
            <div class='title_field'>Результат</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field'>Оценка</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field'>Диапазон</div>
        </div>

    </div>
    @foreach($result->Exercises as $key => $exercise)
        <div class='row'>
            <div class='col col-md-4'>
                <div class='data_field_head textX_left'>{{rtrim($exercise->Name, 'женмуж')}}</div>
            </div>
            <div class='col col-md-2'>
                <div class='data_field'>{{$exercise->Value}}</div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field'>
                    @php
                        if($exercise->Norma == 1) { echo "1";}
                        if($exercise->Norma == 2) { echo "2"; }
                        if($exercise->Norma == 3) { echo "3"; }
                        if($exercise->Norma == 4) { echo "4"; }
                        if($exercise->Norma == 5) { echo "5"; }
                    @endphp
                </div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field'>
                    @php

                        if(stripos($exercise->Name, 'муж'))
                        {
                            $norma = DB::select("select Value from normatives3 where gender = 'муж' AND id_exercise = ".$i+20);
                        }
                        else
                        {
                             $norma = DB::select("select Value from normatives3 where gender = 'муж' AND id_exercise = ".$i+20);
                        }

                        if($i != 4)
                        {
                            if($exercise->Value > $norma[0]->Value)
                                echo $exercise->Value . " > " . $norma[0]->Value;
                            else if ($exercise->Value < $norma[0]->Value && $exercise->Value > $norma[1]->Value)
                                echo $norma[0]->Value . " --- " . $exercise->Value . " --- " . $norma[1]->Value;
                            else if($exercise->Value < $norma[1]->Value && $exercise->Value > $norma[2]->Value)
                                echo $norma[1]->Value . " --- " . $exercise->Value . " --- " . $norma[2]->Value;
                            else if($exercise->Value < $norma[2]->Value && $exercise->Value > $norma[3]->Value)
                                echo $norma[2]->Value . " --- " . $exercise->Value . " --- " . $norma[3]->Value;
                            else if($exercise->Value < $norma[3]->Value)
                                echo $exercise->Value . " < " . $norma[3]->Value;
                        }else
                        {

                            if($exercise->Value > $norma[0]->Value)
                                echo $exercise->Value . " > " . $norma[0]->Value;
                            else if ($exercise->Value < $norma[0]->Value && $exercise->Value > $norma[1]->Value)
                                echo $norma[0]->Value . " --- " . $exercise->Value . " --- " . $norma[1]->Value;
                            else if($exercise->Value < $norma[1]->Value && $exercise->Value > $norma[2]->Value)
                                echo $norma[1]->Value . " --- " . $exercise->Value . " --- " . $norma[2]->Value;
                            else if($exercise->Value < $norma[2]->Value)
                                echo $exercise->Value . " < " . $norma[3]->Value;
                        }

                        $i++;
                    @endphp
                </div>
            </div>
        </div>
    @endforeach
</div>
