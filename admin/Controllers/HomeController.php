<?php

namespace Controllers;

use \Core\Controller;
use \Models\User;

class HomeController extends Controller 
{
	public function __construct()
	{
		$user = new User();

		if (!$user->isLoggedIn()) {
			header('Location: '.BASE_URL.'/login');
		}
	}

    public function index() 
    {
        $this->loadTemplate('home', []);
    }
}