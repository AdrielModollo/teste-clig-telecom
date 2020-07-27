<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\Livro;

class LivrosController extends Controller
{
	public function __construct()
    {
        $this->usuario = new Usuario();
        $this->livro = new Livro();

        if (!$this->usuario->estaLogado()) {
            header('Location: '.BASE_URL.'login');
        }
    }

	public function index()
	{
		$data = [];
        $data['livros'] = $this->livro->getLivros();
		return $this->loadTemplate('livros', $data);
	}
}