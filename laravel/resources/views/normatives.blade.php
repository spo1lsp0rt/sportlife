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
    $UserPoints = array();
    $UserPoints_temp = array();
    $keys = array();
@endphp

@extends('layout')

@section('title')ОФП@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/normatives.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
@endsection

@section('main_content')

    @if($currentUser->ID_Role == 1)
        @php
            $normatives = DB::select('select * from ofp_normatives');
            $results = DB::select('select * from ofp where id_user =' . $currentUser->ID_User . ' order by id_normative');
        @endphp

        <section class="ofp">
            <div class="container">
                <h2>Оценка уровня физической подготовленности</h2>
                <form action="ofp_table" method="post">
                    @csrf
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($normatives as $normative)
                            @php
                                if($currentUser->gender == "муж") {
                                    $norm = $normative->name . " " . $normative->male_normative . "\n" . $normative->unit;
                                }
                                else {
                                    $norm = $normative->name . " " . $normative->female_normative . "\n" . $normative->unit;
                                }
                                $res_val = null;
                                foreach ($results as $result) {
                                    if ($result->id_normative == $normative->id){
                                        $res_val = $result->result;
                                        break;
                                    }
                                }
                            @endphp
                            <div class="col">
                                <div class="card">
                                    <img src="/img/ofp/{{$normative->img}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$norm}}</h5>
                                        @if ($res_val == null)
                                            <input step="any" spellcheck="false" type="number" lang="en" placeholder="Введите результат" class="input_number ofp_result" name="{{$currentUser->ID_User . '_' . $normative->id}}">
                                        @else
                                            <input readonly spellcheck="false" contenteditable="false" type="number" lang="en" placeholder="Введите результат" class="input_number ofp_result" name="{{$currentUser->ID_User . '_' . $normative->id}}" value="{{$res_val}}" autocomplete="off">
                                        @endif
                                        <button type="submit" class="result_btn">Сохранить результат</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </section>
    @else
        @if(session('success_update_ofp'))
            <div class="alert alert-success text-center">{{session('success_update_ofp')}}</div>
        @endif
        <div class="normatives_title">
            <h2>Журнал нормативов</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="form_parameters" action="/out_ofp" method="post">
                        @csrf
                        <div class="parameters_panel">
                                <div class="group_combobox">
                                    <div name="group" class="combo js-combobox">
                                        <input name="group" spellcheck="false" autocomplete="off" aria-controls="groups-listbox" aria-haspopup="groups-listbox" id="groups-combo" class="combo-input" role="combobox" type="text">
                                        <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                                    </div>
                                </div>
                                <div class="gender_combobox">
                                    <div name="gender" class="combo js-combobox">
                                        <input name="gender" spellcheck="false" aria-autocomplete="none" aria-controls="gender-listbox" aria-haspopup="gender-listbox" id="gender-combo" class="combo-input" role="combobox" type="text">
                                        <div class="combo-menu" role="listbox" id="gender-listbox"></div>
                                    </div>
                                </div>
                                <button type="submit" class="show_btn" id="show_btn">Вывести</button>
                        </div>
                    </form>
                    <div class="form_edit">
                        <div class="edit_panel">
                            <button type="button" class="edit_btn" id="edit_btn" onclick="edit()">Изменить результаты</button>
                            <button type="button" class="cancel_btn" id="cancel_btn" onclick="cancel()">Отменить изменения</button>
                            <button type="submit" class="save_btn" id="save_btn" onclick="save()">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $ofp_id_class = 1;
            $ofp_gender = "все";
            if(session('ofp_id_class'))
                $ofp_id_class = session('ofp_id_class');
            if(session('ofp_gender'))
                $ofp_gender = session('ofp_gender');
            $normatives = DB::select('select * from ofp_normatives');
            $ofp_name_class = DB::table('class')->where('id_class', $ofp_id_class)->value('Name');
            if ($ofp_gender == "все") {
                $users = DB::table('user')->where('id_class', $ofp_id_class)->get()->toArray();
            }
            else {
                $users = DB::table('user')->where('id_class', $ofp_id_class)->where('gender', $ofp_gender)->get()->toArray();
            }
            $n = 1;
            //Многомерный массив $total предназначен для подсчета
            // суммы результатов студентов по кнокретному нормативу
            // и
            // количества студентов с результатами по конкретному нормативу
            $total = [];
            for($i = 0; $i < count($normatives); $i++) {
                $total[$i] = array(0, 0);
            }

            //Сбор данных для активации нужных значений комбобокса
            $gender_name = "Все";
            if ($ofp_gender == "муж") {
                $gender_name = "Юноши";
            }
            else if ($ofp_gender == "жен") {
                $gender_name = "Девушки";
            }
            $active_comboval = array($ofp_name_class, $gender_name);
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
                                    @php
                                        if($ofp_gender == "муж") {
                                            $norm = $normative->name . " " . $normative->male_normative . "\n" . $normative->unit;
                                        }
                                        else if($ofp_gender == "жен") {
                                            $norm = $normative->name . " " . $normative->female_normative . "\n" . $normative->unit;
                                        }
                                        else {
                                            $norm = $normative->name . " " . $normative->female_normative . ($normative->female_normative ? "/" : "") . " " . $normative->male_normative . "\n" . $normative->unit;
                                        }
                                    @endphp
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
                                    $points = array('-', '-', '-', '-', '-', '-', '-', '-', '-');
                                    $keys[] = $user->ID_User;
                                   //Берем значения выполненных нормативом пользователем
                                   foreach ($results as $test){
                                       //Берем нормативы определенного задания
                                       $ofp_test = DB::select('select * from ofp_assessment_tests where id_ofp_test ='. $test->id_normative);
                                       $gender = DB::select('select gender from user where ID_User ='. $user->ID_User);
                                       //dd($results);
                                       if(isset($gender)){
                                           getPoints($test, $gender, $ofp_test, $summbal, $points);
                                       }
                                   }

                                   $points[] = $summbal;
                                   /*dd($points);*/
                                   array_push($UserPoints, $points);
                                @endphp
                                <tr>
                                    <th scope="row">{{$n++}}</th>
                                    <td>
                                        <div id="{{$user->ID_User}}" class='data_field'>
                                            <a class="fio" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                {{$user->FullName}}
                                            </a>
                                        </div>
                                    </td>
                                    @if($results == null)
                                        @for($normative_num = 1; $normative_num <= count($normatives); $normative_num++)
                                            <td>
                                                <input step="any" spellcheck="false" readonly class="input_number result_cell" type="number" lang="en" contenteditable="false" name="{{$user->ID_User . '_' . $normatives[$normative_num - 1]->id}}">
                                            </td>
                                        @endfor
                                            <td style="border-left: 2px solid black"></td>
                                        @continue
                                    @endif
                                    @for($normative_num = 1, $res_indx = 0; $res_indx < count($results) && $normative_num <= count($normatives); $normative_num++)
                                        @if($results[$res_indx]->id_normative == $normative_num)
                                            <td>
                                                <input step="any" spellcheck="false" readonly class="input_number result_cell" type="number" lang="en" contenteditable="false" name="{{$user->ID_User . '_' . $results[$res_indx]->id_normative}}" value="{{$results[$res_indx]->result}}">
                                            </td>
                                            @php
                                                $total[$normative_num - 1][0] += $results[$res_indx]->result;
                                                $total[$normative_num - 1][1]++;
                                                if($res_indx + 1 < count($results)) $res_indx++;
                                            @endphp
                                        @else
                                            <td>
                                                <input step="any" spellcheck="false" readonly class="input_number result_cell" type="number" lang="en" contenteditable="false" name="{{$user->ID_User . '_' . $normatives[$normative_num - 1]->id}}">
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

                                                @php
                                                    $norm = $normative->name . " " . $normative->female_normative . ($normative->female_normative ? "/" : "") . " " . $normative->male_normative . "\n" . $normative->unit;  @endphp
                                                <td style="text-align: left">{{$norm}}</td>

                                                <td style="border-left: 2px solid black">
                                                    <div id="out{{$normative->id}}" ></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot style="line-height: 2; white-space: nowrap;">
                                        <tr>
                                            <th style="text-align: left" scope="col">Итого</th>
                                            <th style="border-left: 2px solid black" scope="col">
                                                <div id="out10"></div>
                                            </th>
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

        @php
            $i = 0;
            foreach ($UserPoints as $points){
                $UserPoints_temp["$keys[$i]"] = $points;
                $i++;
            }
        @endphp
    @endif
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/number_handler.js') }}"></script>
    @if($currentUser->ID_Role == 2 || $currentUser->ID_Role == 3)
        @php
            $groups = DB::select('select * from class');
            $arr_groups = array();
            foreach ($groups as $group) {
                $arr_groups[] = $group->Name;
            }
            $arr_genders = array('Все', 'Юноши', 'Девушки');
        @endphp
        <script type="text/javascript">
            let arr_groups = <?php echo json_encode($arr_groups); ?>;
            let arr_genders = <?php echo json_encode($arr_genders); ?>;
            let arr_options = [arr_groups, arr_genders];
        </script>
        <script src="{{ asset('js/combobox.js') }}"></script>
        <script>
            function setPoints(el) {
                const id = el.parentElement.id;
                let matrix = <?php echo json_encode($UserPoints_temp); ?>;
                console.log(matrix);
                let arr_groups;
                let keys = <?php echo json_encode($keys); ?>;
                for(i = 0; i < keys.length; i++){
                    if(keys[i] == id)
                    {
                        arr_groups = matrix[keys[i]];
                        i = keys.length;
                    }
                }
                for (let i = 0; i < arr_groups.length; i++) {
                    var t = i + 1;
                    document.getElementById('out' + t).innerHTML = `${arr_groups[i]}`;
                }
            }
            let btns = document.querySelectorAll('a.fio');
            btns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    setPoints(btn);
                });
            });

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
                document.getElementById('show_btn').click()
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
        <script>
            const active_comboval = <?php echo json_encode($active_comboval); ?>;
            const arr_optionEl = document.querySelectorAll('.combo-option');
            arr_optionEl.forEach(function (optionEl) {
                if (active_comboval.includes(optionEl.innerText))
                {
                    optionEl.click();
                }
            });
        </script>
    @endif
@endsection
