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
        if ( $_POST ) {
            if ( !empty( $_POST['id']) && is_numeric( $_POST['id'])) {
                $saved = $this->model->save($_POST, $_POST['id']);
                if ($saved) {
                    Session::setUserMessage('Page "' . $_POST['title'] . '" was added');
                } else {
                    Session::setUserMessage('Error while adding page "' . $_POST['title'] . '"');
                }
            }
            else {
                Session::setUserMessage('Error - page id was missed');
            }
            Router::redirect('admin/page');
        }

        if ( isset($this->params[0]) && is_numeric($this->params[0]) ) {
            $this->data['pages'] = $this->model->getPagesById($this->params[0]);
        }
        else {
            Session::setUserMessage('Incorrect page ID');
            Router::redirect('admin/page');
        }
    }

    public function add()
    {
        if ( $_POST ) {
            $saved = $this->model->save($_POST);
            if ($saved) {
                Session::setUserMessage('Page "' . $_POST['title'] . '" was added');
            }
            else {
                Session::setUserMessage('Error while adding page "' . $_POST['title'] . '"');
            }
            Router::redirect('admin/page');
        }
    }
}