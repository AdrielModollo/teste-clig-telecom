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
            $data['erros'] = $this->validar_formulario($data['erros']);
            
            if (count($data['erros']) > 0) {
                return $this->loadTemplate('adicionar_categoria', $data);
            } else {
                $this->categoria->adicionar($_POST['nome']);
                header('Location: '.BASE_URL.'categorias');
            }    
        }

        return $this->loadTemplate('adicionar_categoria', $data);
    }

    public function edit(int $categoria_id) {
        $data = [];
        $data['categoria'] = $this->categoria->getCategoria($categoria_id);
        $data['erros'] = [];

        if ($data['categoria'] == null) {
            header('Location: '.BASE_URL.'categorias');
        }

        if (isset($_POST['nome'])) {
            $data['erros'] = $this->validar_formulario($data['erros']);
            
            if (count($data['erros']) > 0) {
                header('Location: '.BASE_URL.'categorias/edit/'.$categoria_id);
            } else {
                $this->categoria->atualizar($categoria_id, $_POST['nome']);
                header('Location: '.BASE_URL.'categorias');
            }    
        }

        return $this->loadTemplate('editar_categoria', $data);
    }

    private function validar_formulario($erros): array {
        if (empty($_POST['nome'])) {
            array_push($erros, 'O nome da categoria é obrigatório');
        }
        
        if (strlen($_POST['nome']) > 100) {
            array_push($erros, 'O nome da categoria deve possuir no máximo 100 caracteres');
        }

        return $erros;
    } 

    public function delete(int $categoria_id): void
    {
        $this->categoria->excluir($categoria_id);
        header('Location: '.BASE_URL.'categorias');
    }

}