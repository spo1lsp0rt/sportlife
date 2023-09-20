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

@section('title')
    Ваш профиль
@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/modal.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/myTable.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/user_profile.css')}}">
@endsection

@section('main_content')
    <div class="container">
        @if(session('changePassword_success'))
            <div class="alert alert-success text-center">{{session('changePassword_success')}}</div>
        @endif
        @if(session('changeGroup_success'))
            <div class="alert alert-success text-center">{{session('changeGroup_success')}}</div>
        @endif
        @if(session('add_success'))
            <div class="alert alert-success text-center">{{session('add_success')}}</div>
        @endif
        @if(session('update_success'))
            <div class="alert alert-success text-center">{{session('update_success')}}</div>
        @endif
        @if(session('delete_success'))
            <div class="alert alert-success text-center">{{session('delete_success')}}</div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger text-center">
                <li>{{$error}}</li>
            </div>
        @endforeach
        @php
            $closeUpdate = false;
            // Запретить редактирование профиля, если студент неактивен
            if(DB::table('user')->where('ID_User', $_COOKIE['ID_User'])->value('id_class') == 0)
                $closeUpdate = true;
        @endphp
        <div class="user_profile">
            <div class="profile_title"><h2>Профиль</h2></div>
            <div class="profile_img">
                <img src="/img/profile_img.png" alt="profile">
            </div>
            <div class="profile_panel">
                <div class="profile_name">{{$currentUser->FullName}}</div>
                @if($currentUser->ID_Role == 1 && !$closeUpdate)
                    <button class="modal_btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">
                        <img src="img/edit.png" alt="Редактировать">
                    </button>
                @endif
            </div>
            @if($currentUser->ID_Role == 1)
                @php
                    if(!array_key_exists('login', $_COOKIE))
                    {
                        header('Location: /authorization');
                        exit;
                    }


                    $stats = array();

                    $allStat = DB::select('select * from statistic');
                    $allUsers = DB::select('select * from user');
                    $currentUser = null;
                    foreach($allUsers as $user)
                    {
                        if($user->ID_User == $_COOKIE['ID_User'])
                        {
                            $currentUser = $user;
                            break;
                        }
                    }

                    $active_comboval = DB::table('class')->where('ID_Class', $_COOKIE['ID_User'])->value('Name');
                    // Дата, когда доступен combobox для смены группы у студента
                    $activeGroupChange = false;
                    if(date("m.d") >= "08.01" && date("m.d") <= "09.01")
                        $activeGroupChange = true;
                @endphp


                <div class="container">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="align-middle">
                                <tr>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Название</th>
                                </tr>
                                </thead>
                                <tbody style="line-height: 3; white-space: nowrap;">
                                @foreach($allStat as $stat)
                                    @if($stat->ID_User != $currentUser->ID_User)
                                        @continue
                                    @endif
                                    @php
                                        $name_test = DB::table('tests')->where('ID_Test', $stat->ID_Test)->value('Name');
                                    @endphp
                                    <tr>
                                        <th class="p-0" scope="row"><a
                                                    href="/test_result/{{$stat->ID_Result}}">{{$stat->date_test}}</a>
                                        </th>
                                        <td class="p-0"><a href="/test_result/{{$stat->ID_Result}}">{{$name_test}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Редактирование</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="/change_password" method="post">
                                        @csrf
                                        <div class="row"><h5 class="text-center"><u>Изменение пароля</u></h5></div>
                                        <div class="row">
                                            <div class="col">
                                                <input spellcheck="false" type="password" name="old_password"
                                                       class="form-control" placeholder="Введите старый пароль"
                                                       autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input spellcheck="false" type="password" name="password"
                                                       class="form-control" placeholder="Введите новый пароль"
                                                       autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input spellcheck="false" type="password" name="password_confirmation"
                                                       class="form-control" placeholder="Введите новый пароль повторно"
                                                       autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <button class="btn btn-success">Сменить пароль</button>
                                    </form>
                                    <form action="/change_group" method="post">
                                        @csrf
                                        <div class="row mt-3"><h5 class="text-center"><u>Изменение группы</u></h5></div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="group_combobox">
                                                    <div name="group" class="combo js-combobox">
                                                        <input @if(!$activeGroupChange) disabled
                                                               @endif spellcheck="false" name="group" autocomplete="off"
                                                               aria-controls="groups-listbox"
                                                               aria-haspopup="groups-listbox" id="groups-combo"
                                                               class="combo-input"
                                                               role="combobox" type="text">
                                                        <div class="combo-menu" role="listbox"
                                                             id="groups-listbox"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button @if(!$activeGroupChange) disabled @endif class="btn btn-success">
                                            Поменять группу
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
            @if($currentUser->ID_Role == 2)
                @php
                    $allStat = DB::select("CALL getStatistic(1)");
                    if(session('statistic'))
                        $allStat = session('statistic');
                    $id_class = 1;
                    if(session('id_class'))
                        $id_class = session('id_class');
                    $name_class = DB::table('class')->where('id_class', $id_class)->value('Name');
                    $active_comboval = array($name_class);
                @endphp

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="parameters_panel">
                                <form class="form_parameters" action="/out_testResults" method="post">
                                    @csrf
                                    <div class="group_combobox">
                                        <div name="group" class="combo js-combobox">
                                            <input spellcheck="false" name="group" autocomplete="off"
                                                   aria-controls="groups-listbox"
                                                   aria-haspopup="groups-listbox" id="groups-combo" class="combo-input"
                                                   role="combobox" type="text">
                                            <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                                        </div>
                                    </div>
                                    <button type="submit" class="show_btn">Вывести</button>
                                </form>
                                <a href="/statistics" class="stat_btn"><img src="img/statistic_icon.png"
                                                                            alt="Статистика"></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="align-middle">
                                <tr>
                                    <th scope="col">Дата</th>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Название</th>
                                </tr>
                                </thead>
                                <tbody style="line-height: 3; white-space: nowrap;">
                                @foreach($allStat as $stat)
                                    @php
                                        $name_user = DB::table('user')->where('ID_User', $stat->ID_User)->value('FullName');
                                        $name_test = DB::table('tests')->where('ID_Test', $stat->ID_Test)->value('Name');
                                    @endphp

                                    <tr>
                                        <th class="p-0" scope="row"><a
                                                    href="/test_result/{{$stat->ID_Result}}">{{$stat->date_test}}</a>
                                        </th>
                                        <td class="p-0"><a href="/test_result/{{$stat->ID_Result}}">{{$name_user}}</a>
                                        </td>
                                        <td class="p-0"><a href="/test_result/{{$stat->ID_Result}}">{{$name_test}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            @if($currentUser->ID_Role == 3)
                <div class="admin_panel">
                    <h3>Добавление студентов</h3>
                    <form class="upload_form" action="/add_users" method="post" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="file" id="formFile" name="uploadfile">
                        <input class="sumbit-upload" type="submit" value="Загрузить">
                    </form>
                    @php
                        $faculties = DB::select('select * from faculty');
                        foreach ($faculties as $faculty)
                            $arr_faculties[$faculty->id_faculty] = $faculty->Name;

                        //dd($arr_faculties);
                    @endphp
                    <form class="" action="/add_groups" method="post">
                        @csrf
                        <div class="text-center">
                            Выберите Факультет и напишите имя группы
                        </div>
                        <select name="faculty" class="group_combobox">
                            <?php foreach ($arr_faculties as $key => $faculty): ?>
                                <option value="<?= $key ?>"><?=$faculty?></option>
                            <?php endforeach; ?>
                        </select>
                        <input id="name_group" name="name">
                        <input class="sumbit-upload" type="submit" value="Добавить группу">
                    </form>
                    <h3>Список студентов</h3>

                    <form method="post" action="delete_student">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="table_parameters">
                                        <button class="user_delbtn">Удалить выбранных</button>
                                        <input type="text" id="myInput" class="table_searcher" onkeyup="searchMe(0)"
                                               placeholder="Поиск по имени...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-center">
                                            <thead class="align-middle">
                                            <tr>
                                                <th scope="col">№</th>
                                                <th scope="col">ФИО</th>
                                                <th scope="col">Факультет</th>
                                                <th scope="col">Группа</th>
                                                <th scope="col">Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody id="myTable" style="line-height: 3; white-space: nowrap;">
                                            @php
                                                $students = DB::select('select * from user where ID_Role = 1');
                                            @endphp
                                            @foreach($students as $student)
                                                @php
                                                    $className = DB::table('class')->where('ID_Class', $student->id_class)->value('Name');
                                                    $facultyName = DB::table('faculty')->where('id_faculty', DB::table('class')->where('ID_Class', $student->id_class)->value('id_faculty'))->value('Name');
                                                @endphp
                                                <tr>
                                                    <th scope="row"><input spellcheck="false"
                                                                           name="{{$student->ID_User}}" type="checkbox"
                                                                           style="transform:scale(1.4);"></th>
                                                    <td>{{$student->FullName}}</td>
                                                    <td>{{$facultyName}}</td>
                                                    <td>{{$className}}</td>
                                                    <td id="{{$student->FullName}}">
                                                        <button class="modal_btn" type="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter">
                                                            Редактировать
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <ul class="pagination pagination-lg pager" id="myPager"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{--Модальное окно по нажатии на Редактирование в админ профиле--}}
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Редактирование</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/updateStudent" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <input spellcheck="false" type="text" name="new_fio" id="out1"
                                                       class="form-control">
                                                <input spellcheck="false" type="hidden" name="old_fio" id="out2"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div name="group" class="combo js-combobox">
                                                    <input spellcheck="false" name="group" aria-autocomplete="none"
                                                           aria-controls="groups-listbox" aria-haspopup="groups-listbox"
                                                           id="groups-combo" class="combo-input" role="combobox"
                                                           type="text">
                                                    <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('scriptsheet')
    @if($currentUser->ID_Role == 1)
        @php
            $groups = DB::select('select * from class');
            $arr_groups = array();
            foreach ($groups as $group) {
                $arr_groups[] = $group->Name;
            }
        @endphp
        <script type="text/javascript">
            let arr_groups = <?php echo json_encode($arr_groups); ?>;
            let arr_options = [arr_groups];
        </script>
        <script src="{{ asset('js/combobox.js') }}"></script>
        <script>
            const active_comboval = <?php echo json_encode($active_comboval); ?>;
            const arr_optionEl = document.querySelectorAll('.combo-option');
            arr_optionEl.forEach(function (optionEl) {
                if (active_comboval.includes(optionEl.innerText)) {
                    optionEl.click();
                }
            });
        </script>
    @elseif($currentUser->ID_Role == 2)
        @php
            $groups = DB::select('select * from class');
            $arr_groups = array();
            foreach ($groups as $group) {
                $arr_groups[] = $group->Name;
            }
        @endphp
        <script type="text/javascript">
            let arr_groups = <?php echo json_encode($arr_groups); ?>;
            let arr_options = [arr_groups];
        </script>
        <script src="{{ asset('js/combobox.js') }}"></script>
        <script>
            const active_comboval = <?php echo json_encode($active_comboval); ?>;
            const arr_optionEl = document.querySelectorAll('.combo-option');
            arr_optionEl.forEach(function (optionEl) {
                if (active_comboval.includes(optionEl.innerText)) {
                    optionEl.click();
                }
            });
        </script>
    @elseif($currentUser->ID_Role == 3)
        @php
            $groups = DB::select('select * from class');
            $arr_groups = array();
            foreach ($groups as $group) {
                $arr_groups[] = $group->Name;
            }


        @endphp
        @php


            $faculties = DB::select('select * from faculty');
            $arr_faculties = array('#Факультеты');
            $arr_faculties[] = 'Все факультеты';
            foreach ($faculties as $faculty)
                $arr_faculties[] = $faculty->Name;

        @endphp
        <script type="text/javascript">
            let arr_groups = <?php echo json_encode($arr_groups); ?>;
            let arr_options = [arr_groups];
        </script>
        <script src="{{ asset('js/combobox.js') }}"></script>
        <script>
            var unhide_keys = function () {
                document.getElementById('unhide_btn').style.display = "none";
                document.getElementById('hide_btn').style.display = "block";
                const arr_keyrows = document.querySelectorAll('.key_row');
                arr_keyrows.forEach(function (key) {
                    key.style.display = "table-row";
                });
            }
            var hide_keys = function () {
                document.getElementById('unhide_btn').style.display = "block";
                document.getElementById('hide_btn').style.display = "none";
                hide_some();
            }
            var hide_some = function () {
                var i = 0;
                const arr_keyrows = document.querySelectorAll('.key_row');
                // если количество ключей более 3, отображается кнопка Раскрыть, а в таблице отображается не более двух ключей
                if (arr_keyrows.length > 2) {
                    document.getElementById('unhide_btn').style.display = "block";
                    arr_keyrows.forEach(function (key) {
                        if (i > 1) {
                            key.style.display = "none";
                        }
                        i++;
                    });
                } else if (arr_keyrows.length === 0) {
                    document.getElementById('key_table').style.display = "none";
                }
            }
            hide_some();
        </script>
        <script>
            function getParentId(el) {
                const id = el.parentElement.id;
                document.getElementById('out1').value = `${id}`;
                document.getElementById('out2').value = `${id}`;
            }

            let btns = document.querySelectorAll('.modal_btn');
            btns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    getParentId(btn);
                });
            });
        </script>
        <script src="{{ asset('js/myTable.js') }}"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery('#myTable').pageMe({
                    pagerSelector: '#myPager',
                    showPrevNext: true,
                    hidePageNumbers: false,
                    perPage: 5
                });
            });
        </script>
        <script>
            function searchMe(col, viewCount = 5, myInput = "myInput", myTable = "myTable", myPager = "myPager") {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById(myInput);
                filter = input.value.toUpperCase();
                table = document.getElementById(myTable);
                if (filter === "") {
                    var pager = document.getElementById(myPager);
                    var li = pager.querySelector("li.active");
                    li.getElementsByTagName("a")[0].click();
                } else {
                    tr = table.getElementsByTagName("tr");
                    // Loop through all table rows, and hide those who don't match the search query
                    var viewed = 0;
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[col];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1 && viewed < viewCount) {
                                tr[i].style.display = "";
                                viewed++;
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            }
        </script>
    @endif


@endsection
