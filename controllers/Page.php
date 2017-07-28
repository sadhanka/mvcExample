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
}