@extends('layout')

@section('title')Нормативы@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/normatives.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
@endsection

@section('main_content')
    <div class="normatives_title">
        <h2>Журнал нормативов</h2>
    </div>
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

    <div class="container">
        <div class="row">
            <div class="col">
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
            </div>
        </div>
    </div>

    <div class='container statistic_table'>
        <div class='row'>
            <div class='col col-md-4'>
                <div class='title_field_head'>ФИО студента</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Группа</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Бег 2000/3000м<br>(мин.,с)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Прыжок с разбега<br>(м, см)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Прыжок дл./места<br>(м, см)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Челночный бег 3 по 10</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Подтягивание выс./низк.<br>(см)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Крос 3 или 5 км<br>(б/уч.вр.)</div>
            </div>
            <div class='col col-md-1'>
                <div class='title_field'>Метание гранаты<br>(м)</div>
            </div>
        </div>
        <div class='row'>
            <div class='col col-md-4'>
                <div class='data_field_head'>Алиева Татьяна Алексеевна</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'>ФЭБ31</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field' contenteditable="true">13,50</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'>300</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'>158</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'>8,5</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'>8</div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'></div>
            </div>
            <div class='col col-md-1'>
                <div class='data_field'>11</div>
            </div>
        </div>
        <div class='row'>
            <div class='col col-md-4'>
                <div class='total_field_head'>ИТОГО</div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'></div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'>13,50</div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'>300</div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'>158</div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'>8,5</div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'>8</div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field'></div>
            </div>
            <div class='col col-md-1'>
                <div class='total_field_last'>11</div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection