<?php


class Page extends Controller
{
    public function index()
    {
        $this->data['test_content'] = 'This is index() of Page Class';
    }

    public function view()
    {
        $paramsArray = App::getRouter()->getParams();
        $this->data['content'] = 'This is view() and param[0] ' . @$paramsArray[0];
    }
}