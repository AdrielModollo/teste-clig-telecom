<?php

namespace Controllers;

use \Core\Controller;
use \Models\Student;

class HomeController extends Controller 
{
	public function __construct()
	{
		$student = new Student();

		if (!$student->isLoggedIn()) {
			header('Location: '.BASE_URL.'login');
		}
	}

    public function index() 
    {
        $this->loadTemplate('home', []);
    }
}