<?php

class App {
    public static $router;
    public static $db;
    public static $kernel;
    public static $authUser;

    public static function init()
    {
        spl_autoload_register(['static','loadClass']);
        static::bootstrap();
        //set_exception_handler(['App','handleException']);
    }

    public static function bootstrap()
    {
        static::$router = new App\Router();
        static::$kernel = new App\Kernel();
        static::$db = new App\Db();
    }

    public static function loadClass ($className)
    {
        $className = str_replace('\\', DS, $className);
        require_once ROOTPATH.DS.$className.'.php';
    }

    public function handleException (Throwable $e)
    {
        if($e instanceof \App\Exceptions\InvalidRouteException) {
            echo static::$kernel->launchAction('Error', 'error404', [$e]);
        }else{
            echo static::$kernel->launchAction('Error', 'error500', [$e]);
        }
    }
}