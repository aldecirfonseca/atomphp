<?php

namespace App\Controller;

use App\Library\ApiClientAtomPHP;

class Pessoa
{
    protected $ApiClientAtomPHP;

    /**
     * construct
     */
    public function __construct()
    {
        $this->ApiClientAtomPHP = new ApiClientAtomPHP("http://atomphp/ApiPessoa/");
        $token = $this->ApiClientAtomPHP->gerarToken();

        if ($token['status'] == '201') {            // Token  Gerado com sucesso
            $this->ApiClientAtomPHP->setToken($token['body']['data']['token']);
        } else {
            echo "Erro para gerar o Token" . $token['body']['message'];
        }
    }

    /**
     * lista
     *
     * @return void
     */
    public function lista()
    {        
        $resposta = $this->ApiClientAtomPHP->request("GET", "listar");

        echo "Status: " . $resposta['status'] . PHP_EOL;
        echo "Resposta:" . PHP_EOL;
        print_r($resposta['body']);

        if (!empty($resposta['error'])) {
            echo "Erro cURL: " . $resposta['error'] . PHP_EOL;
        }
    }

    /**
     * getPessoaEmail
     *
     * @return void
     */
    public function getPessoaEmail()
    {
        $pessoa = [
            "email" => "marcelo@email.com"
        ];

        $resposta = $this->ApiClientAtomPHP->request("POST", "getPessoa", $pessoa);

        echo "Status: " . $resposta['status'] . PHP_EOL;
        echo "Resposta:" . PHP_EOL;
        print_r($resposta['body']);

        if (!empty($resposta['error'])) {
            echo "Erro cURL: " . $resposta['error'] . PHP_EOL;
        }
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $pessoa = [
            "nome" => "Marcelo Pedrosa",
            "email" => "marcelo@email.com",
            "dataNascimento" => "1985-12-15",
            "whatsapp" => "11987654455",
            "sexo" => "M"
        ];

        $resposta = $this->ApiClientAtomPHP->request('POST', 'criar', $pessoa);

        echo "Status: " . $resposta['status'] . PHP_EOL;
        echo "Resposta:" . PHP_EOL;
        print_r($resposta['body']);

        if (!empty($resposta['error'])) {
            echo "Erro cURL: " . $resposta['error'] . PHP_EOL;
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $pessoa = [
            "pessoa_id" => 5,
            "nome" => "Marcelo Pedrosa",
            "email" => "marcelo@email.com",
            "dataNascimento" => "1999-12-15",
            "whatsapp" => "11987654455",
            "sexo" => "M"
        ];

        $resposta = $this->ApiClientAtomPHP->request('PUT', 'atualizar', $pessoa);

        echo "Status: " . $resposta['status'] . PHP_EOL;
        echo "Resposta:" . PHP_EOL;
        print_r($resposta['body']);

        if (!empty($resposta['error'])) {
            echo "Erro cURL: " . $resposta['error'] . PHP_EOL;
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function delete()
    {
        $pessoa_id = 4;

        $resposta = $this->ApiClientAtomPHP->request("DELETE", "apagar/{$pessoa_id}");

        echo "Status: " . $resposta['status'] . PHP_EOL;
        echo "Resposta:" . PHP_EOL;
        print_r($resposta['body']);

        if (!empty($resposta['error'])) {
            echo "Erro cURL: " . $resposta['error'] . PHP_EOL;
        }
    }
}