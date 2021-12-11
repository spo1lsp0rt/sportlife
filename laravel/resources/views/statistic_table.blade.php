@extends('user_profile')

@section('user_statistic')


<?php
class StatData
{
    public $id_stat;
    public $id_user;
    public $id_test;
    public $result;
    // конструктор
    public function __construct($id_stat, $id_user, $id_test, $date_test, $result)
    {
        $this->id_stat = $id_stat;
        $this->id_user = $id_user;
        $this->id_test = $id_test;
        $this->date_test = $date_test;
        $this->result = $result;
    }
}
$stats = array();

foreach($allStat as $test)
{
    $stats[] = new StatData($test->ID_Statistic, $test->ID_User, $test->ID_Test, $test->date_test, $test->Result);
}
if(isset($stats))
{
    echo "
    <div class='statistic_table'>
        <div class='container'>
            <div class='row'>
                <div class='col col-md-3'>
                    <div class='title_field'>Дата</div>
                </div>
                <div class='col col-md-6'>
                    <div class='title_field'>Название</div>
                </div>
                <div class='col col-md-3'>
                    <div class='title_field_last'>Результат</div>
                </div>
            </div>
            ";
    foreach($stats as $stat)
    {
        $index = 0;
        for($i = 0; $i < count($allTests); $i++)
        {
            if($allTests[$i]->ID_Test == $stat->id_test)
            {
                $index = $i;
                break;
            }
        }
        echo "
                <a href='/'>
                    <div class='row'>
                        <div class='col col-md-3'>
                            <div class='data_field'>$stat->date_test</div>
                        </div>
                        <div class='col col-md-6'>
                            <div class='data_field'>" . $allTests[$index]->Name . "</div>
                        </div>
                        <div class='col col-md-3'>
                            <div class='data_field_last'>$stat->result</div>
                        </div>
                    </div>
                </a>
        ";
    }
    echo "
            </div>
    </div>
    ";
}
?>

@endsection
