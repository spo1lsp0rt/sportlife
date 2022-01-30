
<div class="result_title"><h2>Результаты тестирования</h2></div>

<div class="result_table">
    <div class='container'>
        <div class='row'>
            <div class='col col-md-5'>
                <div class='title_field'>Проба</div>
            </div>
            <div class='col col-md-3'>
                <div class='title_field_last'>Результат</div>
            </div>
            <div class='col col-md-4'>
                <div class='title_field_last'>Уровнень</div>
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
                <div class='col col-md-4'>
                    <div class='data_field_last'>
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
