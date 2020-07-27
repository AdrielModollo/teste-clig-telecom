<?php

namespace Controllers;

use \Core\Controller;
use \Models\Livro;

class LivrosController extends Controller
{
	public function index()
	{
		return $this->loadTemplate('livros', []);
	}
}