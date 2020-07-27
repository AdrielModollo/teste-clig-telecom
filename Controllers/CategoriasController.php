<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\Categoria;

class CategoriasController extends Controller
{
	public function __construct()
    {
        $this->usuario = new Usuario();
        $this->categoria = new Categoria();

        if (!$this->usuario->estaLogado()) {
            header('Location: '.BASE_URL.'login');
        }
    }

	public function index()
	{
		$data = [];
        $data['categorias'] = $this->categoria->getCategorias();
		return $this->loadTemplate('categorias', $data);
	}
}