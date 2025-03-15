<?php

namespace Core;

class Routes
{
    /**
     * rota
     *
     * @return void
     */
    public static function rota()
    {
        $pathContr      = "App" . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR;
        $aParametros    = explode("/", ltrim(filter_var(rtrim($_SERVER['REQUEST_URI'], "/"), FILTER_SANITIZE_URL), "/"));
        $controller     = $pathContr . (isset($aParametros[0]) && !empty($aParametros[0]) ? ucfirst($aParametros[0]) : DEFAULT_CONTROLLER);
        $metodo         = isset($aParametros[1]) ? $aParametros[1] : DEFAULT_METODO;
        $action         = isset($aParametros[2]) ? $aParametros[2] : "view";
        $id             = isset($aParametros[3]) ? $aParametros[3] : 0;
        $outrosParam    = (count($aParametros) > 4 ? array_slice($aParametros, 4) : []);
    
        if (!class_exists($controller)) {
            Erros::controllerNotFound();
        } else {
            if (!method_exists($controller, $metodo)){
                Erros::methodNotFound();
            } else {
                $instance = new $controller();
                call_user_func_array([$instance, $metodo], array_merge([$action, $id], $outrosParam));
                return null;
            }
        }
    }
}