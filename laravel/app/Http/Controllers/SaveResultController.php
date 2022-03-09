<?php

namespace App\Http\Controllers;
use App\Models\ResultExercise;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Result;
use DB;

/**
 * Сохранение результатов теста, вводимых пользователем значений
 *
 */
class SaveResultController extends Controller
{
    /**
     * Точка входа
     *
     * @param Request $request Запрос
     * @param int $id Идентификатор теста
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request, int $id)
    {

        $test = Test::with('Exercises')->findOrFail($id);

        if ($test->ID_Test == 1){

            $age = $request->input('age');

            if($age < 17 || $age > 23)
                $age = 17;
            if(empty($age))
                $age = 17;

            $course = $_POST["btnradio"];

            if($course == "муж")
                $normative = DB::select("select * from normatives1 where age = ".$age." AND gender = 'муж'");
            else
                $normative = DB::select("select * from normatives1 where age = ".$age." AND gender = 'жен'");
        }

        if($test->ID_Test == 2){
            $normative = DB::select("select * from normatives2 where gender = 'муж'");

        }

        $valid = $request->validate($this->getRules($test));

        $result_id = $this->saveResult($test, $valid, $normative);

        // -- Добавление id пользователя и id теста в таблицу test_user --
        if(array_key_exists('ID_User', $_COOKIE))
        {
            DB::table('test_user')->insert(
                array(
                    'ID_Test' => $id,
                    'ID_User' => $_COOKIE['ID_User']
                )
            );
        }

        // ----------------------------------------------------------------
        return redirect('test_result/'.$result_id);
    }

    /**
     * Сохраняет полученные результаты пользователя
     *
     * @param Test $test
     * @param array $valid_params Проверенные данные
     *
     * @return int Возвращает идентификатор сохраненного результата
     */
    private function saveResult(Test $test, array $valid_params, array $normative):int{

        $result = new Result();
        $result->ID_Test = $test->ID_Test;

        $result->Date = Carbon::now();
        $result->save();

        $idResult = $result->ID_Result;

        $i = 1;
        $j = 0;
        $var1 = 0;
        $var2 = 0;
        $array = array();
        foreach ($test->Exercises as $exercise ){

            $resultExersise = new ResultExercise();
            if($test->ID_Test == 1)
            {
                $resultExersise->ID_Result = $result->ID_Result;
                $resultExersise->Name = $exercise->Name;
                $resultExersise->Description = $exercise->Description;
                $resultExersise->ID_Exercise = $exercise->ID_Exercise;
                $resultExersise->Value = $valid_params[$exercise->getInputName()];
                $resultExersise->Norma = $normative[$j]->Value;


                $resultExersise->save();

                $j++;
            }

            if($test->ID_Test == 2)
            {


                $resultExersise->ID_Result = $result->ID_Result;
                $resultExersise->Name = $exercise->Name;
                $resultExersise->Description = $exercise->Description;
                $resultExersise->ID_Exercise = $exercise->ID_Exercise;

                if($exercise->getInputName() == "exercisevalue10" || $exercise->getInputName() == "exercisevalue11" ||
                    $exercise->getInputName() == "exercisevalue12")
                    $var1 += (float)$valid_params[$exercise->getInputName()];

                if($exercise->getInputName() == "exercisevalue13" || $exercise->getInputName() == "exercisevalue14")
                    $var2 += (float)$valid_params[$exercise->getInputName()];

                if($exercise->getInputName() != "exercisevalue10" && $exercise->getInputName() != "exercisevalue11" &&
                    $exercise->getInputName() != "exercisevalue13")
                {
                    $resultExersise->ID_Result = $result->ID_Result;
                    $resultExersise->Name = $exercise->Name;
                    $resultExersise->Description = $exercise->Description;
                    $resultExersise->ID_Exercise = $exercise->ID_Exercise;
                    $resultExersise->Norma = -1;


                    $norma = DB::select("select Value from normatives2 where gender = 'муж' AND id_exercise = ".$i);

                    foreach($norma as $key)
                    {
                        $array[] = $key->Value;
                    }


                    $num = (float) ($valid_params[$exercise->getInputName()]);
                    //dd($num);

                    if($exercise->getInputName() == "exercisevalue12"){
                        $num = (4 * ($var1) - 200) / 10;
                        $resultExersise->Value = $num;
                    }


                    if($exercise->getInputName() == "exercisevalue14"){
                        $num = ($var2)/100;
                        $resultExersise->Value = $num;
                    }

                    if($i != 9)
                    {
                        if ($num > $array[0])
                            $resultExersise->Norma = 1;
                        if($num < $array[0] && $num > $array[1])
                            $resultExersise->Norma = 2;
                        if($num < $array[1] && $num > $array[2])
                            $resultExersise->Norma = 3;
                        if($num < $array[2] && $num > $array[3])
                            $resultExersise->Norma = 4;
                        if($num < $array[3])
                            $resultExersise->Norma = 5;

                        $resultExersise->Value = $num;
                    }else
                    {
                        if ($num > $norma[0]->Value)
                            $resultExersise->Norma = 1;
                        if($num < $norma[0]->Value && $num > $norma[1]->Value)
                            $resultExersise->Norma = 2;
                        if($num < $norma[1]->Value && $num > $norma[2]->Value)
                            $resultExersise->Norma = 3;
                        if($num < $norma[2]->Value)
                            $resultExersise->Norma = 4;

                        $resultExersise->Value = $num;
                    }

                    $resultExersise->save();
                    $i++;
                }
            }


        }

        return  $idResult;
    }

    /**
     * Составляет правила для вводимых пользователем значений
     *
     * @param Test $test Модель теста
     *
     * @return array
     */
    private function getRules(Test $test):array{
        $rules = [];
        foreach ($test->Exercises as $exercise){
            $rules[$exercise->getInputName()] = 'required|max:100';
        }
        return $rules;
    }
}
