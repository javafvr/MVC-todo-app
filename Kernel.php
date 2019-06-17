<?php

namespace App;

use App;

class Kernel
{

    public $defaultControllerName = 'Tasks';

    public $defaultActionName = "index";

    public function launch()
    {

        list($controllerName, $actionName, $params) = App::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);

    }

    public function launchAction($controllerName, $actionName, $params)
    {

        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        $path = ROOTPATH.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!file_exists($path)){
            throw new \App\Exceptions\InvalidRouteException();
        }
        require_once $path;
        if(!class_exists("\\App\\Controller\\".ucfirst($controllerName))){
            throw new \App\Exceptions\InvalidRouteException();
        }
        $controllerName = "\\App\\Controller\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)){
            throw new \App\Exceptions\InvalidRouteException();
        }
        return $controller->$actionName($params);

    }

}