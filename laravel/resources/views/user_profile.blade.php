@extends('layout')

@section('title')Ваш профиль@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/modal.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/user_profile.css')}}">
@endsection

@section('main_content')

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

    <div class="container">
        @if(session('add_success'))
                <div class="alert alert-success">{{session('add_success')}}</div>
        @endif
            @if(session('update_success'))
                <div class="alert alert-success">{{session('update_success')}}</div>
            @endif
        <div class="user_profile">
            <div class="profile_title"><h2>Профиль</h2></div>
            <div class="profile_img">
                <img src="/img/profile_img.png" alt="profile">
            </div>
            <div class="profile_panel">
                <div class="profile_name">{{$currentUser->FullName}}</div>
            </div>
            @if($currentUser->ID_Role == 1)
                @yield('user_statistic')
            @endif
            @if($currentUser->ID_Role == 2)
                @php
                    $groups = DB::select('select * from class');
                    $arr_groups = array();
                    foreach ($groups as $group) {
                        $arr_groups[] = $group->Name;
                    }

                    $faculties = DB::select('select * from faculty');
                    $arr_faculties = array();
                    foreach ($faculties as $faculty)
                        $arr_faculties[] = $faculty->Name;
                @endphp
                <script type="text/javascript">
                    let arr_groups = <?php echo json_encode($arr_groups); ?>;
                    let arr_faculties = <?php echo json_encode($arr_faculties); ?>;
                    let arr_options = [arr_faculties, arr_groups];
                </script>
                <div class="parameters_panel">
                    <div class="faculties_combobox">
                        <div name="faculty" class="combo js-combobox">
                            <input name="group" aria-autocomplete="none" aria-controls="faculties-listbox" aria-haspopup="faculties-listbox" id="faculties-combo" class="combo-input" role="combobox" type="text">
                            <div class="combo-menu" role="listbox" id="faculties-listbox"></div>
                        </div>
                    </div>
                    <div class="group_combobox">
                        <div name="group" class="combo js-combobox">
                            <input name="group" aria-autocomplete="none" aria-controls="groups-listbox" aria-haspopup="groups-listbox" id="groups-combo" class="combo-input" role="combobox" type="text">
                            <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                        </div>
                    </div>
                </div>

                <div class='container statistic_table'>
                    <div class='row'>
                        <div class='col col-md-2'>
                            <div class='title_field_head'>Дата</div>
                        </div>
                        <div class='col col-md-4'>
                            <div class='title_field'>ФИО</div>
                        </div>
                        <div class='col col-md-4'>
                            <div class='title_field'>Название</div>
                        </div>
                        <div class='col col-md-2'>
                            <div class='title_field'>Результат</div>
                        </div>
                    </div>
                    @php
                        $allStat = DB::select("select * from statistic");
                    @endphp
                    @foreach($allStat as $stat)
                        @php
                            $name_user = DB::table('user')->where('ID_User', $stat->ID_User)->value('FullName');
                            $name_test = DB::table('tests')->where('ID_Test', $stat->ID_Test)->value('Name');
                        @endphp
                        <a href='/test_result/{{$stat->ID_Result}}'>
                            <div class='row'>
                                <div class='col col-md-2'>
                                    <div class='data_field_head'>{{$stat->date_test}}</div>
                                </div>
                                <div class='col col-md-4'>
                                    <div class='data_field'>{{$name_user}}</div>
                                </div>
                                <div class='col col-md-4'>
                                    <div class='data_field textX_left'>{{$name_test}}</div>
                                </div>
                                <div class='col col-md-2'>
                                    <div class='data_field'>5 баллов</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
            @if($currentUser->ID_Role == 3)
                <div class="admin_panel">
                    <h3>Добавление студентов</h3>
                    <form class="upload_form" action="/add_users" method="post" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="file" id="formFile" name="uploadfile">
                        {{--<input type="file" name="uploadfile">--}}
                        <input class="sumbit-upload" type="submit" value="Загрузить">
                    </form>
                    <form method="post" action="delete_student">
                        @csrf
                    <div class='admin_table'>
                        <div class='container statistic_table'>
                            <div class='row'>
                                <div class='col col-md-1'>
                                    <div class='title_field_head'>№</div>
                                </div>
                                <div class='col col-md-4'>
                                    <div class='title_field'>ФИО</div>
                                </div>
                                <div class='col col-md-2'>
                                    <div class='title_field'>Факультет</div>
                                </div>
                                <div class='col col-md-2'>
                                    <div class='title_field'>Группа</div>
                                </div>
                                <div class='col col-md-3'>
                                    <div class='title_field'>Действия</div>
                                </div>
                            </div>
                            @php
                                $students = @DB::select('select * from student');
                            @endphp
                            @foreach($students as $student)
                                @php
                                    $class = DB::table('class')->where('ID_Class', $student->ID_Class)->value('Name');
                                    $faculty = DB::table('faculty')->where('id_faculty', DB::table('class')->where('ID_Class', $student->ID_Class)->value('id_faculty'))->value('Name');
                                @endphp
                                    <div class='row'>
                                        <div class='col col-md-1'>
                                            <div  class='data_field_head'><input name="{{$student->ID_Student}}" type="checkbox" style="transform:scale(1.4);">
                                            </div>
                                        </div>
                                        <div class='col col-md-4'>
                                            <div class='data_field textX_left'>{{$student->FullName}}</div>
                                        </div>
                                        <div class='col col-md-2'>
                                            <div class='data_field'>{{$faculty}}</div>
                                        </div>
                                        <div class='col col-md-2'>
                                            <div class='data_field'>{{$class}}</div>
                                        </div>
                                        <div class='col col-md-3'>
                                            <div id="{{$student->FullName}}" class='data_field'>
                                                <button class="modal_btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                    Редактировать
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                        <button class="user_delbtn">Удалить пользователя(-ей)</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    @php

    $groups = DB::select('select * from class');
    $facultys = DB::select('select * from faculty')

    @endphp

    <script>
        function getParentId(el) {
            const id = el.parentElement.id;
            document.getElementById('out1').value = `${id}`;
            document.getElementById('out2').value = `${id}`;
        }

        let btns = document.querySelectorAll('button');
        btns.forEach((btn) => {
            btn.addEventListener('click', () => {
                getParentId(btn);
            });
        });
    </script>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <input type="text" name="new_fio" id="out1" class="form-control" value="" >
                                    <input type="hidden" name="old_fio" id="out2" class="form-control" value="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <select name="groups" class="form-select" aria-label="Default select example">
                                        @foreach($groups as $group)
                                            <option name="group{{$group->ID_Class}}" value="{{$group->ID_Class}}">{{$group->Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button formaction="updateStudent" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection
