@extends('layout')

@section('title')Ваш профиль@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/statistic_table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/user_profile.css')}}">
@endsection

@section('main_content')

    <div class="user_profile">
        <div class="profile_img">
            <img src="/img/profile_img.png" alt="profile">
        </div>
        <div class="profile_panel">
            <div class="profile_name">Иванов Иван Иванович</div>
            <form action="#">
                <button formaction="#" class="edit_profile_btn">
                    <img src="/icons/edit.png" alt="edit">
                </button>
            </form>
        </div>

        @yield('user_statistic')
    </div>

@endsection
