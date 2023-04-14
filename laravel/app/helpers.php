<?php

if(!function_exists('key_gen'))
{
    function key_gen()
    {
        $template = 'XX9-XXX-9XX-9XX';
        $k = strlen($template);
        $sernum = '';
        for ($i = 0; $i < $k; $i++) {
            switch ($template[$i]) {
                case 'X':
                    $sernum .= chr(rand(65, 90));
                    break;
                case '9':
                    $sernum .= rand(0, 9);
                    break;
                case '-':
                    $sernum .= '-';
                    break;
            }
        }
        return $sernum;
    }
}

if(!function_exists('unparse_normative'))
{
    function unparse_normative($norms)
    {

    }
}

if(!function_exists('getPoints'))
{
    function getPoints($test, $gender, $ofp_test, &$summbal, &$points)
    {
        if ($gender[0]->gender == 'муж')
        {
            if ($test->id_normative == 1 || $test->id_normative == 4 || $test->id_normative == 8)
            {
                //Находим нужный балл
                if ($ofp_test[0]->male_normative < $test->result){
                    $points[$test->id_normative - 1] = 0;
                    $summbal += 0;
                }
                else if ($ofp_test[0]->male_normative >= $test->result && $ofp_test[1]->male_normative < $test->result){
                    $points[$test->id_normative - 1] = 1;
                    $summbal+= 1;
                }
                else if ($ofp_test[1]->male_normative >= $test->result && $ofp_test[2]->male_normative < $test->result){
                    $points[$test->id_normative - 1] = 2;
                    $summbal+= 2;
                }
                else if ($ofp_test[2]->male_normative >= $test->result && $ofp_test[3]->male_normative < $test->result){
                    $points[$test->id_normative - 1] = 3;
                    $summbal+= 3;
                }
                else if ($ofp_test[3]->male_normative >= $test->result && $ofp_test[4]->male_normative < $test->result){
                    $points[$test->id_normative - 1] = 4;
                    $summbal+= 4;
                }
                else if ($ofp_test[4]->male_normative >= $test->result){
                    $points[$test->id_normative - 1] = 5;
                    $summbal+= 5;
                }
            }else{
                //Находим нужный балл
                if ($ofp_test[0]->male_normative > $test->result){
                    $summbal+= 0;
                    $points[$test->id_normative - 1] = 0;
                }
                else if ($ofp_test[0]->male_normative <= $test->result && $ofp_test[1]->male_normative > $test->result){
                    $summbal += 1;
                    $points[$test->id_normative - 1] = 1;
                }
                else if ($ofp_test[1]->male_normative <= $test->result && $ofp_test[2]->male_normative > $test->result){
                    $summbal+= 2;
                    $points[$test->id_normative - 1] = 2;
                }
                else if ($ofp_test[2]->male_normative <= $test->result && $ofp_test[3]->male_normative > $test->result){
                    $summbal+= 3;
                    $points[$test->id_normative - 1] = 3;
                }
                else if ($ofp_test[3]->male_normative <= $test->result && $ofp_test[4]->male_normative > $test->result){
                    $summbal+= 4;
                    $points[$test->id_normative - 1] = 4;
                }
                else if ($ofp_test[4]->male_normative <= $test->result){
                    $summbal += 5;
                    $points[$test->id_normative - 1] = 5;
                }
            }

        }else{
            if ($test->id_normative == 1 || $test->id_normative == 4 || $test->id_normative == 8)
            {
                //Находим нужный балл
                if ($ofp_test[0]->female_normative < $test->result){
                    $points[$test->id_normative - 1] = 0;
                    $summbal+= 0;
                }
                else if ($ofp_test[0]->female_normative >= $test->result && $ofp_test[1]->female_normative < $test->result){
                    $points[$test->id_normative - 1] = 1;
                    $summbal+= 1;
                }
                else if ($ofp_test[1]->female_normative >= $test->result && $ofp_test[2]->female_normative < $test->result){
                    $points[$test->id_normative - 1] = 2;
                    $summbal+= 2;
                }
                else if ($ofp_test[2]->female_normative >= $test->result && $ofp_test[3]->female_normative < $test->result){
                    $points[$test->id_normative - 1] = 3;
                    $summbal+= 3;
                }
                else if ($ofp_test[3]->female_normative >= $test->result && $ofp_test[4]->female_normative < $test->result){
                    $points[$test->id_normative - 1] = 4;
                    $summbal+= 4;
                }
                else if ($ofp_test[4]->female_normative >= $test->result){
                    $points[$test->id_normative - 1] = 5;
                    $summbal+= 5;
                }
            }else{
                //dd($ofp_test);
                //Находим нужный балл
                if ($ofp_test[0]->female_normative > $test->result){
                    $summbal+= 0;
                    $points[$test->id_normative - 1] = 0;
                }
                else if ($ofp_test[0]->female_normative <= $test->result && $ofp_test[1]->female_normative > $test->result){
                    $summbal+= 1;
                    $points[$test->id_normative - 1] = 1;
                }
                else if ($ofp_test[1]->female_normative <= $test->result && $ofp_test[2]->female_normative > $test->result){
                    $summbal+= 2;
                    $points[$test->id_normative - 1] = 2;
                }
                else if ($ofp_test[2]->female_normative <= $test->result && $ofp_test[3]->female_normative > $test->result){
                    $summbal+= 3;
                    $points[$test->id_normative - 1] = 3;
                }
                else if ($ofp_test[3]->female_normative <= $test->result && $ofp_test[4]->female_normative > $test->result){
                    $summbal+= 4;
                    $points[$test->id_normative - 1] = 4;
                }
                else if ($ofp_test[4]->female_normative <= $test->result){
                    $summbal+= 5;
                    $points[$test->id_normative - 1] = 5;
                }
            }
        }
    }
}

if(!function_exists('set_level'))
{
    function set_level($results, $gender)
    {
        
        $levels = array();
        if ($gender == "Юноши")
        {
            // упражнение 1
            if($results[0]->avg >= 501)
                $levels[0] = "низкий";
            elseif($results[0]->avg >= 451 && $results[0]->avg <= 451)
                $levels[0] = "н. среднего";
            elseif($results[0]->avg >= 401 && $results[0]->avg <= 450)
                $levels[0] = "средний";
            elseif($results[0]->avg >= 375 && $results[0]->avg <= 400)
                $levels[0] = "в. среднего";
            else
                $levels[0] = "высокий";
            //упражнение 2
            if($results[1]->avg >= 3)
                $levels[1] = "низкий";
            elseif($results[1]->avg >= 2 && $results[1]->avg <= 2.59)
                $levels[1] = "н. среднего";
            elseif($results[1]->avg >= 1.3 && $results[1]->avg <= 1.99)
                $levels[1] = "средний";
            elseif($results[1]->avg >= 1 && $results[1]->avg <= 1.29)
                $levels[1] = "в. среднего";
            else
                $levels[1] = "высокий";
            //упражнение 3
            if($results[2]->avg >= 10)
                $levels[2] = "низкий";
            elseif($results[2]->avg >= 6 && $results[2]->avg <= 9.99)
                $levels[2] = "н. среднего";
            elseif($results[2]->avg >= 3 && $results[2]->avg <= 5.99)
                $levels[2] = "средний";
            elseif($results[2]->avg >= 0 && $results[2]->avg <= 2.99)
                $levels[2] = "в. среднего";
            else
                $levels[2] = "высокий";
            //упражнение 4
            if($results[3]->avg >= 111)
                $levels[3] = "низкий";
            elseif($results[3]->avg >= 95 && $results[3]->avg <= 110.99999999)
                $levels[3] = "н. среднего";
            elseif($results[3]->avg >= 85 && $results[3]->avg <= 94.999999)
                $levels[3] = "средний";
            elseif($results[3]->avg >= 70 && $results[3]->avg <= 84.999999)
                $levels[3] = "в. среднего";
            else
                $levels[3] = "высокий";
            //упражнение 5
            if($results[4]->avg <= 30)
                $levels[4] = "низкий";
            elseif($results[4]->avg >= 31 && $results[4]->avg <= 39)
                $levels[4] = "н. среднего";
            elseif($results[4]->avg >= 40 && $results[4]->avg <= 60)
                $levels[4] = "средний";
            elseif($results[4]->avg >= 61 && $results[4]->avg <= 89)
                $levels[4] = "в. среднего";
            else
                $levels[4] = "высокий";
            //упражнение 6
            if($results[5]->avg <= 19)
                $levels[5] = "низкий";
            elseif($results[5]->avg >= 20 && $results[5]->avg <= 24)
                $levels[5] = "н. среднего";
            elseif($results[5]->avg >= 25 && $results[5]->avg <= 30)
                $levels[5] = "средний";
            elseif($results[5]->avg >= 31 && $results[5]->avg <= 59)
                $levels[5] = "в. среднего";
            else
                $levels[5] = "высокий";
            //упражнение 7
            if($results[6]->avg <= 24)
                $levels[6] = "низкий";
            elseif($results[6]->avg >= 25 && $results[6]->avg <= 34)
                $levels[6] = "н. среднего";
            elseif($results[6]->avg >= 35 && $results[6]->avg <= 55)
                $levels[6] = "средний";
            elseif($results[6]->avg >= 56 && $results[6]->avg <= 59)
                $levels[6] = "в. среднего";
            else
                $levels[6] = "высокий";
            //упражнение 8
            if($results[7]->avg >= 21)
                $levels[7] = "низкий";
            elseif($results[7]->avg >= 15 && $results[7]->avg <= 20)
                $levels[7] = "н. среднего";
            elseif($results[7]->avg >= 10 && $results[7]->avg <= 14)
                $levels[7] = "средний";
            else
                $levels[7] = "высокий";
            //упражнение 9
            if($results[8]->avg >= 11)
                $levels[8] = "низкий";
            elseif($results[8]->avg >= -3 && $results[8]->avg <= 10)
                $levels[8] = "высокий";
            else
                $levels[8] = "средний";
        }
        else
        {
            // упражнение 1
            if($results[0]->avg >= 451)
                $levels[0] = "низкий";
            elseif($results[0]->avg >= 401 && $results[0]->avg <= 450)
                $levels[0] = "н. среднего";
            elseif($results[0]->avg >= 375 && $results[0]->avg <= 400)
                $levels[0] = "средний";
            elseif($results[0]->avg >= 351 && $results[0]->avg <= 374)
                $levels[0] = "в. среднего";
            else
                $levels[0] = "высокий";
            //упражнение 2
            if($results[1]->avg >= 3)
                $levels[1] = "низкий";
            elseif($results[1]->avg >= 2 && $results[1]->avg <= 2.59)
                $levels[1] = "н. среднего";
            elseif($results[1]->avg >= 1.3 && $results[1]->avg <= 1.99)
                $levels[1] = "средний";
            elseif($results[1]->avg >= 1 && $results[1]->avg <= 1.29)
                $levels[1] = "в. среднего";
            else
                $levels[1] = "высокий";
            //упражнение 3
            if($results[2]->avg >= 10)
                $levels[2] = "низкий";
            elseif($results[2]->avg >= 6 && $results[2]->avg <= 9.99)
                $levels[2] = "н. среднего";
            elseif($results[2]->avg >= 3 && $results[2]->avg <= 5.99)
                $levels[2] = "средний";
            elseif($results[2]->avg >= 0 && $results[2]->avg <= 2.99)
                $levels[2] = "в. среднего";
            else
                $levels[2] = "высокий";
            
            //упражнение 4
            if($results[3]->avg >= 111)
                $levels[3] = "низкий";
            elseif($results[3]->avg >= 95 && $results[3]->avg <= 110.99999999)
                $levels[3] = "н. среднего";
            elseif($results[3]->avg >= 85 && $results[3]->avg <= 94.999999)
                $levels[3] = "средний";
            elseif($results[3]->avg >= 70 && $results[3]->avg <= 84.999999)
                $levels[3] = "в. среднего";
            else
                $levels[3] = "высокий";
            //упражнение 5
            if($results[4]->avg <= 30)
                $levels[4] = "низкий";
            elseif($results[4]->avg >= 31 && $results[4]->avg <= 39)
                $levels[4] = "н. среднего";
            elseif($results[4]->avg >= 40 && $results[4]->avg <= 60)
                $levels[4] = "средний";
            elseif($results[4]->avg >= 61 && $results[4]->avg <= 89)
                $levels[4] = "в. среднего";
            else
                $levels[4] = "высокий";
            //упражнение 6
            if($results[5]->avg <= 19)
                $levels[5] = "низкий";
            elseif($results[5]->avg >= 20 && $results[5]->avg <= 24)
                $levels[5] = "н. среднего";
            elseif($results[5]->avg >= 25 && $results[5]->avg <= 30)
                $levels[5] = "средний";
            elseif($results[5]->avg >= 31 && $results[5]->avg <= 59)
                $levels[5] = "в. среднего";
            else
                $levels[5] = "высокий";
            //упражнение 7
            if($results[6]->avg <= 24)
                $levels[6] = "низкий";
            elseif($results[6]->avg >= 25 && $results[6]->avg <= 34)
                $levels[6] = "н. среднего";
            elseif($results[6]->avg >= 35 && $results[6]->avg <= 55)
                $levels[6] = "средний";
            elseif($results[6]->avg >= 56 && $results[6]->avg <= 59)
                $levels[6] = "в. среднего";
            else
                $levels[6] = "высокий";
            //упражнение 8
            if($results[7]->avg >= 21)
                $levels[7] = "низкий";
            elseif($results[7]->avg >= 15 && $results[7]->avg <= 20)
                $levels[7] = "н. среднего";
            elseif($results[7]->avg >= 10 && $results[7]->avg <= 14)
                $levels[7] = "средний";
            else
                $levels[7] = "высокий";
            //упражнение 9
            if($results[8]->avg >= 11)
                $levels[8] = "низкий";
            elseif($results[8]->avg >= -3 && $results[8]->avg <= 10)
                $levels[8] = "высокий";
            else
                $levels[8] = "средний";
        }
        
        return $levels;
    }
}
