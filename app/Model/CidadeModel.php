<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "cidade";
    
    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:50'
        ],
        "codIBGE"  => [
            "label" => 'Código do IBGE',
            "rules" => 'required|min:7|max:7'
        ],
        "uf_id"  => [
            "label" => 'UF',
            "rules" => 'required|int'
        ],
        "wiki"  => [
            "label" => 'Wiki sobre a cidade',
            "rules" => 'required|min:5'
        ],
    ];


    /**
     * lista
     *
     * @param string $orderby 
     * @return array
     */
    public function listaCidade()
    {   
        return $this->db->select("cidade.*, uf.sigla")->join("uf", "uf.id = cidade.uf_id")->orderBy("uf.sigla, cidade.nome")->findAll();
    }

}