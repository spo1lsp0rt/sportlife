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
