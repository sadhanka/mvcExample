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
        $controllerMethod = self::$router->getAction();

        if (class_exists($controllerClass)) {
            $controllerObj = new $controllerClass;
            if(method_exists($controllerObj, $controllerMethod)) {
                $controllerObj->$controllerMethod();
//                var_dump($controllerObj->getData());
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

        $layout = self::$router->getRoute();
        $layoutPath = ROOT . DS . Config::get('views_dir') . DS . $layout . '.html';

        $layoutObj = new Views(compact('content'), $layoutPath);

        echo $layoutObj->render();

    }
}