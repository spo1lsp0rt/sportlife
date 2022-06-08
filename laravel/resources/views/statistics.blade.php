
@extends('layout')

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

            $arr_genders = array('Все', 'Юноши', 'Девушки');
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
                        @for($i = 0; $i < 6; $i++)
                            <tr>
                                <th scope="row">{{$statistic['normativesForTest1'][$i]->ID_Exercise}}</th>
                                <td>{{$statistic['test1'][$i]->Name}}</td>
                                <td>{{session('gender')}}</td>
                                <td>{{$statistic['test1'][$i]->count}}</td>
                                <td>{{$statistic['test1'][$i]->avg}}</td>
                                <td>{{$statistic['normativesForTest1'][$i]->min}}-{{$statistic['normativesForTest1'][$i]->max}}</td>
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
                        <th scope="col">Пол испытуемых</th>
                        <th scope="col">Кол-во испытуемых</th>
                        <th scope="col">X<sub>ср</sub></th>
                        <th scope="col">Норматив</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    <tr>
                        <th scope="row">1</th>
                        <td>Индекс массы тела (г/см)</td>
                        <td>Юноши</td>
                        <td>330</td>
                        <td>398,75</td>
                        <td>от 501 и > до < 375</td>
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
                        <th scope="col">Пол</th>
                        <th scope="col">Результат</th>
                        <th scope="col">Уровень</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 3; white-space: nowrap;">
                    <tr>
                        <th scope="row">1</th>
                        <td>Индекс массы тела (г/см)</td>
                        <td>Юноши</td>
                        <td>398,75</td>
                        <td>в. среднего</td>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Бег 2000/3000 м, (мин, с)</td>
                        <td>Юноши</td>
                        <td>68</td>
                        <td>15,58</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('scriptsheet')
    <script src="{{ asset('js/combobox.js') }}"></script>
@endsection
