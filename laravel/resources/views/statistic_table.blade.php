@extends('user_profile')

@section('user_statistic')



    <div class="statistic_table">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title_field">Дата</div>
                </div>
                <div class="col">
                    <div class="title_field">Название</div>
                </div>
                <div class="col">
                    <div class="title_field_last">Результат</div>
                </div>
            </div>


            @for($i = 1; $i <= 10; $i++)

                <div class="row">
                    <div class="col">
                        <div class="data_field">09.12.2021</div>
                    </div>
                    <div class="col">
                        <div class="data_field">Оценка собственного ...</div>
                    </div>
                    <div class="col">
                        <div class="data_field_last">ОУФК = 0,61 (Супер)</div>
                    </div>
                </div>
            @endfor

        </div>
    </div>


@endsection
