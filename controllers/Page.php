<?php


class Page extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new PageModel();
    }
    public function index()
    {
        $this->data['pages'] = $this->model->pagesList();
    }

    public function view()
    {
        $paramsArray = App::getRouter()->getParams();
        $alias = $paramsArray[0];
        $this->data['pages'] = $this->model->getPage($alias);
    }

    public function admin_index()
    {
        $this->data['pages'] = $this->model->pagesList();
    }

    public function edit()
    {
        if ( isset($this->params[0]) && is_numeric($this->params[0]) ) {
            $this->data['pages'] = $this->model->getPagesById($this->params[0]);
        }
        else {
            Session::setUserMessage('Incorrect page ID');
        }
    }
}