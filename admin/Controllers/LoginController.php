<?php

namespace Controllers;

use \Core\Controller;
use \Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $user = new User();

            if ($user->login($email, $password)) {
                header('Location: '.BASE_URL);
            }
        }

        return $this->loadTemplate('login', []);
    }

    public function logout()
    {
        session_destroy();
        header('Location: '.BASE_URL);
    }
}