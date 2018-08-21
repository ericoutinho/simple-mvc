<?php

namespace base\core;
use base\core\Path;

class Conteudo{

    protected $path;
    protected $conteudo;

    public function __construct(){
        $this->path = new Path();
    }

    public function setConteudo(String $conteudo){
        $this->conteudo = $conteudo;
    }

    public function conteudo(){
        #return $this->conteudo;
        $view = MROOT.DS."views".DS.$this->conteudo.".php";
        if (is_readable($view)) {
            include($view);
        }
    }

}