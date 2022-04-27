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
                    <form method="post" action="out_ofp">
                        @csrf
                        <div class="group_combobox">
                            <div name="group" class="combo js-combobox">
                                <input name="group" aria-autocomplete="none" aria-controls="groups-listbox" aria-haspopup="groups-listbox" id="groups-combo" class="combo-input" role="combobox" type="text">
                                <div class="combo-menu" role="listbox" id="groups-listbox"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="edit_panel">
                    <button class="edit_btn" id="edit_btn" onclick="edit()">Изменить результаты</button>
                    <button class="cancel_btn" id="cancel_btn" onclick="cancel()">Отменить изменения</button>
                    <button class="save_btn" id="save_btn" onclick="save()">Сохранить</button>
                </div>

                <script>
                    var edit = function(){
                        document.getElementById('edit_btn').style.display="none";  // for hide button
                        document.getElementById('cancel_btn').style.display="block";
                        document.getElementById('save_btn').style.display="block";
                        const arr_rescells = document.querySelectorAll('.result_cell');
                        arr_rescells.forEach(function (cell) {
                            cell.setAttribute('contenteditable', 'true');
                        });
                    }
                    var cancel = function(){
                        document.getElementById('edit_btn').style.display="block";  // for hide button
                        document.getElementById('cancel_btn').style.display="none";
                        document.getElementById('save_btn').style.display="none";
                        const arr_rescells = document.querySelectorAll('.result_cell');
                        arr_rescells.forEach(function (cell) {
                            cell.setAttribute('contenteditable', 'false');
                        });
                    }
                    var save = function(){
                        document.getElementById('edit_btn').style.display="block";  // for hide button
                        document.getElementById('cancel_btn').style.display="none";
                        document.getElementById('save_btn').style.display="none";
                        const arr_rescells = document.querySelectorAll('.result_cell');
                        arr_rescells.forEach(function (cell) {
                            cell.setAttribute('contenteditable', 'false');
                        });
                    }
                </script>
            </div>
        </div>
    </div>

    @php
    $normatives = DB::select('select * from ofp_normatives');
    $users = DB::select('select * from user where id_class = 1');
    $n = 1;
    @endphp

    <div class='container'>
        <div class='row'>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">ФИО студента</th>
                            @foreach($normatives as $normative)
                                @php $norm = $normative->name . " " . $normative->female_normative . ($normative->female_normative ? "/" : "") . " " . $normative->male_normative . "\n" . $normative->unit;  @endphp
                                <th scope="col">{{$norm}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                        @foreach($users as $user)
                        @php $results = DB::select('select * from ofp where id_user = ' . $user->ID_User . ' order by id_normative'); @endphp
                        @if($results == null) @continue @endif
                        <tr>
                            <th scope="row">{{$n++}}</th>
                            <td>{{$user->FullName}}</td>
                            @for($i = 1, $j = 0; $i <= 6; $i++)
                                @if($results[$j]->id_normative == $i)
                                    <td class="result_cell">{{$results[$j]->result}}</td>
                                    @php $j++ @endphp
                                @else
                                    <td class="result_cell"></td>
                                @endif
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="line-height: 2; white-space: nowrap;">
                        <tr>
                            <th scope="row" colspan="2">Итого</th>
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
