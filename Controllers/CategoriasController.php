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

    public function adicionar_categoria(): void
    {
        if (!empty($_POST['nome']) && !empty($_POST['email']) & !empty($_POST['password'])) {
            $name = $_POST['nome'];
            }
            header('Location: '.BASE_URL.'categorias');
    }
           public function delete(int $student_id): void
    {
        // ON CASCADE

        $params = func_get_args();

        $queries = [
            'DELETE FROM courses_has_students WHERE student_id = ?',
            'DELETE FROM historic WHERE student_id = ?',
            'DELETE FROM questions WHERE student_id = ?',
            'DELETE FROM students WHERE id = ?'
        ];

        foreach($queries as $query) {
            $sql = $this->database->prepare($query);
            $sql->execute($params);
        }
    }

}