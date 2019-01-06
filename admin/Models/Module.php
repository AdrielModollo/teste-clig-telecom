<?php

namespace Models;

use \Core\Model;

class Module extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getModules(int $course_id): array
    {
        $array = [];

        $sql = 'SELECT id, course_id, name
                FROM modules
                WHERE course_id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $lesson = new Lesson();

            foreach($array as $key => $value) {
                $array[$key]['lessons'] = $lesson->getLessonsByModule($value['id']);
            }
        }
        return $array;
    }

    public function add(string $module_name, int $course_id): void  
    {
        $sql = 'INSERT INTO modules
                    (name, course_id)
                VALUES
                    (:module_name, :course_id)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':module_name', $module_name);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();
    }

    public function delete(int $module_id): void
    {
        $sql = 'DELETE FROM modules WHERE id = :module_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':module_id', $module_id);
        $sql->execute();
    }

    public function getModule(int $module_id): array
    {
        $array = [];

        $sql = 'SELECT name
                FROM modules
                WHERE id = :module_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':module_id', $module_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function update(string $module_name, int $module_id): void
    {
        $sql = 'UPDATE modules
                SET name = :module_name
                WHERE id = :module_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':module_name', $module_name);
        $sql->bindValue(':module_id', $module_id);
        $sql->execute();
    }
}