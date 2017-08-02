<?php
/**
 * Created by PhpStorm.
 * User: Lyubov Zhurba
 * Date: 21.07.2017
 * Time: 19:29
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('DIR', dirname(__DIR__));

require_once(ROOT . DS . 'lib' . DS . 'init.php');
session_start();
$uri = $_SERVER['REQUEST_URI'];
App::run($uri);
