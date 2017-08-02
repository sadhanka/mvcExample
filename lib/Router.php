<?php

/**
 * Created by PhpStorm.
 * User: Lyubov Zhurba
 * Date: 21.07.2017
 * Time: 20:10
 */
class Router
{
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $newUri;
    protected $language;
    protected $route;
    protected $methodPrefix;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }
    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->methodPrefix;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        $routs = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->methodPrefix = isset($routs[$this->route]) ? $routs[$this->route] : '';
        $this->language = Config::get('default_language');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uriParts = explode('?', $this->uri);

        $uriFirstPart = isset($uriParts[0]) ? $uriParts[0] : $this->uri;

        $uriArray = $this->getRealUri($uriFirstPart);

        if (count($uriArray)) {
            if ( in_array(strtolower(current($uriArray)), array_keys($routs))) {
                $this->route = strtolower(current($uriArray));
                $this->methodPrefix = isset($routs[$this->route]) ? $routs[$this->route] : '';
                array_shift($uriArray);
            }
            elseif ( in_array(strtolower(current($uriArray)), Config::get('languages'))) {
                $this->language = strtolower(current($uriArray));
                array_shift($uriArray);
            }

            if (current($uriArray)) {
                $this->controller = strtolower(current($uriArray));
                array_shift($uriArray);
            }

            if (current($uriArray)) {
                $this->action = strtolower(current($uriArray));
                array_shift($uriArray);
            }

            $this->params = $uriArray;
        }

    }

    private function getRealUri($strUri = '')
    {
        if ($strUri && Config::get('dir') !== '') {
            $dirArray = explode(DS, Config::get('dir'));
            $arrayUri = explode('/', $strUri);
            $isInArray = false;
            foreach ($dirArray as $key=>$dirPart) {
                if (!empty($dirPart) && $dirPart == $arrayUri[$key]) {
                    array_shift($arrayUri);
                    $isInArray = true;
                }
            }
            if (!$isInArray) {
                throw  new Exception('Config parameter ' .Config::get('dir') . 'is not in URI ' . $strUri);
            }
            return $arrayUri;
        }
        return false;
    }

    public static function redirect($location)
    {
        header('Location: /' . Config::get('dir') . $location);
    }
}