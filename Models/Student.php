<?php

namespace Models;

use \Core\Model;

class Student extends Model
{
    private $info;

    public function isLoggedIn(): bool
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

    public function setStudent(int $id): void
    {
        $sql = 'SELECT id, name, email FROM students WHERE id = :id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->info = $sql->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public function isEnrolled(int $course_id): bool
    {
        $sql = 'SELECT id, 
                       course_id, 
                       student_id
                FROM courses_has_students
                WHERE student_id = :student_id
                AND course_id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':student_id', $this->getId());
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function getName(): string
    {
        return $this->info['name'];
    }

    public function getId(): int
    {
        return $this->info['id'];
    }
}