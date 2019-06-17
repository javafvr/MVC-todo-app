<?php
session_start();

if (!defined('ROOTPATH')) {
	define('ROOTPATH', dirname(dirname(dirname(__FILE__))));
}

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

define('WWW_ROOT', $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"]);

require ROOTPATH.'/App/App.php';

App::init();
App::$kernel->launch();