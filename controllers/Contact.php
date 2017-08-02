<?php


class Contact extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new MessageModel();
    }

    public function index()
    {
        if ($_POST) {
            if ($this->model->save($_POST)) {
                Session::setUserMessage('Your message was added');
            }
        }
    }

    public function admin_index()
    {
        $this->data['messages'] = $this->model->messagesList();
    }
}