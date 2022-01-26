<?php

namespace App\Http\Controllers;
use App\Models\Result;
use App\Models\statistic;
use App\Models\Test;
use Illuminate\Http\Request;
use DB;

/**
 * Вывод результата выполнения теста
*/
class TestResultController extends Controller
{
    /**
     * Точка входа в контроллер
     *
     * @param int $id Идентификатор результата теста
     *
     * @return \Illuminate\Contracts\View\View
    */
    public function __invoke(int $id, Request $request)
    {
        $result = Result::with('Exercises')->findOrFail($id);
        if(array_key_exists('login', $_COOKIE))
        {
            $statistic = new statistic();

            $allstat = $statistic->all();
            $check = false;
            foreach($allstat as $stat)
            {
                if($stat->ID_Result == $id)
                    $check = true;
            }
            if($check == false) {
                $statistic->ID_User = $_COOKIE['ID_User'];
                $statistic->ID_Test = $result->ID_Test;
                $statistic->date_test = date('y-m-d H:i:s');
                $statistic->ID_Result = $id;
                $statistic->save();
            }
        }

        return view('test_result', [
            "id" => $id,
            "result" => $result,]);
    }
}
