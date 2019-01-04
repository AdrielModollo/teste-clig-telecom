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
}