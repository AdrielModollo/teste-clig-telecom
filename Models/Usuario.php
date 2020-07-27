<?php

namespace Models;

use \Core\Model;

class Usuario extends Model
{
    private $info;

    public function estaLogado(): bool
    {
        if (!empty($_SESSION['usuario'])) {
            return true;
        }
        return false;
    }

    public function login(string $email, string $senha): bool
    {
        $sql = 'SELECT id, email FROM usuarios WHERE email = :email AND senha = :senha';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['usuario'] = $row['id'];
            return true;
        }
        return false;
    }

    public function setUsuario(int $id): void
    {
        $sql = 'SELECT id, email FROM usuarios WHERE id = :id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->info = $sql->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public function getId(): int
    {
        return $this->info['id'];
    }

}