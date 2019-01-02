<?php

namespace Models;

use \Core\Model;

class Student extends Model
{
    public function isLoggedIn()
    {
        if (!empty($_SESSION['student'])) {
            return true;
        }
        return false;
    }

    public function login(string $email, string $password): bool
    {
        $sql = 'SELECT id, name, email FROM students WHERE email = :email AND password = :password';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['student'] = $row['id'];
            return true;
        }
        return false;
    }
}