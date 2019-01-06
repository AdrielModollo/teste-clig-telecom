<?php

namespace Models;

use \Core\Model;

class Lesson extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLessonsByModule(int $id): array
    {
        $array = [];

        $sql = 'SELECT id, module_id, course_id, type, lesson_order
                FROM lessons
                WHERE module_id = :id
                ORDER BY lesson_order';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach($array as $key => $lesson) {
                if ($lesson['type'] == 'video') {
                    $sql = 'SELECT name
                            FROM videos
                            WHERE lesson_id = :lesson_id';
                    $sql = $this->database->prepare($sql);
                    $sql->bindValue(':lesson_id', $lesson['id']);
                    $sql->execute();

                    $array[$key]['name'] = $sql->fetch(\PDO::FETCH_ASSOC)['name'];
                } else if ($lesson['type'] == 'questionnaire') {
                    $array[$key]['name'] = 'Questionário';
                }
            }
        }
        return $array;
    }
}