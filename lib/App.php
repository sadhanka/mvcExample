<?php

class App
{
    public static $router;
    public static $db;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri) {
        self::$router = new Router($uri);

        self::$db = DB::getInstance();

        Lang::load(self::$router->getLanguage());

        $controllerClass = ucfirst(self::$router->getController());
        $controllerMethod = self::$router->getMethodPrefix() . self::$router->getAction();

        $layout = self::$router->getRoute();
        if ( $layout == 'admin' && Session::getValue('role') != 'admin' && $controllerMethod != 'admin_login') {
            Router::redirect('admin/users/login');

        }

        if (class_exists($controllerClass)) {
            $controllerObj = new $controllerClass;
            if(method_exists($controllerObj, $controllerMethod)) {
                $controllerObj->$controllerMethod();
                $viewObj = new Views($controllerObj->getData());
                $content = $viewObj->render();
            }
            else {
                throw new Exception('Method "' . $controllerMethod . '" of Class "' . $controllerClass . '" wasnot found');
            }
        }
        else {
            throw new Exception('Class "' . $controllerClass .'" wasnot found');
        }

        $layoutPath = ROOT . DS . Config::get('views_dir') . DS . $layout . '.html';

        $layoutObj = new Views(compact('content'), $layoutPath);

        echo $layoutObj->render();

    }
}