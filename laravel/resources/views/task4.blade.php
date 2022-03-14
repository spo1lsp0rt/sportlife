


    @php
        $i = 1;
        $summ = 0;
    @endphp
    @foreach($result->Exercises as $key => $exercise)
        @php

            if($i == 2){
                $summ -= $exercise->Value;
            }else{
                $summ += $exercise->Value;
            }
            $i++;
        @endphp
    @endforeach
    @php
    $str = '';
    if($summ <= 350)
        $str .= $summ .' '. 'Высокий';
    else if($summ > 350 && $summ <= 400)
        $str .= $summ .' '. 'Выше среднего';
    else if($summ > 400 && $summ <= 450)
        $str .= $summ .' '. 'Средний';
    else if($summ > 450 && $summ <= 500)
        $str .= $summ .' '. 'Ниже среднего';
    else if($summ > 500)
        $str .= $summ .' '. 'Низкий';
    @endphp

    <div class="result_title"><h2> Ваш уровень работоспособности {{$str}}</h2></div>
