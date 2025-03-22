<?php

namespace Core\Library;

class ControllerMain
{
    protected $controller;
    protected $method;
    protected $action;
    protected $model;

    use RequestTrait;

    public function __construct()
    {
        $this->auxiliarConstruct();
    }

    public function auxiliarconstruct()
    {
        $aParametros        = Self::getRotaParametros();
        $this->controller   = $aParametros['controller'];
        $this->method       = $aParametros['method'];
        $this->action       = $aParametros['action'];

        // carregar helper padrão
        // Model padrão
    }
}