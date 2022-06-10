<div class="result_title"><h2>Результаты тестирования</h2></div>
<div class="result_title"><h2>Рабочая таблица для определения суточного расхода энергии</h2></div>
@php
$sum = 0;
@endphp

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered border-dark align-middle text-center">
                <thead class="align-middle">
                <tr>
                    <th scope="col" class="test6">Вид деятельности</th>
                    <th scope="col" class="test6">Время</th>
                    <th scope="col" class="test6">Продолжительность, мин</th>
                    <th scope="col" class="test6">Расход энергии(ккал на 1 кг веса тела)</th>
                </tr>
                </thead>
                <tbody id="myTable" style="line-height: 2; white-space: normal;">
                @foreach($result->Exercises as $key => $exercise)
                    <tr>
                        <th scope="row" class="test6">{{$exercise->Name}}</th>
                        <td class="test6">{{$exercise->Description}}</td>
                        <td class="test6">{{$exercise->Value}}</td>
                        <td class="test6">{{$exercise->Norma}}</td>
                    </tr>
                    @php $sum += $exercise->Norma; @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="result_total">
        <h3>Итог:{{$sum}}</h3>
    </div>
</div>
