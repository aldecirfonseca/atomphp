<?php

namespace Core\Library;

class Routes
{
    use RequestTrait;

    /**
     * rota
     *
     * @return void
     */
    public static function rota()
    {
        $pathContr      = "App" . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR;
        $aParametros    = Self::getRotaParametros();
        $controller     = $pathContr . $aParametros['controller'];
        $id             = isset($aParametros[3]) ? $aParametros[3] : 0;
        $outrosParam    = (count($aParametros) > 4 ? array_slice($aParametros, 4) : []);
    
        if (!class_exists($controller)) {
            Erros::controllerNotFound();
        } else {
            if (!method_exists($controller, $aParametros['method'])){
                Erros::methodNotFound();
            } else {
                $instance = new $controller();
                call_user_func_array([$instance, $aParametros['method']], array_merge([$aParametros['action'], $id], $outrosParam));
                return null;
            }
        }
    }
}