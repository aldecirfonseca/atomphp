<?php
// app\controller\Uf.php

namespace App\Controller;

use Core\Library\ControllerMain;

class Uf extends ControllerMain
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("admin\listaUf", $this->model->lista());
    }
}