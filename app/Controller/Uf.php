<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Session;

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
        return $this->loadView("admin/formUf");
    }

    public function teste()
    {
        $result = $this->model->db->insert([
            "sigla" => "RJ",
            "descricao" => "Rio de Janeiro"
        ]);

        if ($result > 0) {
            var_dump("Sucesso: " . $result);
        } else {
            var_dump(Session::get("msgError"));
        }
    }
}