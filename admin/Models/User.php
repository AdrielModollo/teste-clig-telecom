<?php

namespace Models;

use \Core\Model;

class User extends Model
{
    private $info;

    public function isLoggedIn(): bool
    {
        if (!empty($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public function login(string $email, string $password): bool
    {
        $sql = 'SELECT id, email 
                FROM admin 
                WHERE email = :email 
                AND password = :password';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['user'] = $row['id'];
            return true;
        }
        return false;
    }
}