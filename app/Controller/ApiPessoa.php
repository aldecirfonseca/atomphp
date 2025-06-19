<?php

namespace App\Controller;

use App\Model\PessoaModel;

use Core\Library\Api;
use Core\Library\Request;
use Core\Library\Response;
use Core\Library\Session;
use Core\Library\Validator;

class ApiPessoa extends Api
{
    private $requestMethod;

    /**
     * construct
     */
    public function __construct()
    {
        $this->auxiliarconstruct();

        $this->model = new PessoaModel();
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * criar
     *
     * @return json
     */
    public function criar()
    {
        $this->validateToken();

        if ($this->requestMethod == "POST") {

            $dadosJson = Request::getJson();        // Lê dados enviados

            if (Validator::make($dadosJson, $this->model->validationRules)) {

                return Response::json([
                    'status' => 400,
                    'message' => $this->getMessageValidationRules(),
                ]);

            }

            $aPessoa = $this->model->db->where("email", $dadosJson['email'])->first();

            if (count($aPessoa) == 0) {

                // Insere a nova empresa no banco com o CNPJ enviado e a razão social retornada da API
                $pessoa_id = $this->model->db->insert($dadosJson);

                if ($pessoa_id === 0) {         // caso a pessoa não seja incluída
                    return Response::json([
                        'status' => 500,
                        'message' => Session::getDestroy("msgError"),
                    ]);
                }

                return Response::json([
                    'status' => 201,
                    'message' => 'Pessoa cadastrada com sucesso.',
                    'data' => [
                        'id' => $pessoa_id,
                    ],
                ]);
            } else {

                return Response::json([
                    'status' => 400,
                    'message' => 'Pessoa já cadastrada. Caso deseja pode atualizar seus dados',
                ]);
            }

        } else {

            return Response::json([
                'status' => 405,
                'message' => 'Método não permitido.',
            ]);
        }
    }

    /**
     * atualizar
     *
     * @return json
     */
    public function atualizar()
    {
        $this->validateToken();

        if ($this->requestMethod == "PUT") {

            $dadosJson = Request::getJson();        // Lê dados enviados

            $this->model->validationRules['pessoa_id'] = [
                    "label" => 'Id da Pessoa',
                    "rules" => 'required|int'
            ];

            if (Validator::make($dadosJson, $this->model->validationRules)) {

                return Response::json([
                    'status' => 400,
                    'message' => $this->getMessageValidationRules(),
                ]);

            }

            $aPessoa = $this->model->db->where(["id" => $dadosJson['pessoa_id']])->first();

            if (count($aPessoa) != 0) {

                $pessoa_id = $dadosJson['pessoa_id'];
                unset($dadosJson['pessoa_id']);

                // Insere a nova empresa no banco com o CNPJ enviado e a razão social retornada da API
                $pessoa_id = $this->model->db->where("id", $pessoa_id)->update($dadosJson);

                if ($pessoa_id === 0) {         // dados não atualizado
                    return Response::json([
                        'status' => 500,
                        'message' => Session::getDestroy("msgError"),
                    ]);
                }

                return Response::json([
                    'status' => 201,
                    'message' => 'Pessoa atualizada com sucesso.',
                ]);
            } else {

                return Response::json([
                    'status' => 400,
                    'message' => "Pessoa não localizada.",
                ]);
            }

        } else {

            return Response::json([
                'status' => 405,
                'message' => 'Método não permitido.',
            ]);
        }
    }

    /**
     * apagar
     *
     * @return json
     */
    public function apagar($pessoa_id)
    {
        $this->validateToken();

        if ($this->requestMethod == "DELETE") {

            $aPessoa = $this->model->db->where(["id" => $pessoa_id])->first();

            if (count($aPessoa) != 0) {

                // Insere a nova empresa no banco com o CNPJ enviado e a razão social retornada da API
                $pessoa_id = $this->model->db->where("id", $pessoa_id)->delete();

                if ($pessoa_id === 0) {         // dados não excluídos
                    return Response::json([
                        'status' => 500,
                        'message' => Session::getDestroy("msgError"),
                    ]);
                }

                return Response::json([
                    'status' => 201,
                    'message' => 'Pessoa excluída com sucesso.',
                ]);
            } else {

                return Response::json([
                    'status' => 400,
                    'message' => "Pessoa não localizada.",
                ]);
            }

        } else {

            return Response::json([
                'status' => 405,
                'message' => 'Método não permitido.',
            ]);
        }
    }

    /**
     * listar
     *
     * @return json
     */
    public function listar()
    {
        $this->validateToken();

        if ($this->requestMethod == "GET") {

            $aPessoa = $this->model->db->orderby("nome")->findAll();

            if (count($aPessoa) > 0) {

                return Response::json([
                    'status' => 201,
                    'message' => 'Pessoa listadas com sucesso.',
                    "data" => $aPessoa,
                ]);
            } else {

                return Response::json([
                    'status' => 400,
                    'message' => "Não existem pessoas cadastradas.",
                ]);
            }

        } else {

            return Response::json([
                'status' => 405,
                'message' => 'Método não permitido.',
            ]);
        }
    }


        /**
     * listar
     *
     * @return json
     */
    public function getPessoa()
    {
        $this->validateToken();

        if ($this->requestMethod == "POST") {

            $dadosJson = Request::getJson();        // Lê dados enviados

            $aPessoa = $this->model->db->where(["email" => $dadosJson['email']])->first();

            if (count($aPessoa) != 0) {

                return Response::json([
                    'status' => 201,
                    'message' => 'Dados retornados com sucesso.',
                    "data" => $aPessoa,
                ]);
            } else {

                return Response::json([
                    'status' => 400,
                    'message' => "Não existem pessoas cadastradas.",
                ]);
            }

        } else {

            return Response::json([
                'status' => 405,
                'message' => 'Método não permitido.',
            ]);
        }
    }
}
