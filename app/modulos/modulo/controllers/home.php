<?php

    use base\core\Conteudo;
    $conteudo = new Conteudo();

    switch($path[2]){
        case '':
            $title = "Modulo - Home";
            $conteudo->setConteudo('home');
        break;

        default:
            header("Location: /shared/404.php");
            exit();
        break;
    }

    include(MROOT.DS."templates".DS.TEMPLATE.DS."index".FE);