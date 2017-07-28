<?php


class Views
{
    protected $data;
    protected $path;

    public function __construct($data = [], $path = '')
    {
        $this->data = $data;
        $this->path = $path;
        if (empty($this->path)) {
            $this->path = $this->getDefaultPath();
        }
        if (!file_exists($this->path)) {
            throw new Exception('File "' . $this->path .'" doesnot exist');
        }
    }

    protected function getDefaultPath() {
        $router = App::$router;
        if ( !$router ){
            return false;
        }
        $templateName = $router->getMethodPrefix() . $router->getAction() . '.html';
        $templatePath = ROOT . DS . Config::get('views_dir') . DS . $router->getController() . DS . $templateName;

        return $templatePath;
    }

    public function render()
    {
        $data = $this->data;
        ob_start();
        include($this->path);
        $content = ob_get_clean();

        return $content;
    }
}