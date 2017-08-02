<?php


class Users extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new UsersModel();
    }

    public function admin_login()
    {
        if ( isset($_POST['login']) && !empty($_POST['login']) && !empty($_POST['pass']) ) {
            $user = $this->model->getUserByLoin($_POST['login']);
            $pass = md5(Config::get('pass_salt') . $_POST['pass'] . Config::get('pass_pep'));
            if ($user && $user['is_active'] && $user['password'] == $pass) {
                Session::setValue('user' , $user['login']);
                Session::setValue('role' , $user['role']);
            }
            Router::redirect('admin');
        }
    }
}