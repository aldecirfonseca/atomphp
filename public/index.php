<?php

use Core\Ambiente;

require_once ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$ambiente = new Ambiente();

$ambiente->load();

echo "BANCO DE DADOS HOST: " . $_ENV['DB_HOST'];