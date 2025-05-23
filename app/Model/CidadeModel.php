<?php

namespace App\Model;

use Core\Library\ModelMain;

class CidadeModel extends ModelMain
{
    protected $table = "cidade";
    
    protected $validationRules = [
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
        ]
    ];

    /**
     * listaCidade
     *
     * @return array
     */
    public function listaCidade()
    {
        return $this->db->select("cidade.*, uf.sigla")
                        ->join("uf", "uf.id = cidade.uf_id")
                        ->orderby("uf.sigla, cidade.nome")
                        ->findAll();
    }
}