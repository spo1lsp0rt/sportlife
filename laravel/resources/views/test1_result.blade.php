@extends('layout')

@section('title')Результат@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_result.css')}}">
@endsection

@section('main_content')

    <div class="result_title"><h2>Результаты тестирования</h2></div>

    <div class="result_table">
        <div class='container'>
            <div class='row'>
                <div class='col col-md-5'>
                    <div class='title_field'>Тест</div>
                </div>
                <div class='col col-md-3'>
                    <div class='title_field'>Результат</div>
                </div>
                <div class='col col-md-2'>
                    <div class='title_field'>НВП</div>
                </div>
                <div class='col col-md-2'>
                    <div class='title_field_last'>Оценка</div>
                </div>
            </div>

            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Отжимания</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>


            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Поднимание туловища</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>

            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Наклон вперед</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>

            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Удержание упора</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>

            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Ловля линейки</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>

            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Удержание равновесия</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>

            <div class='row'>
                <div class='col col-md-5'>
                    <div class='data_field'>Теппинг-тест</div>
                </div>
                <div class='col col-md-3'>
                    <div class='data_field'>0,53</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field'>0,61</div>
                </div>
                <div class='col col-md-2'>
                    <div class='data_field_last'>1</div>
                </div>
            </div>

        </div>
    </div>

    <div class="result_total">
        <h3>Общий уровень развития физических кондиций</h3>
        <div class="total_counting">ОУФК = (О + ПТ + Н + У + ЛЛ + УР + ТТ) : 7 = 80</div>
    </div>

@endsection
