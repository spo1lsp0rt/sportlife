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
        //dd($request->input('btnradio'));


        $age = $request->input('age');
        if($age < 17 || $age > 23)
            $age = 17;
        if(empty($age))
            $age = 17;

        $course = $_POST["btnradio"];

        if($course = "муж")
            $normative = DB::select("select * from normatives where ID_Test = ". $test->ID_Test  ." AND "."age = ".$age." AND gender = 'муж'");
        else
            $normative = DB::select("select * from normatives where ID_Test = ". $test->ID_Test  ." AND "."age = ".$age." AND gender = 'жен'");
        $valid = $request->validate($this->getRules($test));
        $result_id = $this->saveResult($test, $valid, $normative);
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

        $i = 0;
        foreach ($test->Exercises as $exercise ){

            $resultExersise = new ResultExercise();
            $resultExersise->ID_Result = $result->ID_Result;
            $resultExersise->Name = $exercise->Name;
            $resultExersise->Description = $exercise->Description;
            $resultExersise->ID_Exercise = $exercise->ID_Exercise;
            $resultExersise->Value = $valid_params[$exercise->getInputName()];
            $resultExersise->Norma = $normative[$i]->Value;
            //dd($resultExersise);
            $i++;
            $resultExersise->save();
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
