@extends('user_profile')

@section('user_statistic')


<?php

class StatData
{
    public $id_stat;
    public $id_user;
    public $id_test;
    public $id_result;
    // конструктор
    public function __construct($id_stat, $id_user, $id_test, $date_test, $id_result)
    {
        $this->id_stat = $id_stat;
        $this->id_user = $id_user;
        $this->id_test = $id_test;
        $this->date_test = $date_test;
        $this->id_result = $id_result;
    }
}

if(!array_key_exists('login', $_COOKIE))
{
    header('Location: /authorization');
    exit;
}

$stats = array();

$allStat = $currentData[0];
$allTests = $currentData[1];
$allUsers = $currentData[2];

$currentUser = null;
foreach($allUsers as $user)
{
    if($user->ID_User == $_COOKIE['ID_User'])
    {
        $currentUser = $user;
        break;
    }
}
foreach($allStat as $test)
{
    $stats[] = new StatData($test->ID_Statistic, $test->ID_User, $test->ID_Test, $test->date_test, $test->ID_Result);
}
if(isset($stats))
{
    echo "
    <div class='statistic_table'>
        <div class='container'>
            <div class='row'>
                <div class='col col-md-6'>
                    <div class='title_field'>Дата</div>
                </div>
                <div class='col col-md-6'>
                    <div class='title_field_last'>Название</div>
                </div>
            </div>
            ";
    foreach($stats as $stat)
    {
        if($stat->id_user != $currentUser->ID_User)
            continue;
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
                <a href='/test_result/$stat->id_result'>
                    <div class='row'>
                        <div class='col col-md-6'>
                            <div class='data_field'>$stat->date_test</div>
                        </div>
                        <div class='col col-md-6'>
                            <div class='data_field_last'>" . $allTests[$index]->Name . "</div>
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
