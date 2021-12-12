@extends('layout')

@section('title')Оценка собственного уровня физической кондиции@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_test.css')}}">
@endsection

@section('main_content')

    <form action="/test/{{$id}}" method="POST">
        @csrf
        <section class="test">
            <div class="container">
                <h1>Контрольная работа №{{$id}}</h1>
            </div>
            <div class="container">
                <h2>{{$test->Name}}</h2>
            </div>

            <div class="container">
                @foreach($test->Exercises as $key => $exercise)
                    <div class="row">
                        <div class="col">
                            <div class="test_task">
                                <div class="test_header">Задание {{$key + 1}}. {!! nl2br(htmlspecialchars($exercise->Name)) !!}
                                </div>
                                <div class="test_info">{!! nl2br(htmlspecialchars($exercise->Description)) !!}
                                </div>

                                <input type="text" placeholder="Введите результат" class="test_result"
                                       class="@error($exercise->getInputName()) is-invalid @enderror" name="{{$exercise->getInputName()}}" value="">
                                @error($exercise->getInputName())
                                <div class="alert alert-danger">{{ 'Поле заполнено некорректно' }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="result_btn">Получить результат</button>
        </section>
    </form>


@endsection
