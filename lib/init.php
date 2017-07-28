<?php

spl_autoload_register( 'my_autoload_register' );
function my_autoload_register( $className ) {
    $libPath = ROOT . DS . 'lib' . DS . $className . '.php';
    $controllerPath = ROOT . DS . 'controllers' . DS . $className . '.php';
    $modelsPath = ROOT . DS . 'models' . DS . $className . '.php';

    if( file_exists( $libPath ) ) {
        require_once($libPath);
    }
    elseif ( file_exists($controllerPath)) {
        require_once($controllerPath);
    }
    elseif ( file_exists($modelsPath)) {
        require_once($modelsPath);
    }
    else {
        throw new Exception('Unknown class: ' . $className);
    }
}
require_once (ROOT . DS . 'config' . DS . 'config.php');
