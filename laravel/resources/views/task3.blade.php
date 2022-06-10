
@php
    $i = 1;
    $course = '';
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
                    <th scope="col">Оценка</th>
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
                                if($exercise->Norma == 1) { echo "1";}
                                if($exercise->Norma == 2) { echo "2"; }
                                if($exercise->Norma == 3) { echo "3"; }
                                if($exercise->Norma == 4) { echo "4"; }
                                if($exercise->Norma == 5) { echo "5"; }
                            @endphp
                        </td>
                        <td>
                            @php

                                if(stripos($exercise->Name, 'муж'))
                                {
                                    $norma = DB::select("select Value from normatives3 where gender = 'муж' AND id_exercise = ".$i+25);
                                }
                                else
                                {
                                     $norma = DB::select("select Value from normatives3 where gender = 'муж' AND id_exercise = ".$i+25);
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
                                }else if ($i == 4)
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
