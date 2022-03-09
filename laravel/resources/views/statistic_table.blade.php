@extends('user_profile')

@section('user_statistic')


@php

if(!array_key_exists('login', $_COOKIE))
{
    header('Location: /authorization');
    exit;
}

$stats = array();

$allStat = DB::select('select * from statistic');
$allUsers = DB::select('select * from user');
$currentUser = null;
foreach($allUsers as $user)
{
    if($user->ID_User == $_COOKIE['ID_User'])
    {
        $currentUser = $user;
        break;
    }
}
@endphp

    <div class='statistic_table'>
        <div class='container'>
            <div class='row'>
                <div class='col col-md-3'>
                    <div class='title_field'>Дата</div>
                </div>
                <div class='col col-md-6'>
                    <div class='title_field_last'>Название</div>
                </div>
                <div class='col col-md-3'>
                    <div class='title_field_last'>Результат</div>
                </div>
            </div>
    @foreach($allStat as $stat)
        @if($stat->ID_User != $currentUser->ID_User)
            @continue
        @endif
        @php $testname = DB::table('tests')->where('ID_Test', $stat->ID_Test)->value('Name'); @endphp
                <a href='/test_result/{{$stat->ID_Result}}'>
                    <div class='row'>
                        <div class='col col-md-3'>
                            <div class='data_field'>{{$stat->date_test}}</div>
                        </div>
                        <div class='col col-md-6'>
                            <div class='data_field_last'>{{$testname}}</div>
                        </div>
                        <div class='col col-md-3'>
                            <div class='data_field_last'></div>
                        </div>
                    </div>
                </a>
    @endforeach
            </div>
    </div>

@endsection
