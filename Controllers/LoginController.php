<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuario;

class LoginController extends Controller
{
	public function index()
	{
		if (!empty($_POST['email']) && !empty($_POST['senha'])) {
			$email = $_POST['email'];
			$senha = md5($_POST['senha']);

			$usuario = new Usuario();

			if ($usuario->login($email, $senha)) {
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