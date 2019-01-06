<?php

namespace Models;

use \Core\Model;

class Course extends Model
{
    private $info;

    public function getCoursesByStudent(int $id): array
    {
        $array = [];

        $sql = 'SELECT courses_has_students.course_id,
                       courses.name,
                       courses.image,
                       courses.description
                FROM courses_has_students
                LEFT JOIN courses ON courses.id = courses_has_students.course_id
                WHERE courses_has_students.student_id = :id';

        $sql = $this->database->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function setCourse(int $id): void
    {
        $sql = 'SELECT id, 
                       name, 
                       image, 
                       description 
                FROM courses 
                WHERE id = :id';
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

    public function getName(): string
    {
        return $this->info['name'];
    }

    public function getImage(): string
    {
        return $this->info['image'];
    }

    public function getDescription(): string
    {
        return $this->info['description'];
    }

    public function getTotalLessons(): int
    {
        $sql = 'SELECT COUNT(*) AS count
                FROM lessons
                WHERE course_id = ?';
        $sql = $this->database->prepare($sql);
        $sql->execute([$this->getId()]);

        return $sql->fetch(\PDO::FETCH_ASSOC)['count'];
    }
}