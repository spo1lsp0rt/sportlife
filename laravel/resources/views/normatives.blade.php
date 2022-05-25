@php
    $allUsers = DB::select('select * from user');
    $currentUser = null;
        if (array_key_exists('login', $_COOKIE))
            {
                foreach($allUsers as $user)
                {
                    if($user->ID_User == $_COOKIE['ID_User'])
                    {
                        $currentUser = $user;
                        break;
                    }
                }
            }
        else
            {
                header('Location: /authorization');
                exit;
            }
@endphp

@extends('layout')

@section('title')Нормативы@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/normatives.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
@endsection

@section('main_content')

    @if($currentUser->ID_Role == 1)
        <section class="ofp">
            <div class="container">
                <h1>Оценка уровня физической подготовленности</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card">
                            <img src="/img/run100.gif" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Бег 100м (сек.)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/img/run_long.gif" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Бег 2000м/3000м (мин.,с)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/img/run_shuttle.gif" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Челночный бег 3 по 10 (сек.)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Прыжок с разбега (м,см)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Прыжок в длину с места (м,см)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Метание гранаты 500г/700г (м)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Подтягивание на перекладине низная/высокая (кол-во раз)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Наклон вперед из положения стоя с прямыми ногами на гимнастической скамье (см) </h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Поднимание туловища из положения лежа на спине за 1 мин (кол-во раз)</h5>
                                <input type="text" placeholder="Введите результат" class="ofp_result" class="" name="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="result_btn">Получить результат</button>
            </div>
        </section>
    @else
        @if(session('success_update_ofp'))
            <div class="alert alert-success text-center">{{session('success_update_ofp')}}</div>
        @endif
        <div class="normatives_title">
            <h2>Журнал нормативов</h2>
        </div>
        @php
            $groups = DB::select('select * from class');
            $arr_groups = array();
            foreach ($groups as $group) {
                $arr_groups[] = $group->Name;
            }
            $arr_genders = array('Юноши', 'Девушки');
        @endphp
        <script type="text/javascript">
            let arr_groups = <?php echo json_encode($arr_groups); ?>;
            let arr_genders = <?php echo json_encode($arr_genders); ?>;
            let arr_options = [arr_groups, arr_genders];
        </script>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="parameters_panel">
                        <form class="form_parameters" action="/out_ofp" method="post">
                            @csrf
                            <div class="group_combobox">
                                <div name="group" class="combo js-combobox">
                                    <input name="group" autocomplete="off" aria-controls="groups-listbox" aria-haspopup="groups-listbox" id="groups-combo" class="combo-input" role="combobox" type="text">
                                    <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                                </div>
                            </div>
                            <div class="gender_combobox">
                                <div name="gender" class="combo js-combobox">
                                    <input name="gender" aria-autocomplete="none" aria-controls="gender-listbox" aria-haspopup="gender-listbox" id="gender-combo" class="combo-input" role="combobox" type="text">
                                    <div class="combo-menu" role="listbox" id="gender-listbox"></div>
                                </div>
                            </div>
                            <button type="submit" class="show_btn">Вывести</button>
                        </form>
                    </div>
                    <div class="edit_panel">
                        <button type="button" class="edit_btn" id="edit_btn" onclick="edit()">Изменить результаты</button>
                        <button type="button" class="cancel_btn" id="cancel_btn" onclick="cancel()">Отменить изменения</button>
                        <button type="submit" class="save_btn" id="save_btn" onclick="save()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

        @php
            $ofp_id_class = 1;
            if(session('ofp_id_class'))
                $ofp_id_class = session('ofp_id_class');
            $normatives = DB::select('select * from ofp_normatives');
            $users = DB::select('select * from user where id_class = ' . $ofp_id_class);
            $n = 1;
            //Многомерный массив $total предназначен для подсчета
            // суммы результатов студентов по кнокретному нормативу
            // и
            // количества студентов с результатами по конкретному нормативу
            $total = [];
            for($i = 0; $i < count($normatives); $i++) {
                $total[$i] = array(0, 0);
            }
        @endphp

        <div class='container'>
            <div class='row'>
                <form action="ofp_table" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="align-middle">
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">ФИО студента</th>
                                @foreach($normatives as $normative)
                                    @php $norm = $normative->name . " " . $normative->female_normative . ($normative->female_normative ? "/" : "") . " " . $normative->male_normative . "\n" . $normative->unit;  @endphp
                                    <th scope="col">{{$norm}}</th>
                                @endforeach
                                <th style="border-left: 2px solid black" scope="col">Итог баллов</th>
                            </tr>
                            </thead>
                            <tbody style="line-height: 3; white-space: nowrap;">
                            @foreach($users as $user)
                                @php
                                    $results = DB::select('select * from ofp where id_user =' . $user->ID_User . ' order by id_normative');
                                    $summbal = 0;
                                   //Берем значения выполненных нормативом пользователем
                                   foreach ($results as $test){
                                       //Берем нормативы определенного задания
                                       $ofp_test = DB::select('select * from ofp_assessment_tests where id_ofp_test ='. $test->id_normative);
                                       $gender = DB::select('select gender from userdata where ID_User ='. $user->ID_User);
                                       //dd($results);
                                       if(isset($gender)){
                                           if ($gender[0]->gender == 'муж')
                                           {
                                               if ($test->id_normative == 1 || $test->id_normative == 4 || $test->id_normative == 8)
                                               {
                                                   //Находим нужный балл
                                                   if ($ofp_test[0]->male_normative < $test->result)
                                                       $summbal+= 0;
                                                   else if ($ofp_test[0]->male_normative >= $test->result && $ofp_test[1]->male_normative < $test->result)
                                                       $summbal+= 1;
                                                   else if ($ofp_test[1]->male_normative >= $test->result && $ofp_test[2]->male_normative < $test->result)
                                                       $summbal+= 2;
                                                   else if ($ofp_test[2]->male_normative >= $test->result && $ofp_test[3]->male_normative < $test->result)
                                                       $summbal+= 3;
                                                   else if ($ofp_test[3]->male_normative >= $test->result && $ofp_test[4]->male_normative < $test->result)
                                                       $summbal+= 4;
                                                   else if ($ofp_test[3]->male_normative >= $test->result)
                                                       $summbal+= 5;
                                               }else{
                                                   //dd($ofp_test);
                                                   //Находим нужный балл
                                                   if ($ofp_test[0]->male_normative > $test->result)
                                                       $summbal+= 0;
                                                   else if ($ofp_test[0]->male_normative <= $test->result && $ofp_test[1]->male_normative > $test->result)
                                                       $summbal+= 1;
                                                   else if ($ofp_test[1]->male_normative <= $test->result && $ofp_test[2]->male_normative > $test->result)
                                                       $summbal+= 2;
                                                   else if ($ofp_test[2]->male_normative <= $test->result && $ofp_test[3]->male_normative > $test->result)
                                                       $summbal+= 3;
                                                   else if ($ofp_test[3]->male_normative <= $test->result && $ofp_test[4]->male_normative > $test->result)
                                                       $summbal+= 4;
                                                   else if ($ofp_test[3]->male_normative <= $test->result)
                                                       $summbal+= 5;
                                               }

                                            }else{

                                            }
                                       }

                                   }
                                @endphp
                                <tr>
                                    <th scope="row">{{$n++}}</th>
                                    <td>
                                        <div id="{{$user->FullName}}" class='data_field'>
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                {{$user->FullName}}
                                            </a>
                                        </div>
                                    </td>
                                    @if($results == null)
                                        @for($normative_num = 1; $normative_num <= count($normatives); $normative_num++)
                                            <td>
                                                <input readonly class="result_cell" type="text" contenteditable="false" name="{{$user->ID_User . '_' . $normatives[$normative_num - 1]->id}}">
                                            </td>
                                        @endfor
                                            <td style="border-left: 2px solid black"></td>
                                        @continue
                                    @endif
                                    @for($normative_num = 1, $res_indx = 0; $res_indx < count($results) && $normative_num <= count($normatives); $normative_num++)
                                        @if($results[$res_indx]->id_normative == $normative_num)
                                            <td>
                                                <input readonly class="result_cell" type="text" contenteditable="false" name="{{$user->ID_User . '_' . $results[$res_indx]->id_normative}}" value="{{$results[$res_indx]->result}}">
                                            </td>
                                            @php
                                                $total[$normative_num - 1][0] += $results[$res_indx]->result;
                                                $total[$normative_num - 1][1]++;
                                                if($res_indx + 1 < count($results)) $res_indx++;
                                            @endphp
                                        @else
                                            <td>
                                                <input readonly class="result_cell" type="text" contenteditable="false" name="{{$user->ID_User . '_' . $normatives[$normative_num - 1]->id}}">
                                            </td>
                                        @endif
                                    @endfor
                                    <td style="border-left: 2px solid black">{{$summbal}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot style="line-height: 2; white-space: nowrap;">
                            <tr>
                                <th scope="row" colspan="2">Итого</th>
                                @for($i = 0; $i < count($total); $i++)
                                    @if($total[$i][0] != 0)
                                        <td>{{bcdiv($total[$i][0], $total[$i][1], 1)}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @endfor
                                <td style="border-left: 2px solid black"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="edit_panel">
                        <button hidden type="button" id="edit_btn_primary" >Изменить результаты</button>
                        <button hidden type="button" id="cancel_btn_primary">Отменить изменения</button>
                        <button hidden type="submit" id="save_btn_primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Информация</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center">
                                    <thead class="align-middle">
                                    <tr>
                                        <th scope="col">Норматив</th>
                                        <th style="border-left: 2px solid black" scope="col">Количество баллов</th>
                                    </tr>
                                    </thead>
                                    <tbody style="line-height: 3; white-space: nowrap;">
                                    @foreach($normatives as $normative)
                                        <tr>

                                            @php $norm = $normative->name . " " . $normative->female_normative . ($normative->female_normative ? "/" : "") . " " . $normative->male_normative . "\n" . $normative->unit;  @endphp
                                            <td style="text-align: left">{{$norm}}</td>

                                            <td style="border-left: 2px solid black">баллы</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot style="line-height: 2; white-space: nowrap;">
                                    <tr>
                                        <th style="text-align: left" scope="col">Итого</th>
                                        <th style="border-left: 2px solid black" scope="col">баллы</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scriptsheet')
    <script>
        var listener = function(event){
            event.preventDefault();
        }
        document.querySelectorAll('.result_cell').forEach(function (cell) {
            cell.addEventListener("mousedown", listener, false);
        });
        var edit = function(){
            document.getElementById('edit_btn').style.display="none";  // for hide button
            document.getElementById('cancel_btn').style.display="block";
            document.getElementById('save_btn').style.display="block";
            const arr_rescells = document.querySelectorAll('.result_cell');
            arr_rescells.forEach(function (cell) {
                cell.removeAttribute('readonly');
                cell.removeEventListener('mousedown', listener, false);
            });
            document.getElementById('edit_btn_primary').click()
        }
        var cancel = function(){
            document.getElementById('edit_btn').style.display="block";  // for hide button
            document.getElementById('cancel_btn').style.display="none";
            document.getElementById('save_btn').style.display="none";
            const arr_rescells = document.querySelectorAll('.result_cell');
            arr_rescells.forEach(function (cell) {
                cell.setAttribute('readonly', 'true');
                cell.addEventListener("mousedown", listener, false);
            });
            document.getElementById('cancel_btn_primary').click()
        }
        var save = function(){
            document.getElementById('edit_btn').style.display="block";  // for hide button
            document.getElementById('cancel_btn').style.display="none";
            document.getElementById('save_btn').style.display="none";
            const arr_rescells = document.querySelectorAll('.result_cell');
            arr_rescells.forEach(function (cell) {
                cell.setAttribute('readonly', 'true');
                cell.addEventListener("mousedown", listener, false);
            });
            document.getElementById('save_btn_primary').click()
        }
    </script>
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection
