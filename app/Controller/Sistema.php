<?php

namespace App\Controller;

use App\Model\UsuarioModel;
use Core\Library\ControllerMain;
use Core\Library\Redirect;
use Core\Library\Session;

class Sistema extends ControllerMain
{
    public function index()
    {
        return $this->loadView("sistema/home");
    }

        /**
     * formTrocarSenha
     *
     * @return void
     */
    public function formTrocarSenha()
    {
        return $this->loadView("sistema/formTrocaSenha");
    }

    /**
     * updateNovaSenha
     *
     * @return void
     */
    public function updateNovaSenha() 
    {
        $post       = $this->request->getPost();
        $UsuarioModel = new UsuarioModel();
        $userAtual  = $UsuarioModel->getById($post["id"]);

        if ($userAtual) {

            if (password_verify(trim($post["senhaAtual"]), $userAtual['senha'])) {

                if (trim($post["novaSenha"]) == trim($post["novaSenha2"])) {

                    $novaSenhaCripyt = password_hash(trim($post["novaSenha"]), PASSWORD_DEFAULT);

                    $lUpdate = $UsuarioModel->db->where(['id' => $post['id']])->update([
                        'senha' => $novaSenhaCripyt
                    ]);
                        
                    if ($lUpdate) {
                        // Atualiza sessão de senhas
                        Session::set("userSenha", $novaSenhaCripyt);

                        return Redirect::page("Sistema/formTrocarSenha", [
                            "msgSucesso"    => "Senha alterada com sucesso !"
                        ]);  
                    } else {
                        return Redirect::page("Sistema/formTrocarSenha");    
                    }

                } else {
                    return Redirect::page("Sistema/formTrocarSenha", [
                        "msgError"    => "Nova senha e conferência da senha estão divergentes !"
                    ]);                  
                }

            } else {
                return Redirect::page("Sistema/formTrocarSenha", [
                    "msgError"    => "Senha atual informada não confere!"
                ]);               
            }
        } else {
            return Redirect::page("Sistema/formTrocarSenha", [
                "msgError"    => "Usuário inválido !"
            ]);   
        }
    }
}
