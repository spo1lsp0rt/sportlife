@extends('tests')

@section('testform_stylesheet')
    <link rel="stylesheet" type="text/css" href="{{url('css/testform.css')}}">
@endsection

@section('testform')
    <?php
    class TestData
    {
        public $n;
        public $name;
        public $description;
        // конструктор
        public function __construct($n, $name, $description)
        {
            $this->n = $n;
            $this->name = $name;
            $this->description = $description;
        }
        // геттеры
        public function getN() { return $this->n; }
        public function getName() { return $this->name; }
        public function getDescription() { return $this->description; }
        // сеттеры
        public function setN($n) { $this->n = $n; }
        public function setName($name) { $this->name = $name; }
        public function setDescription($description) { $this->description = $description; }
    }

        $tests = array(
            new TestData(1, "Работа 1", "Описание работы №1"),
            new TestData(2, "Работа 2", "Описание работы №2")
        );
        foreach ($tests as &$var)
        {
            echo "
                <a href='/' class='form_link''>s
                    <div class='tests_form'>
                        <div class='form_title'>Тест №" .  $var->n . "</div>
                        <div class='form_divider'></div>
                        <div class='testname_case'>
                            <div class='form_testname_title'>Название:</div>
                            <div class='form_testname'>" . $var->name . "</div>
                        </div>
                        <div class='testdescr_case'>
                            <div class='form_testdescr_title'>Описание:</div>
                            <div class='form_testdescr_field'>
                                <div class=\"form_testdescr\">" . $var->description . "</div>
                            </div>
                        </div>
                    </div>
                </a>

                ";
        }
    ?>
@endsection
