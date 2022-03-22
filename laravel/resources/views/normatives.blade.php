@extends('layout')

@section('title')Нормативы@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/normatives.css')}}">
@endsection

@section('main_content')
    <div class="normatives_title">
        <h2>Журнал нормативов</h2>
    </div>
    @php

        $groups = DB::select('select * from class');
        $facultys = DB::select('select * from faculty')

    @endphp
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="parameters_panel">
                    <div class="parameter_name">Выберите группу:</div>
                    <select name="groups" class="form-select" aria-label="Default select example">
                        @foreach($groups as $group)
                            <option name="group{{$group->ID_Class}}" value="{{$group->ID_Class}}">{{$group->Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class='container statistic_table'>
        <div class='row'>
            <div class='col col-md-4'>
                <div class='title_field'>ФИО студента</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Группа</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Бег 2000/3000м<br>(мин.,с)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Прыжок с разбега<br>(м, см)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Прыжок дл./места<br>(м, см)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Челночный бег 3 по 10</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Подтягивание выс./низк.<br>(см)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Крос 3 или 5 км<br>(б/уч.вр.)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field_last'>Метание гранаты<br>(м)</div>
            </div>
        </div>
        <div class='row'>
            <div class='col col-md-4'>
                <div class='data_field'>Алиева Татьяна Алексеевна</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'>ФЭБ31</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last' contenteditable="true">13,50</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'>300</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'>158</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'>8,5</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'>8</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'></div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last'>11</div>
            </div>
        </div>
        <div class='row'>
            <div class='col col-md-4'>
                <div class='data_field total_field_first'>ИТОГО</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'></div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'>13,50</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'>300</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'>158</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'>8,5</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'>8</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field'></div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field data_field_last total_field_last'>11</div>
            </div>
        </div>
    </div>
@endsection