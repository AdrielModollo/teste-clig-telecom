<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuario;
use \Models\Livro;
use \Models\Categoria;

class LivrosController extends Controller
{
	public function __construct()
    {
        $this->usuario = new Usuario();
        $this->livro = new Livro();
        $this->categoria = new Categoria();

        if (!$this->usuario->estaLogado()) {
            header('Location: '.BASE_URL.'login');
        }
    }

	public function index()
	{
		$data = [];
        $data['livros'] = $this->livro->getLivrosPorFiltro($_POST);
        $data['categorias'] = $this->categoria->getCategorias();
		return $this->loadTemplate('livros', $data);
    }

    public function reset() {
        $data = [];
        $data['livros'] = $this->livro->getLivrosPorFiltro([]);
        $data['categorias'] = $this->categoria->getCategorias();
		return $this->loadTemplate('livros', $data);
    }
    
    public function add()
    {
        $data = [];
        $data['categorias'] = $this->categoria->getCategorias();
        $data['erros'] = [];

        if (isset($_POST['titulo'])) { 
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $descricao = $_POST['descricao'];
            $categoria_id = $_POST['categoria_id'];
            
            $data['erros'] = $this->validar_formulario($data['erros']);

            if (count($data['erros']) > 0) {
                return $this->loadTemplate('adicionar_livro', $data);
            } else {
                $this->livro->adicionar($titulo, $autor, $descricao, $categoria_id);
                header('Location: '.BASE_URL.'livros');
            }    
        }

        return $this->loadTemplate('adicionar_livro', $data);
    } 

    public function edit(int $livro_id) {
        $data = [];
        $data['livro'] = $this->livro->getLivro($livro_id);
        $data['categorias'] = $this->categoria->getCategorias();
        $data['erros'] = [];

        if ($data['livro'] == null) {
            header('Location: '.BASE_URL.'livros');
        }

        if (isset($_POST['titulo'])) {
            $data['erros'] = $this->validar_formulario($data['erros']);
            
            if (count($data['erros']) > 0) {
                header('Location: '.BASE_URL.'livros/edit/'.$livro_id);
            } else {
                $this->livro->atualizar(
                    $livro_id, 
                    $_POST['titulo'], 
                    $_POST['autor'],
                    $_POST['descricao'],
                    $_POST['categoria_id']
                );
                    
                header('Location: '.BASE_URL.'livros');
            }    
        }

        return $this->loadTemplate('editar_livro', $data);
    }
    
    private function validar_formulario($erros): array {
        if (empty($_POST['titulo'])) {
            array_push($erros, 'O título do livro é obrigatório');
        }

        if (strlen($_POST['titulo']) > 100) {
            array_push($erros, 'O título do livro deve possuir no máximo 100 caracteres');
        }

        if (empty($_POST['autor'])) {
            array_push($erros, 'O nome do autor é obrigatório');
        }

        if (strlen($_POST['autor']) > 100) {
            array_push($erros, 'O nome do autor deve possuir no máximo 100 caracteres');
        }

        if (empty($_POST['categoria_id'])) {
            array_push($erros, 'A categoria é obrigatória');
        }

        return $erros;
    } 

    public function delete(int $id): void
    {
        $this->livro->excluir($id);
        header('Location: '.BASE_URL.'livros');
    }

}