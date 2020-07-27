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

    public function add()
    {
        $data = [];
        $data['erros'] = [];

        if (isset($_POST['nome'])) {
            if (empty($_POST['nome'])) {
                array_push($data['erros'], 'O nome da categoria é obrigatório');
            }
            
            if (strlen($_POST['nome']) > 100) {
                array_push($data['erros'], 'O nome da categoria deve possuir no máximo 100 caracteres');
            }
            
            if (count($data['erros']) > 0) {
                return $this->loadTemplate('adicionar_categoria', $data);
            } else {
                $this->categoria->adicionar($_POST['nome']);
                header('Location: '.BASE_URL.'categorias');
            }    
        }

        return $this->loadTemplate('adicionar_categoria', $data);
    }
    
    public function delete(int $categoria_id): void
    {
        $this->categoria->excluir($categoria_id);
        header('Location: '.BASE_URL.'categorias');
    }

}