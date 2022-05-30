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
                //dd($ofp_test);
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
