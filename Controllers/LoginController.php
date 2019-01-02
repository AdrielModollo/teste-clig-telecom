<?php

namespace Controllers;

use \Core\Controller;
use \Models\Student;

class LoginController extends Controller
{
	public function index()
	{
		if (!empty($_POST['email']) && !empty($_POST['password'])) {
			$email = $_POST['email'];
			$password = md5($_POST['password']);

			$student = new Student();

			if ($student->login($email, $password)) {
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