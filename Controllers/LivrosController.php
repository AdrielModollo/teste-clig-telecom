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
        $data['livros'] = $this->livro->getLivros();
		return $this->loadTemplate('livros', $data);
    }
    
    public function add()
    {
        $data = [];
        $data['categorias'] = $this->categoria->getCategorias();
        $data['erros'] = [];

        if (isset($_POST['nome'])) { 
            $nome = $_POST['nome'];
            $autor = $_POST['autor'];
            $descricao = $_POST['descricao'];
            $categoria_id = $_POST['categoria_id'];

            if (empty($nome)) {
                array_push($data['erros'], 'O nome do livro é obrigatório');
            }

            if (strlen($nome) > 100) {
                array_push($data['erros'], 'O nome do livro deve possuir no máximo 100 caracteres');
            }

            if (empty($autor)) {
                array_push($data['erros'], 'O nome do autor é obrigatório');
            }

            if (strlen($autor) > 100) {
                array_push($data['erros'], 'O nome do autor deve possuir no máximo 100 caracteres');
            }

            if (empty($categoria_id)) {
                array_push($data['erros'], 'A categoria é obrigatória');
            }
            
            if (count($data['erros']) > 0) {
                return $this->loadTemplate('adicionar_livro', $data);
            } else {
                $this->livro->adicionar($nome, $autor, $descricao, $categoria_id);
                header('Location: '.BASE_URL.'livros');
            }    
        }

        return $this->loadTemplate('adicionar_livro', $data);
    }
    
    public function delete(int $id): void
    {
        $this->livro->excluir($id);
        header('Location: '.BASE_URL.'livros');
    }

}