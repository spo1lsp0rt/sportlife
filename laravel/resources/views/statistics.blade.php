@extends('layout')

@php
    $user = DB::select("select ID_Role from user where ID_User = ".$_COOKIE['ID_User']);
    if($user[0]->ID_Role != 2){
        header('Location: /');
        exit();
    }
@endphp

@section('title')Нормативы@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/combobox.css')}}">
@endsection

@section('main_content')

    @if(!session('statistic'))
        <div class="alert alert-info text-center">
                Выберите Факультет/группу и пол
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="statistics_title">
                <h2>Статистика</h2>
            </div>
        </div>

        @php
            $groups = DB::select('select * from class');
            $arr_groups = array('#Группы');
            foreach ($groups as $group) {
                $arr_groups[] = $group->Name;
            }

            $faculties = DB::select('select * from faculty');
            $arr_faculties = array('#Факультеты');
            $arr_faculties[] = 'Все факультеты';
            foreach ($faculties as $faculty)
                $arr_faculties[] = $faculty->Name;

            $arr_genders = array('Юноши', 'Девушки');
        @endphp
        <script type="text/javascript">
            let arr_groups = <?php echo json_encode($arr_groups); ?>;
            let arr_faculties = <?php echo json_encode($arr_faculties); ?>;
            let arr_genders = <?php echo json_encode($arr_genders); ?>;
            let arr_options = [arr_faculties.concat(arr_groups), arr_genders];
        </script>
        <div class="row">
            <div class="parameters_panel">
                <form class="parameters_form" action="/getStatistic" method="post">
                    @csrf
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
                    <button type="submit" class="show_btn">Вывести</button>
                </form>
            </div>
        </div>
        @php
            $statistic = null;
            if(session('statistic'))
                $statistic = session('statistic');

        @endphp
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="align-middle">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Виды испытаний</th>
                        <th scope="col">Пол испытуемых</th>
                        <th scope="col">Кол-во испытуемых</th>
                        <th scope="col">X<sub>ср</sub></th>
                        <th scope="col">Норматив</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    @if($statistic && $statistic['normativesForTest1'] && $statistic['test1'])
                        @php $OYFK = 0; $statistic['test1'][0]->Name = rtrim($statistic['test1'][0]->Name, '(отжимания выполняются юношами от пола, девушками от предметов не выше 50 см).'); @endphp
                        @for($i = 0; $i < 6; $i++)
                            <tr>
                                <th scope="row">{{$statistic['normativesForTest1'][$i]->ID_Exercise}}</th>
                                <td>{{$statistic['test1'][$i]->Name}}</td>
                                <td>{{session('gender')}}</td>
                                <td>{{$statistic['test1'][$i]->count}}</td>
                                <td>{{round($statistic['test1'][$i]->avg, 2)}}</td>
                                <td>@if($i==4)≤@elseif($i==5)≥@endif{{$statistic['normativesForTest1'][$i]->min}} – @if($i==4)≤@elseif($i==5)≥@endif{{$statistic['normativesForTest1'][$i]->max}}</td>
                            </tr>
                            @php
                                if ($statistic['test1'][$i]->Name == "Ловля падающей линейки.")
                                {
                                    $OYFK += (-1) * round(( $statistic['test1'][$i]->avg - $statistic['test1'][$i]->Norma) / $statistic['test1'][$i]->Norma, 2);
                                }
                                else
                                    $OYFK += round(( $statistic['test1'][$i]->avg - $statistic['test1'][$i]->Norma) / $statistic['test1'][$i]->Norma, 2);
                            @endphp
                        @endfor
                        @php $OYFK = round($OYFK / 7, 2); @endphp
                        <tr>
                            <th scope="row">7</th>
                            <td>Значение общего уровня физических кондиций (ОУФК) для 6-ти испытаний</td>
                            <td>{{session('gender')}}</td>
                            <td>{{$statistic['test1'][$i]->count}}</td>
                            <td>{{$OYFK}}</td>
                            <td>от – 1 до +1 </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="align-middle">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Виды испытаний</th>
                        <th scope="col">Пол испытуемых</th>
                        <th scope="col">Кол-во испытуемых</th>
                        <th scope="col">X<sub>ср</sub></th>
                        <th scope="col">Норматив</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    @if($statistic && $statistic['normativesForTest2'] && $statistic['test2'])
                        @php
                            unset($statistic['test2'][3]); $statistic['test2'] = array_values($statistic['test2']);
                            unset($statistic['normativesForTest2'][2]); $statistic['normativesForTest2'] = array_values($statistic['normativesForTest2']);
                        @endphp
                        @for($i = 0; $i< 8; $i++)
                            @php $statistic['test2'][$i]->Name = rtrim($statistic['test2'][$i]->Name, 'жен.муж') @endphp
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <td>{{$statistic['test2'][$i]->Name}}</td>
                                <td>{{session('gender')}}</td>
                                <td>{{$statistic['test2'][$i]->count}}</td>
                                <td>{{round($statistic['test2'][$i]->avg, 2)}}</td>
                                <td> от {{$statistic['normativesForTest2'][$i]->min}} до {{$statistic['normativesForTest2'][$i]->max}} </td>
                            </tr>
                        @endfor
                    @endif
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="align-middle">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Виды испытаний</th>
                        <th scope="col">Пол</th>
                        <th scope="col">Результат</th>
                        <th scope="col">Уровень</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    @if($statistic && $statistic['normativesForTest2'] && $statistic['test2'])
                        @php $levels = set_level($statistic['test2'], session('gender')); @endphp
                        @for($i = 0; $i< 8; $i++)
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <td>{{$statistic['test2'][$i]->Name}}</td>
                                <td>{{session('gender')}}</td>
                                <td>{{round($statistic['test2'][$i]->avg, 2)}}</td>
                                <td>{{$levels[$i]}}</td>
                            </tr>
                        @endfor
                    @endif
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="align-middle">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Показатели</th>
                        <th scope="col">17 лет<br><center>(n=4)</center></th>
                        <th scope="col">18-22 года<br><center>(n=483)</center></th>
                        <th scope="col">23 и старше<br><center>(n=23)</center></th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    <tr>
                        <th scope="row">1</th>
                        <td>ОУФК (оценка собственного уровня физического развития)</td>
                        <td>0,361</td>
                        <td>0,42</td>
                        <td>0,24</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="align-middle">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Виды испытаний</th>
                        <th scope="col">Пол испытуемых</th>
                        <th scope="col">Кол-во испытуемых</th>
                        <th scope="col">X<sub>ср</sub></th>
                        <th scope="col">Норматив</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    @if($statistic && $statistic['ofp'] && $statistic['ofp_normatives'])
                        @for($i = 0, $k = 0; $i < 9; $i++)
                            <tr>
                                <th scope="row">{{$i+1}}</th>
                                <td>{{$statistic['ofp_normatives'][$i]->name}} @if(session('gender') == "Юноши"){{$statistic['ofp_normatives'][$i]->male_normative}}@else{{$statistic['ofp_normatives'][$i]->female_normative}}@endif {{$statistic['ofp_normatives'][$i]->unit}}</td>
                                <td>{{session('gender')}}</td>
                                @if($k < count($statistic['ofp']) && $statistic['ofp'][$k]->id_normative == $statistic['ofp_normatives'][$i]->id)
                                    <td> {{$statistic['ofp'][$k]->count}}</td>
                                    <td>{{round($statistic['ofp'][$k]->avg, 2)}}</td>
                                    @php $k++; @endphp
                                @else
                                    <td>0</td>
                                    <td>0</td>
                                @endif
                                @if(session('gender') == "Юноши")
                                <td>{{$statistic['ofp_normatives2'][$i]->minmn}}  - {{$statistic['ofp_normatives2'][$i]->maxmn}}</td>
                                @else
                                    <td>{{$statistic['ofp_normatives2'][$i]->minfn}}  - {{$statistic['ofp_normatives2'][$i]->maxfn}}</td>
                                @endif
                            </tr>
                        @endfor
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection
