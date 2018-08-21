<?php

namespace base\core;

class Path{

    protected $path;
    protected $modulo;
    protected $moduloPadrao;
    protected $controller;
    protected $controllerPadrao;
    protected $view;
    protected $cod;

    public function __construct(){
        $this->setPath(); $this->setModulo(); $this->setController();
        $this->setView(); $this->setCod();
    }

    protected function setPath(){
        $this->path = explode("/", trim($_SERVER['PATH_INFO'], "/"));
    }

    protected function setModulo(){
        $this->modulo = $this->path[0];
    }

    /**
     * Define o módulo padrão a ser carregado
     * @param string $modulo - Nome do módulo
     * @return void
     */
    public function setModuloPadrao(string $modulo){
        $this->moduloPadrao = $modulo;
    }

    protected function setController(){
        $this->controller = $this->path[1];
    }

    /**
     * Define o controller padrao
     * @param string $contr - Nome do controller
     * @return void
     */
    public function setControllerPadrao(string $contr){
        $this->controllerPadrao = $contr;
    }

    protected function setView(){
        $this->view = $this->path[2];
    }

    protected function setCod(){
        $this->cod = $this->path[3];
    }

    /**
     * Retorna o modulo
     * @param void
     * @return string - O nome do modulo
     */
    public function getModulo():string{
        return (!empty($this->modulo)) ? $this->modulo : $this->moduloPadrao;        
    }

    /**
     * Retorna o controller
     * @param void
     * @return string - O nome do controller
     */
    public function getController():string{
        return (!empty($this->controller)) ? $this->controller : $this->controllerPadrao;
    }

    public function getView(){
        return $this->view;
    }

    public function getCod(){
        return $this->cod;
    }

    public function getRender(){
        $path = ROOT.DS."app".DS."modulos".DS.$this->getModulo.DS.$this->getController.FE;
        if (is_readable($path)) {
            include($path);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

}