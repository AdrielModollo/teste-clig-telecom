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
    
    public function add()
    {
        $data = [];
        $data['erros'] = [];

        if (isset($_POST['nome']) && isset($_POST['autor'])  && isset($_POST['descricao'])) {
            if (empty($_POST['nome']) && empty($_POST['autor'])   && empty($_POST['descricao'])) { 
                array_push($data['erros'], 'É obrigatório preencher todos os dados');
            }
            
            if (strlen($_POST['nome']) && strlen($_POST['autor']) && strlen($_POST['descricao'])> 100) {
                array_push($data['erros'], 'Os campos deve possuir no máximo 100 caracteres');
            }
            
            if (count($data['erros']) > 0) {
                return $this->loadTemplate('adicionar_livro', $data);
            } else {
                $this->categoria->adicionar($_POST['nome']);
                $this->categoria->adicionar($_POST['autor']);
                $this->categoria->adicionar($_POST['descricao']);
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