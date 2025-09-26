<?php

session_start();

use Core\Library\Ambiente;
use Core\Library\Routes;

// PATH padrão, da aplicação
//defined('PATHAPP') || define("PATHAPP", ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "aplicacaoatomphp" . DIRECTORY_SEPARATOR);
defined('PATHAPP') || define("PATHAPP", ".." . DIRECTORY_SEPARATOR);
//

require_once PATHAPP . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
require_once PATHAPP . "app" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "Constants.php";

// seta time zone
date_default_timezone_set(DEFAULT_TIME_ZONE);

$ambiente = new Ambiente();
$routes = new Routes();

$ambiente->load();

// Chamando minha rota
$routes->rota();