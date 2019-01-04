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

    public function getCourseByLesson(int $lesson_id): int
    {
        $sql = 'SELECT course_id
                FROM lessons
                WHERE id = :lesson_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':lesson_id', $lesson_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(\PDO::FETCH_ASSOC)['course_id'];
        }

        return 0;
    }

    public function getLesson($lesson_id): array
    {
        $array = [];

        $sql = 'SELECT type,
                    (select 
                        count(*) 
                    from historic
                    where historic.lesson_id = lessons.id 
                    AND historic.student_id = :student_id) 
                    AS watched
                FROM lessons
                WHERE id = :lesson_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':student_id', $_SESSION['student']);
        $sql->bindValue(':lesson_id', $lesson_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(\PDO::FETCH_ASSOC);

            if ($row['type'] == 'video') {
                $sql = 'SELECT id, lesson_id, name, description, url
                        FROM videos
                        WHERE lesson_id = :lesson_id';
                $sql = $this->database->prepare($sql);
                $sql->bindValue(':lesson_id', $lesson_id);
                $sql->execute();
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
                $array['type'] = 'video';
            } else if ($row['type'] == 'questionnaire') {
                $sql = 'SELECT id, lesson_id, question, option1, option2, option3, option4, answer
                        FROM questionnaires
                        WHERE lesson_id = :lesson_id';
                $sql = $this->database->prepare($sql);
                $sql->bindValue(':lesson_id', $lesson_id);
                $sql->execute();
                $array = $sql->fetch(\PDO::FETCH_ASSOC);
                $array['type'] = 'questionnaire';
            }
            $array['watched'] = $row['watched'];
        }

        return $array;
    }

    public function setQuestion(string $question, int $student_id): void
    {
        $sql = 'INSERT INTO questions
                (question_date, question, student_id)
                VALUES(NOW(), :question, :student_id)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':question', $question);
        $sql->bindValue(':student_id', $student_id);
        $sql->execute();
    }

    public function toggleWatched(int $lesson_id): void
    {
        $sql = 'SELECT id
                FROM historic
                WHERE student_id = :student_id
                AND lesson_id = :lesson_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':student_id', $_SESSION['student']);
        $sql->bindValue(':lesson_id', $lesson_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = 'DELETE
                    FROM historic
                    WHERE student_id = :student_id
                    AND lesson_id = :lesson_id';
            $sql = $this->database->prepare($sql);
            $sql->bindValue(':student_id', $_SESSION['student']);
            $sql->bindValue(':lesson_id', $lesson_id);
            $sql->execute();
        } else {
            $sql = 'INSERT INTO historic
                    (date_view, student_id, lesson_id)
                    VALUES (NOW(), :student_id, :lesson_id)';
            $sql = $this->database->prepare($sql);
            $sql->bindValue(':student_id', $_SESSION['student']);
            $sql->bindValue(':lesson_id', $lesson_id);
            $sql->execute();
        }
    }
}