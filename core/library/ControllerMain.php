<?php

namespace Core\Library;

class ControllerMain
{
    protected $controller;
    protected $method;
    protected $action;
    public $model;

    use RequestTrait;

    /**
     * construct
     */
    public function __construct()
    {
        $this->auxiliarConstruct();
    }

    /**
     * auxiliarconstruct
     *
     * @return void
     */
    public function auxiliarconstruct()
    {
        $aParametros        = Self::getRotaParametros();
        $this->controller   = $aParametros['controller'];
        $this->method       = $aParametros['method'];
        $this->action       = $aParametros['action'];
        $this->model        = $this->loadModel($this->controller);

        // carregar helper padrão
        $this->loadHelper("atomaux");
    }

    /**
     * loadModel
     *
     * @param string $nomeModel 
     * @return void|object
     */
    public function loadModel($nomeModel)
    {
        $pathModel = "App" . DIRECTORY_SEPARATOR . "Model" . DIRECTORY_SEPARATOR . $nomeModel . "Model";
        
        if (class_exists($pathModel)) {
            return new $pathModel();
        }
    }

    /**
     * loadHelper
     *
     * @param string|array $nomeHelper 
     * @return void
     */
    public function loadHelper($nomeHelper)
    {
        if (gettype($nomeHelper) == "string") {
            $nomeHelper = [$nomeHelper];
        }

        foreach ($nomeHelper AS $value) {
            $pathHelperAtom = ".." . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "helper" . DIRECTORY_SEPARATOR . "{$value}.php";
            
            if (file_exists($pathHelperAtom)) {
                require_once $pathHelperAtom;
            } else {
                $pathHelperUser = ".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "helper" . DIRECTORY_SEPARATOR . "{$value}.php";

                if (file_exists($pathHelperUser)) {
                    require_once $pathHelperUser;
                }
            }        
        }
    }

    /**
     * loadView
     *
     * @param string $nome 
     * @param array $dados 
     * @param bool $exibeCabRodape 
     * @return void
     */
    public function loadView($nome, $dados = [], $exibeCabRodape = true)
    {
        $aDados = $dados;
        $pathView = ".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR;

        // carrega cabeçalho
        if ($exibeCabRodape) {
            require_once $pathView . "comuns" . DIRECTORY_SEPARATOR . "cabecalho.php";
        }

        // carrega a página
        if (file_exists($pathView . $nome . ".php")) {
            require_once $pathView . $nome . ".php";
        } else {
            require_once $pathView . "comuns" . DIRECTORY_SEPARATOR . "erros.php";
        }

        // carrega rodapé
        if ($exibeCabRodape) {
            require_once $pathView . "comuns" . DIRECTORY_SEPARATOR . "rodape.php";
        }
    }
}