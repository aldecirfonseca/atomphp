<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Redirect;

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
        return $this->loadView("admin\listaUf", $this->model->lista("sigla"));
    }

    public function form($action, $id)
    {
        return $this->loadView("admin/formUf", $this->model->getById($id));
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->request->getPost();

        if ($this->model->insert($post)) {
            return Redirect::page("Uf", ["msgSucess" => "Registro inserido com sucesso."]);
        } else {
            return Redirect::page("Uf");
        }
    }
}