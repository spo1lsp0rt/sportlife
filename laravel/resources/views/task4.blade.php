


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
    <div class='container statistic_table'>
        <div class='row'>
            <div class='col col-md-6'>
                <div class='title_field_head'>Уровень физ. работоспособности</div>
            </div>
            <div class='col col-md-6'>
                <div class='title_field'>Сумма</div>
            </div>
            @for($i = 0; $i < 5; $i++)
                <div class='row'>
                    <div class='col col-md-6'>
                        <div class='data_field_head textX_left'>
                            @php
                            if($i == 0)
                                echo 'Низкий';
                            else if($i == 1)
                                echo 'Ниже среднего';
                            else if($i == 2)
                                echo 'Средний';
                            else if($i == 3)
                                echo 'Выше среднего';
                            else if($i == 4)
                                echo 'Высокий';
                            @endphp
                        </div>
                    </div>

                    <div class='col col-md-6'>
                        <div class='data_field'>
                            @php
                                if($i == 0)
                                    echo '500 и более';
                                else if($i == 1)
                                    echo 'при 450-500';
                                else if($i == 2)
                                    echo 'при 400-450';
                                else if($i == 3)
                                    echo 'при 350-400';
                                else if($i == 4)
                                    echo 'при сумме, меньшей 350';
                            @endphp
                        </div>
                    </div>
                </div>
            @endfor

        </div>
    </div>
