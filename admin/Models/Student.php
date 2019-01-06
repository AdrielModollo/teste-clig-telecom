<?php

namespace Models;

use \Core\Model;

class Student extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(): array
    {
        $array = [];

        $sql = 'SELECT 
                    id, 
                    name,
                    (select 
                        count(*) 
                    from courses_has_students 
                    WHERE student_id = students.id) AS number_of_courses
                FROM students';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
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

    public function add(string $name, string $email, string $password): void
    {
        $sql = 'INSERT INTO students
                    (name, email, password)
                VALUES
                    (:name, :email, :password)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', md5($password));
        $sql->execute();
    }

    public function studentAlreadyExists(string $email): bool
    {
        $sql = 'SELECT id FROM students WHERE email = :email';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();

        return $sql->rowCount() > 0;
    }

    public function getStudentById(int $student_id): array
    {
        $array = [];

        $sql = 'SELECT name, email
                FROM students
                WHERE id = :student_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':student_id', $student_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function update(string $name, string $email, int $student_id): void
    {
        $params = func_get_args();

        $sql = 'UPDATE students
                SET name = ?, email = ?
                WHERE id = ?';
        $sql = $this->database->prepare($sql);
        $sql->execute($params);
    }
}