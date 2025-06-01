<?php

namespace App\Controller;

use Core\Library\ControllerMain;
use Core\Library\Files;
use Core\Library\Redirect;
use Core\Library\Session;
use Core\Library\Validator;

class Uf extends ControllerMain
{
    protected $files;

    public function __construct()
    {
        $this->auxiliarconstruct();
        $this->loadHelper('formHelper');
        $this->files = new Files();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->loadView("sistema\listaUf", $this->model->lista("sigla"));
    }

    public function form($action, $id)
    {
        return $this->loadView("sistema/formUf", $this->model->getById($id));
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/insert/0");
        } else {

            // faz upload da imagem

            if (!empty($_FILES['bandeira']['name'])) {
                
                // Faz upload da imagem
                $nomeRetornado = $this->files->upload($_FILES, 'uf');

                // se for boolean, significa que o upload falhou
                if (is_bool($nomeRetornado)) {
                    Session::set('inputs', $post);
                    return Redirect::page($this->controller . "/form/insert/" . $post['id']);
                } else {
                    $post['bandeira'] = $nomeRetornado[0];
                }
            } else {
                $post['bandeira'] = $post['nomeImagem'];
            }
            //

            if ($this->model->insert($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro inserido com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/insert/0");
            }
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $post = $this->request->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page($this->controller . "/form/update/" . $post['id']);    // error
        } else {

            if (!empty($_FILES['bandeira']['name'])) {

                // Faz uploado da imagem
                $nomeRetornado = $this->files->upload($_FILES, 'uf');

                // se for boolean, significa que o upload falhou
                if (is_bool($nomeRetornado)) {
                    Session::set( 'inputs', $post);
                    return Redirect::page($this->controller . "/form/update/" . $post['id']);
                } else {
                    $post['bandeira'] = $nomeRetornado[0];
                }
                
                if (isset($post['nomeImagem'])) {
                    $this->files->delete($post['nomeImagem'], 'uf');
                }
                
            } else {
                $post['bandeira'] = $post['nomeImagem'];
            }

            //
            unset($post['nomeImagem']);

            if ($this->model->update($post)) {
                return Redirect::page($this->controller, ["msgSucesso" => "Registro alterado com sucesso."]);
            } else {
                return Redirect::page($this->controller . "/form/update/" . $post['id']);
            }
        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        $post = $this->request->getPost();

        if ($this->model->delete($post)) {
            $this->files->delete($post['nomeImagem'], "uf");
            return Redirect::page($this->controller, ["msgSucesso" => "Registro Excluído com sucesso."]);
        } else {
            return Redirect::page($this->controller);
        }
    }
}