<?php

namespace App\Controller;

use Core\Library\ControllerMain;

class Uf extends ControllerMain
{
    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("admin\listaUf", $this->model->lista());
    }

    public function form($action, $id)
    {
        return $this->loadView("admin/formUf");
    }
}