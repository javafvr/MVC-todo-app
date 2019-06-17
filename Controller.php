<?php

namespace App;

use App;
/**
 * Application controller class for organization of business logic.
 * Provides basic functionality, such as rendering views inside layouts.
**/
class Controller {
    public $layoutFile = 'Views/Layout.tpl';
    public function renderLayout ($body)
    {
        ob_start();
        require ROOTPATH.DS.'App'.DS.'View'.DS.'Layouts'.DS."Layout.tpl";
        return ob_get_clean();
    }
    public function render ($viewName, array $params = [])
    {
        $viewFile = ROOTPATH.DS.'App'.DS.'View'.DS.$viewName.'.tpl';
        ob_start();
        extract($params);
        require $viewFile;
        $body = ob_get_clean();

        return $this->renderLayout($body);
    }
}