<?php

    # Raíz do módulo
    define('MROOT', ROOT.DS."app/modulos/modulo");

    if(isset($path[1]) && !empty($path[1])){
        $file = MROOT.DS."controllers".DS.$path[1].FE;
        if (is_readable($file)) {
            include($file);
        } else {
            header("HTTP/1.1 404 Not Found");
            header("Location: /shared/404.php");
            exit();
        }
    } else {
        header("Location: home/");
        exit();
    }