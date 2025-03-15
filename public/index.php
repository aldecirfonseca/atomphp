<?php

use Core\Ambiente;
use Core\Routes;

require_once ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
require_once ".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "Constants.php";

$ambiente = new Ambiente();
$routes = new Routes();

$ambiente->load();

// Chamando minha rota
$routes->rota();