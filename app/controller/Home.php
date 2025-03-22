<?php
// app\controller\Home.php

namespace App\Controller;

use Core\Library\ControllerMain;

class Home extends ControllerMain
{
    public function index()
    {
        echo "Bem-vindo(a) ao AtomPHP.<br>";

        var_dump($this);
    }

    public function sobre($action = null)
    {
        echo "Página sobre nós. AÇÃO: {$action}";
    }

    public function detalhes($action = null, $id = null, ...$params)
    {
        echo "Detalhes: <br />";
        echo "<br />Ação: " . $action;
        echo "<br />ID: " . $id;
        echo "<br />PARÂMETROS: " . implode(", ", $params);
    }
}