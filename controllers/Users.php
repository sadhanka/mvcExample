<?php


class Users extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new UsersModel();
    }
}