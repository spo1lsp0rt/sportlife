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
        public $PathToHtml;
        // конструктор
        public function __construct($n, $name, $description, $PathToHtml)
        {
            $this->n = $n;
            $this->name = $name;
            $this->description = $description;
            $this->PathToHtml = $PathToHtml;
        }
        // геттеры
        public function getN() { return $this->n; }
        public function getName() { return $this->name; }
        public function getDescription() { return $this->description; }
        public function getPathToHtml() { return $this->PathToHtml; }
        // сеттеры
        public function setN($n) { $this->n = $n; }
        public function setName($name) { $this->name = $name; }
        public function setDescription($description) { $this->description = $description; }
        public function setPathToFile($PathToHtml) {$this->PathToHtml = $PathToHtml;}
    }
    $tests = array();

    foreach($allTests as $test)
    {
        $tests[] = new TestData($test->ID_Test, $test->Name, $test->Description, $test->PathToHtml);
    }

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
