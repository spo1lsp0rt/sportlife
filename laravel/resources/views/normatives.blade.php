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

    <div class='container'>
        <div class='row'>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">ФИО студента</th>
                            <th scope="col">Группа</th>
                            <th scope="col">Бег 2000/3000м<br>(мин.,с)</th>
                            <th scope="col">Прыжок с разбега<br>(м, см)</th>
                            <th scope="col">Прыжок дл./места<br>(м, см)</th>
                            <th scope="col">Челночный бег 3 по 10<br>(мин.,с)</th>
                            <th scope="col">Подтягивание выс./низк.<br>(см)</th>
                            <th scope="col">Метание гранаты<br>(м)</th>
                        </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                        <tr>
                            <th scope="row">1</th>
                            <td>Иванов Иван Иванович</td>
                            <td>ДИНРб31</td>
                            <td>13,50</td>
                            <td>300</td>
                            <td>158</td>
                            <td>8,5</td>
                            <td>8</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Петров Петр Петрович</td>
                            <td>ДИНРб31</td>
                            <td>12,2</td>
                            <td>280</td>
                            <td>146</td>
                            <td>7,2</td>
                            <td>5</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Прогуляков Прогул Прогулович</td>
                            <td>ДИНРб31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot style="line-height: 2; white-space: nowrap;">
                        <tr>
                            <th scope="row" colspan="2">Итого</th>
                            <td>ДИНРб31</td>
                            <td>12,85</td>
                            <td>290</td>
                            <td>152</td>
                            <td>7,85</td>
                            <td>6,5</td>
                            <td>12,5</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection