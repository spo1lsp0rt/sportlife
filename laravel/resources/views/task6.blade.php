<div class="result_title"><h2>Результаты тестирования</h2></div>
<div class="container">
    <br><h4><center>Рабочая таблица для определения суточного расхода энергии</center></h4>
</div>
@php
$sum = 0;
@endphp
<div class='container statistic_table'>
    <div class='row'>
        <div class='col col-md-4'>
            <div class='title_field_head'>Вид деятельности</div>
        </div>
        <div class='col col-md-2'>
            <div class='title_field'>Время</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field'>Продолжительность, мин</div>
        </div>
        <div class='col col-md-3'>
            <div class='title_field'>Расход энергии(ккал на 1 кг веса тела)</div>
        </div>
    </div>
    @foreach($result->Exercises as $key => $exercise)
        <div class='row'>
            <div class='col col-md-4'>
                <div class='data_field_head'>{{$exercise->Name}}</div>
            </div>
            <div class='col col-md-2'>
                <div class='data_field'></div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field'>{{$exercise->Value}}</div>
            </div>
            <div class='col col-md-3'>
                <div class='data_field'>{{$exercise->Norma}}</div>
            </div>
        </div>
        @php $sum += $exercise->Norma; @endphp
    @endforeach
</div>
<div class="container">
    <br><h4><center>Итог:{{$sum}}</center></h4>
</div>
