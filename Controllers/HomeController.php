<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuario;

class HomeController extends Controller 
{
    public function __construct()
    {
        $usuario = new Usuario();
        if (!$usuario->estaLogado()) {
            header('Location: '.BASE_URL.'login');
        }
    }

    public function index(): void
    {
        $data = [
            'info' => []
        ];

        $usuario = new Usuario();
        $usuario->setUsuario($_SESSION['usuario']);

        $data['info'] = $usuario;
        $this->loadTemplate('home', $data);
    }
}