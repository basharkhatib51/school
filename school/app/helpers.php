<?php

use Symfony\Component\VarDumper\VarDumper;

//if (!function_exists('dd')) {
    function dd(...$vars)
    {
        header('Access-Control-Allow-Origin:  http://localhost:8080');
        header('Access-Control-Allow-Credentials:  true');
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        exit(1);
    }
//}
