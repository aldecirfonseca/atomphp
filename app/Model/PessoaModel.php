<?php

namespace App\Model;

use Core\Library\ModelMain;

class PessoaModel extends ModelMain
{
    protected $table = "pessoa";

    public $validationRules =  [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:60'
        ],
        "email"  => [
            "label" => 'Email',
            "rules" => 'required|email'
        ],
        "dataNascimento"  => [
            "label" => 'Data de Nascimento',
            "rules" => 'required|date'
        ],                
        "whatsapp"  => [
            "label" => 'WhatsApp',
            "rules" => 'required|min:11|max:15'
        ],
        "sexo"  => [
            "label" => 'sexo',
            "rules" => 'required'
        ]
    ];
}