
@php
    $i = 1;
@endphp

<div class="result_title"><h2>Результаты тестирования</h2></div>

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered border-dark align-middle text-center">
                <thead class="align-middle">
                <tr>
                    <th scope="col">Проба</th>
                    <th scope="col">Результат</th>
                    <th scope="col">Уровнень</th>
                    <th scope="col">Диапазон</th>
                </tr>
                </thead>
                <tbody id="myTable" style="line-height: 2; white-space: normal;">
                @foreach($result->Exercises as $key => $exercise)
                    <tr>
                        <th scope="row">{{rtrim($exercise->Name, 'женмуж')}}</th>
                        <td>{{$exercise->Value}}</td>
                        <td>
                            @php
                                if($exercise->Norma == 1) { echo "Низкий";}
                                if($exercise->Norma == 2) { echo "Ниже среднего"; }
                                if($exercise->Norma == 3) { echo "Средний"; }
                                if($exercise->Norma == 4) { echo "Выше среднего"; }
                                if($exercise->Norma == 5) { echo "Высокий"; }
                            @endphp
                        </td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
