@extends('tests')

@section('testform_stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/testform.css')}}">
@endsection

@section('testform')

    <a href="/" class="form_link">
        <div class="tests_form">
            {{--@yield('testform_title')  @yield('testform_name')  @yield('testform_descr')--}}
            <div class="form_title">Тест №1</div>
            <div class="form_divider"></div>
            <div class="testname_case">
                <div class="form_testname_title">Название:</div>
                <div class="form_testname">Работа с собственным весом</div>
            </div>
            <div class="testdescr_case">
                <div class="form_testdescr_title">Описание:</div>
                <div class="form_testdescr_field">
                    <div class="form_testdescr">Представленные в тесте упражнения рассчитаны на силовую нагрузку мышц ног и
                        работе с собственным весом в домашних условиях для повышения тонуса.</div>
                </div>
            </div>
        </div>
    </a>
@endsection
