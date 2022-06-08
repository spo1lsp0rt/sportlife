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

            if(array_key_exists('Gender', $_COOKIE))
                $course = $_COOKIE["Gender"];
            else
                $course = $_POST["btnradio"];

            if($course == "муж")
                $normative = DB::select("select * from normatives1 where age = ".$age." AND gender = 'муж'");
            else
                $normative = DB::select("select * from normatives1 where age = ".$age." AND gender = 'жен'");
        }

        if($test->ID_Test == 2){
            $normative = DB::select("select * from normatives2 where gender = 'муж'");
            if(array_key_exists('Gender', $_COOKIE))
                $course = $_COOKIE["Gender"];
            else
                $course = $_POST["btnradio"];
        }

        if($test->ID_Test == 3){
            $normative = DB::select("select * from normatives3 where gender = 'муж'");
            if(array_key_exists('Gender', $_COOKIE))
                $course = $_COOKIE["Gender"];
            else
                $course = $_POST["btnradio"];
        }

        if($test->ID_Test == 4){
            $normative = DB::select("select * from normatives3 where gender = 'муж'");
            $course = '';
        }

        if($test->ID_Test == 5){
            $normative = DB::select("select * from normatives5 where gender = 'муж'");
            if(array_key_exists('Gender', $_COOKIE))
                $course = $_COOKIE["Gender"];
            else
                $course = $_POST["btnradio"];
        }

        if($test->ID_Test == 6){
            $normative = DB::select("select * from normatives3 where gender = 'муж'");
            $course = '';
        }

        if ($test->ID_Test == 6)
            $valid = $request->validate($this->getRulesTime($test, $request));
        else
            $valid = $request->validate($this->getRules($test));
        //dd($valid);

        $result_id = $this->saveResult($test, $valid, $normative, $course);

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
     * @param string $course Пол студента
     *
     * @return int Возвращает идентификатор сохраненного результата
     */
    private function saveResult(Test $test, array $valid_params, array $normative, string $course):int{

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

        $num_tmp = 0;
        $num_sit = 0;
        $center_gravity = '';
        $check = true;
        $weight = 0;
        $rise = 0;
        $leglength = 0;
        $hips = 0;
        $ribcagenorm = 0;
        $ribcagemax = 0;
        $ribcagemin = 0;

        foreach ($test->Exercises as $exercise ){
            if($check){
                $count =  $exercise->ID_Exercise;
                $check = false;
            }

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
                    $resultExersise->Name = $exercise->Name.$course;
                    $resultExersise->Description = $exercise->Description;
                    $resultExersise->ID_Exercise = $exercise->ID_Exercise;
                    $resultExersise->Norma = -1;


                    if($course == "муж")
                        $norma = DB::select("select Value from normatives2 where gender = 'муж' AND id_exercise = ".$i);
                    else
                        $norma = DB::select("select Value from normatives2 where gender = 'жен' AND id_exercise = ".$i);


                    $num = (float) ($valid_params[$exercise->getInputName()]);

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
                        if($num >= $norma[0]->Value)
                            $resultExersise->Norma = 5;
                        else if ($num < $norma[0]->Value && $num >= $norma[1]->Value)
                            $resultExersise->Norma = 4;
                        else if($num < $norma[1]->Value && $num >= $norma[2]->Value)
                            $resultExersise->Norma = 3;
                        else if($num < $norma[2]->Value && $num >= $norma[3]->Value)
                            $resultExersise->Norma = 2;
                        else if($num < $norma[3]->Value)
                            $resultExersise->Norma = 1;

                            $resultExersise->Value = $num;
                    }else
                    {
                        if($num >= $norma[0]->Value)
                            $resultExersise->Norma = 5;
                        else if ($num < $norma[0]->Value && $num >= $norma[1]->Value)
                            $resultExersise->Norma = 4;
                        else if($num < $norma[1]->Value && $num >= $norma[2]->Value)
                            $resultExersise->Norma = 2;
                        else if($num < $norma[2]->Value)
                            $resultExersise->Norma = 1;

                        $resultExersise->Value = $num;
                    }

                    $resultExersise->save();
                    $i++;
                }
            }

            if($test->ID_Test == 3)
            {
                $resultExersise->ID_Result = $result->ID_Result;
                if($course == "муж")
                    $resultExersise->Name = $exercise->Name.'муж';
                else
                    $resultExersise->Name = $exercise->Name.'жен';
                $resultExersise->Description = $exercise->Description;
                $resultExersise->ID_Exercise = $exercise->ID_Exercise;

                if($course == "муж")
                    $norma = DB::select("select Value from normatives3 where gender = 'муж' AND id_exercise = ".$i+20);
                else
                    $norma = DB::select("select Value from normatives3 where gender = 'жен' AND id_exercise = ".$i+20);

                $num = (float) ($valid_params[$exercise->getInputName()]);

                if($i <= 1 && $i >= 6)
                {
                    $num_tmp += $num;
                }

                if($i != 9 && $i != 1 && $i != 2 && $i != 3 && $i != 4 && $i != 5)
                {
                    if($num >= $norma[0]->Value)
                        $resultExersise->Norma = 5;
                    else if ($num < $norma[0]->Value && $num >= $norma[1]->Value)
                        $resultExersise->Norma = 4;
                    else if($num < $norma[1]->Value && $num >= $norma[2]->Value)
                        $resultExersise->Norma = 3;
                    else if($num < $norma[2]->Value && $num >= $norma[3]->Value)
                        $resultExersise->Norma = 2;
                    else if($num < $norma[3]->Value)
                        $resultExersise->Norma = 1;

                    $resultExersise->Value = $num;

                    $resultExersise->save();
                }else if ($i == 9)
                {
                    if($num >= $norma[0]->Value)
                        $resultExersise->Norma = 5;
                    else if ($num < $norma[0]->Value && $num >= $norma[1]->Value)
                        $resultExersise->Norma = 4;
                    else if($num < $norma[1]->Value && $num >= $norma[2]->Value)
                        $resultExersise->Norma = 2;
                    else if($num < $norma[2]->Value)
                        $resultExersise->Norma = 1;

                    $resultExersise->Value = $num;

                    $resultExersise->save();
                }

                $i++;
            }

            if($test->ID_Test == 4)
            {
                $num = (float) ($valid_params[$exercise->getInputName()]);
                $resultExersise->ID_Result = $result->ID_Result;
                $resultExersise->Name = $exercise->Name;
                $resultExersise->Norma = 0;
                $resultExersise->Description = $exercise->Description;
                $resultExersise->ID_Exercise = $exercise->ID_Exercise;
                $resultExersise->Value = $num;
                $resultExersise->save();
            }

            if($test->ID_Test == 5){

                $resultExersise->ID_Result = $result->ID_Result;
                $num = (float) ($valid_params[$exercise->getInputName()]);

                if($i == 1){
                    $resultExersise->Name = 'Рост стоя (см)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $num;
                    $resultExersise->save();
                    $rise = $num;
                }

                if($i == 2){

                    $resultExersise->Name = 'Рост сидя (см)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $num;
                    $resultExersise->save();

                    $num_sit = $num;
                    $count++;

                }


                if($i == 3){
                    $num_tmp += $num;

                    $resultExersise->Name = 'Коэффициент пропорциональности тела (%)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '.';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = round((($rise - $num_sit) / $num_sit) * 100);

                    $resultExersise->save();

                    $count++;
                }

                if($i == 4){
                    $num_tmp += $num;
                    $num_tmp /= 2;

                    $resultExersise->Name = 'Прогнозируемый рост (см)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $num_tmp;
                    $resultExersise->save();

                    $count++;

                }

                if($i == 5){
                    $weight = $num;
                    $resultExersise->Name = 'Масса тела (кг)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $weight;
                    $resultExersise->save();
                    $count++;
                }

                if($i == 6){
                    $leglength = $num;
                    $resultExersise->Name = 'Индекс Кетле по формуле Мануврие';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $leglength / $num_sit * 100;
                    $resultExersise->save();
                    $count++;
                }

                if($i == 7){

                    $resultExersise->Name = 'Индекс граций';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $num / ($rise - 100);
                    $resultExersise->save();
                    $count++;
                }

                if($i == 8){
                    $ribcagenorm = $num;
                    $resultExersise->Name = 'Окружность грудной клетки в состоянии покоя (см)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $ribcagenorm;
                    $resultExersise->save();
                    $count++;
                }

                if($i == 9){
                    $ribcagemax = $num;
                    $resultExersise->Name = 'Окружность грудной клетки при максимальном вдохе (см)'.' '.$course;
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $ribcagemax;
                    $resultExersise->save();
                    $count++;
                }

                if($i == 10){
                    $ribcagemin = $num;
                    $resultExersise->Name = 'Окружность грудной клетки при максимальном выдохе (см)';
                    $resultExersise->Norma = 0;
                    $resultExersise->Description = '';
                    $resultExersise->ID_Exercise = $count;
                    $resultExersise->Value = $ribcagemin;
                    $resultExersise->save();

                    $count++;
                }

                $i++;
            }

            if($test->ID_Test == 6){
                $norma = DB::select("select Value from normatives6 where id = ".$i);

                $endtime = explode(':', $valid_params[$exercise->getInputName().'endtime']);
                $begtime = explode(':', $valid_params[$exercise->getInputName().'begtime']);
                $resultExersise->ID_Result = $result->ID_Result;
                $resultExersise->Name = $exercise->Name;
                $resultExersise->Description = $begtime[0].':'.$begtime[1].'-'.$endtime[0].':'.$endtime[1];
                $resultExersise->ID_Exercise = $exercise->ID_Exercise;
                $time = ((int)$endtime[0] * 60 + (int)$endtime[1]) - ((int)$begtime[0] * 60 + (int)$begtime[1]);
                $resultExersise->Value = $time;
                $resultExersise->Norma = $time * $norma[0]->Value;

                $resultExersise->save();

                $i++;
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
            if($test->ID_Test == 1)
                $rules['age'] = 'required||integer|between:16,45';
        }
        return $rules;
    }

    /**
     * Составляет правила для вводимых пользователем значений
     *
     * @param Test $test Модель теста
     * @param Request $request Полученные данные
     * @return array
     */
    private function getRulesTime(Test $test, Request $request):array{
        $rules = [];
        $arrtime = array();
        $time_temp = array();
        foreach ($test->Exercises as $exercise){
            $begtemp = explode(':', $request->input($exercise->getInputName().'begtime'));
            $endtemp = explode(':', $request->input($exercise->getInputName().'endtime'));


            for ($i = 0; $i < 2; $i++){
                $time_temp[] = $begtemp[$i];
            }
            for ($i = 0; $i < 2; $i++){
                $time_temp[] = $endtemp[$i];
            }

            $arrtime[] = $time_temp;
            $time_temp = array();
            $begtime = (int)$begtemp[0] * 60 + (int)$begtemp[1];
            $endtime = (int)$endtemp[0] * 60 + (int)$endtemp[1];

            if ((int)$begtime > (int)$endtime)
                $rules[$exercise->getInputName().'begtime'] = 'required|email';
            else{
                $rules[$exercise->getInputName().'begtime'] = 'required';
                $rules[$exercise->getInputName().'endtime'] = 'required';
            }

        }
        //dd(sizeof($arrtime));
        for ($i = 0; $i < sizeof($arrtime); $i++){
            for ($j = $i + 1; $j < sizeof($arrtime); $j++){
                //Проверка на совпадение часа во временных промежутках начала, если равны, то
                if ($arrtime[$i][0] <= $arrtime[$j][0] && $arrtime[$i][1] <= $arrtime[$j][2]){
                    //Прверка на совпадение минут во временных промежутках
                    if ($arrtime[$i][0] == $arrtime[$j][0]){
                        if ($arrtime[$i][1] > $arrtime[$j][1]) $rules[$exercise->getInputName().'begtime'] = 'required|email';
                    }
                    else
                    {
                        if ($arrtime[$i][3] > $arrtime[$j][1]) $rules[$exercise->getInputName().'begtime'] = 'required|email';
                    }
                }
                else $rules[$exercise->getInputName().'begtime'] = 'required|email';
            }
        }
        $time = 0;
        foreach ($test->Exercises as $exercise){
            $begtime = explode(':', $request->input($exercise->getInputName().'begtime'));
            $endtime = explode(':', $request->input($exercise->getInputName().'endtime'));
            $time += ((int)$endtime[0] * 60 + (int)$endtime[1]) - ((int)$begtime[0] * 60 + (int)$begtime[1]);

        }
        if($time>1439){
            $rules[$exercise->getInputName().'begtime'] = 'required|email';
        }

        return $rules;
    }
}
