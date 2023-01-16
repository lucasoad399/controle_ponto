<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
// Constantes

define('DAILY_TIME', 8*60*60);

// Pastas

define('MODEL_PATH', realpath(__DIR__ . '/../models'));
define('VIEW_PATH', realpath(__DIR__ . '/../views'));
define('CONTROLLER_PATH', realpath(__DIR__ . '/../controllers'));
// Arquivos
require_once realpath( __DIR__ . '/Database.php');
require_once realpath(__DIR__ . '/autoload.php');
// sisLoad('model', 'Model');
// sisLoad('model', 'User');
// sisLoad('model', 'Login');
spl_autoload_register(function($class){
    require_once realpath(MODEL_PATH . "/{$class}.php");
});


// require realpath(MODEL_PATH . '/Model.php');
// require realpath(MODEL_PATH . '/User.php');
// require realpath(MODEL_PATH . '/Login.php');