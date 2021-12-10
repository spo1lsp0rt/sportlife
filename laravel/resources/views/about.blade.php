@extends('layout')

@section('title')О нас@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/about.css')}}">
@endsection

@section('main_content')

    <div class="ratio ratio-16x9">
        <iframe src="/img/jum-jum.mp4" title="YouTube video" allowfullscreen></iframe>
    </div>

@endsection
