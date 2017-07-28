<?php


class Contact extends Controller
{
    public function index()
    {
        $this->data['test_content'] = 'This is index() of Page Class';
    }
}