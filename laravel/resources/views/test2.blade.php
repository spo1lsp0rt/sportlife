@extends('layout')

@section('title')Оценка собственного уровня функционального состояния@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/style_test.css')}}">
@endsection

@section('main_content')
    <form action="/test2/check" method="POST">
        @csrf
        <section class="test">
            <div class="container">
                <h1>Контрольная работа №2</h1>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <li>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                            </li>
                    </ul>
                </div>
            @endif
            <div class="container">
                <h2>Оценка собственного уровня функционального состояния</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 1. Определение индекса массы тела (индекс Кетле).</div>
                            <input type="text" placeholder="Введите вашу массу тела" class="test_result" name="Weight">
                            <input type="text" placeholder="Введите ваш рост" class="test_result" name="Growth">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 2. Оценка реакции восстановления.</div>
                            <div class="test_info">Условия проведения пробы.
                                <br>
                                До начала упражнения измеряется пульс (ЧСС). Далее тестируемый выполняет 20 приседаний в
                                течение 30 секунд.
                                <br>
                                Результатом данной функциональной пробы является время восстановления пульса (ЧСС) до
                                исходных (перед нагрузкой) значений (мин, сек).
                            </div>
                            <div class="test_comment">
                                Примечание. Оценка пульса (ЧСС) производится в течение 1 минуты. Чтобы получить 1-минутное
                                значение ЧСС можно измерить пульс в течение 10 секунд и умножить на 6, более точное
                                измерение проводится в течение 15 секунд и умножить на 4.
                            </div>
                            <input type="text" placeholder="Введите результат" class="test_result" name="RecoveryReaction">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 3. Оценка реакций сердечно-сосудистой системы (индекс Руфье).
                            </div>
                            <div class="test_info">Условия проведения пробы.
                                <br>
                                <ol>
                                    <li>Измеряется пульс за 15 секунд (<b>Результат 1</b>).</li>
                                    <input type="text" placeholder="Введите результат 1" class="test_result" name="HeartResult1">
                                    <br>
                                    <li>Далее тестируемый выполняет 30 приседаний за 45 секунд, то есть в среднем темпе.
                                    </li>
                                    <li>Сразу после приседаний измеряется пульс за 15 секунд (<b>Результат 2</b>) и через 45
                                        секунд снова определяется количество ударов сердца за 15 секунд (<b>Результат 3</b>).
                                    </li>
                                </ol>
                            </div>
                            <input type="text" placeholder="Введите результат 2" class="test_result" name="HeartResult2">
                            <input type="text" placeholder="Введите результат 3" class="test_result" name="HeartResult3">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 4. Оценка уровня обменно-энергетических процессов организма
                                (индекс Робинсона).
                            </div>
                            <div class="test_info">Данный индекс характеризует систолическую работу сердца. Чем больше этот
                                показатель на высоте физической нагрузки, тем больше функциональная способность мышц
                                сердца. По этому показателю косвенно можно судить о потреблении кислорода миокардом.
                                <br>
                                Условия проведения пробы.
                                <br>
                                <ol>
                                    <li>После 5-минутного отдыха определите пульс за одну минуту в положении стоя (уд/мин).
                                    </li>
                                    <input type="text" placeholder="Введите частоту пульса" class="test_result" name="Pulse">
                                    <br>
                                    <li>Измерьте свое артериальное давление и запомните его «верхнее» значение.
                                    </li>
                                    <input type="text" placeholder="Введите показание артериального давления"
                                           class="test_result" name="ArterialPressure">
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_warn">Внимание! Пробы с задержкой дыхания лицам с какими-либо заболеваниями
                            органов дыхания следует выполнять с осторожностью либо вообще не следует выполнять!
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 5. Оценка состояния дыхательной системы (проба Штанге).</div>
                            <div class="test_info">Проба Штанге – время задержки дыхания на вдохе (сек).
                                <br>
                                Условия проведения пробы.
                                <br>
                                <ol>
                                    <li>Сесть на стул, удобно оперевшись о его спинку, и расслабить мышцы.</li>
                                    <li>Сделать глубокий вдох и выдох, затем снова вдох (примерно 80% от максимального) и
                                        задержать дыхание, зажав пальцами нос.
                                    </li>
                                    <li>По секундомеру (или секундной стрелки часов) фиксируется время максимальной
                                        задержки дыхания (сек).
                                    </li>
                                </ol>
                            </div>
                            <input type="text" placeholder="Введите результат" class="test_result" name="StangeTest">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 6. Оценка состояния дыхательной системы (проба Генче).</div>
                            <div class="test_info">Проба Генче – время задержки дыхания на выдохе (сек).
                                <br>
                                Условия выполнения теста.
                                <br>
                                <ol>
                                    <li>Сесть на стул, удобно оперевшись о его спинку, и расслабить мышцы.</li>
                                    <li>Сделать глубокий вдох и выдох, затем снова вдох и на максимальном выдохе задержать
                                        дыхание, зажав пальцами нос.
                                    </li>
                                    <li>По секундомеру (или секундной стрелки часов) фиксируется время максимальной задержки
                                        дыхания (сек).
                                    </li>
                                </ol>
                            </div>
                            <div class="test_comment">
                                Примечание. По функциональным особенностям дыхательной системы время задержки дыхания на
                                выдохе всегда меньше, чем время задержки дыхания на вдохе.
                                Если проба Генче выполняется сразу после пробы Штанге, то необходим отдых между пробами
                                7-10 минут.
                            </div>
                            <input type="text" placeholder="Введите результат" class="test_result" name="StangeTest">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 7. Трехфазная проба (проба Серкина).
                            </div>
                            <div class="test_info">Данная комплексная проба оценивает функцию дыхания и состоит из 3-х фаз:
                                <br>
                                <ol>
                                    <li>После пятиминутного отдыха определить время задержки дыхания на вдохе в положении
                                        сидя (сек).
                                    </li>
                                    <li>Выполнить 20 приседаний за 30 секунд и вновь определить время задержки дыхания на
                                        вдохе (сек).
                                    </li>
                                    <li>Отдохнуть ровно 1 минуту (в положении стоя) и повторить фазу 1.
                                    </li>
                                </ol>
                                Итоговая оценка производится по результатам фазы 3 (сек).
                            </div>
                            <input type="text" placeholder="Введите результат" class="test_result" name="SerkinTest">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 8. Оценка вегетативных реакций на нагрузку (ортостатическая
                                проба).
                            </div>
                            <div class="test_info">Условия проведения пробы.
                                <br>
                                <ol>
                                    <li>В положении лежа подсчитывается пульс за 10 сек и умножается на 6.</li>
                                    <input type="text" placeholder="Введите результат" class="test_result">
                                    <br>
                                    <li>Затем нужно спокойно встать и подсчитать пульс в положении стоя.
                                    </li>
                                    <input type="text" placeholder="Введите результат" class="test_result" name="OrthostaticTest">
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="test_task">
                            <div class="test_header">Задание 9. Оценка вегетативных реакций на нагрузку (клиностатическая
                                проба).
                            </div>
                            <div class="test_info">Условия проведения пробы.
                                <br>
                                <ol>
                                    <li>В положении стоя подсчитывается пульс за 10 сек и умножается на 6.</li>
                                    <input type="text" placeholder="Введите результат" class="test_result">
                                    <br>
                                    <li>Затем нужно спокойно лечь и подсчитать пульс в положении лежа.
                                    </li>
                                    <input type="text" placeholder="Введите результат" class="test_result" name="ClinostaticTest">
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <button class="result_btn">Получить результат</button>
        </section>
    </form>

@endsection
