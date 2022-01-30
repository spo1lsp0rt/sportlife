@extends('layout')

@section('title')Результат@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_result.css')}}">
@endsection

@section('main_content')

    @if($result->ID_Test == 1)
        @component('task1', ['result' => $result])
        @endcomponent
    @endif

    @if($result->ID_Test == 2)
        @component('task2', ['result' => $result])
        @endcomponent
    @endif

    <form action="#">
        <button formaction="#" class="access_btn">Открыть доступ</button>
    </form>
@endsection
