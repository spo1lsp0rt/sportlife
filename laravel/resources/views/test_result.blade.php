@extends('layout')


@section('title')Результат@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
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

    @if($result->ID_Test == 3)
        @component('task3', ['result' => $result])
        @endcomponent
    @endif

    @if($result->ID_Test == 4)
        @component('task4', ['result' => $result])
        @endcomponent
    @endif

    @if($result->ID_Test == 5)
        @component('task5', ['result' => $result])
        @endcomponent
    @endif

    @php
    if(array_key_exists('ID_User', $_COOKIE))
    {
        $id = DB::table('user')->where('ID_User', $_COOKIE['ID_User'])->value('ID_Role');
    }
    @endphp

    @if(!array_key_exists('ID_User', $_COOKIE))
        @php
            $id_user = DB::table('statistic')->where('ID_Result', $id)->value('ID_User');
                $id_test = DB::table('statistic')->where('ID_Result', $id)->value('ID_Test');
                DB::table('test_user')->where('ID_User', $id_user)->where('ID_Test', $id_test)->delete();
                DB::table('statistic')->where('ID_Result', $id)->delete();
                DB::table('result_exercises')->where('ID_Result', $id)->delete();
                DB::table('results')->where('ID_Result', $id)->delete();
        @endphp
    @endif
    @if($id == 2)
    <form action="/clear_statistic/{{$result->ID_Result}}" method="post">
        @csrf
        <button formaction="/clear_statistic/{{$result->ID_Result}}" class="access_btn">Открыть доступ</button>
    </form>
    @endif
@endsection
