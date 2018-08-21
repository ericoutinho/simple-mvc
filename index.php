<?php
    
header('Content-Type: text/html; charset=utf-8');

# Inicialização :::::::::::::::::::----------------------------------
ini_set('memory_limit', '512M');

# Constantes do sistema :::::::::::----------------------------------
define('DS', DIRECTORY_SEPARATOR);
define('FE', '.php');
define('ROOT', dirname(__FILE__));

# Definição de Modulos ::::::::----------------------------------
define('MODULO',     'modulo');
define('CONTROLLER', 'home');
define('TEMPLATE',   'default');

# Bootstrap :::::::::::::::::::::::----------------------------------
require_once("libs/base/core/Autoload.c.php");
$bootstrap = new Autoload();
$bootstrap->setExtensao('php');
$bootstrap->setSufixo('.c');
$bootstrap->setPath(ROOT);

spl_autoload_register(array($bootstrap, 'loadCore'));
spl_autoload_register(array($bootstrap, 'loadModulos'));
# :::::::::::::::::::::::::::::::::----------------------------------

$path = explode('/', trim($_SERVER['PATH_INFO'], '/'));

if (isset($path[0]) && !empty($path[0])) {
    $mod = "app/modulos/{$path[0]}/index.php";
    if (is_readable($mod)) {
        include($mod);
    } else {
        header("HTTP/1.0 404 Not Found");
        header("Location: /shared/404.php");
        exit();
    }
} else {
    header("Location: ".DS.MODULO.DS.CONTROLLER.DS);
    exit();
}
