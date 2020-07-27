<?php

namespace Controllers;

use \Core\Controller;
use \Models\Categoria;

class CategoriasController extends Controller
{
	public function index()
	{
		return $this->loadTemplate('categorias', []);
	}
}