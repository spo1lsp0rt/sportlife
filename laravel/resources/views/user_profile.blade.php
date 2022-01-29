@extends('layout')

@section('title')Ваш профиль@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/user_profile.css')}}">
@endsection

@section('main_content')

    @php
    $currentUser = null;
        if (array_key_exists('login', $_COOKIE))
            {
                foreach($allUsers as $user)
                {
                    if($user->ID_User == $_COOKIE['ID_User'])
                    {
                        $currentUser = $user;
                        break;
                    }
                }
            }
        else
            {
                header('Location: /authorization');
                exit;
            }
    @endphp

    <div class="container">
        <div class="user_profile">
            <div class="profile_title"><h2>Профиль</h2></div>
            <div class="profile_img">
                <img src="/img/profile_img.png" alt="profile">
            </div>
            <div class="profile_panel">
                <div class="profile_name">@php echo $currentUser->FullName; @endphp</div>
            </div>
            @php if($currentUser->ID_Role == 3){ @endphp
            <h4>Добавление студентов</h4>
            <form action="/add_users" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="uploadfile">
                <input type="submit" value="Загрузить">
            </form>
            @php } @endphp
            @php if($currentUser->ID_Role == 1){ @endphp
            @yield('user_statistic')
            @php } @endphp
        </div>
    </div>



@endsection
