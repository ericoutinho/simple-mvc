<?php

namespace base\core;

class Config{
    // Rotas
    public $defaultModulo     = 'modulo';
    public $defaultController = 'inicio';
    public $defaultView       = 'inicio';

    // Database
    public $database = array('driver' => '',
                             'host' => '',
                             'porta' => 3306,
                             'dbname' => '',
                             'usuario' => '',
                             'senha' => '');

}