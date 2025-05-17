<?php

namespace App\Model;

use Core\Library\ModelMain;

class UfModel extends ModelMain
{
    protected $table = "uf";
    
    protected $validationRules = [
        "sigla"  => [
            "label" => 'Sigla',
            "rules" => 'required|min:2|max:3'
        ],
        "descricao"  => [
            "label" => 'Descrição',
            "rules" => 'required|min:3|max:50'
        ]
    ];
}