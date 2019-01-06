<?php

namespace Models;

use \Core\Model;

class Course extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCourses(): array
    {
        $array = [];

        $sql = 'SELECT 
                    id,
                    name,
                    image,
                        (select 
                        count(*)
                        from courses_has_students
                        where course_id = id) AS number_of_students
                FROM courses';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function delete(int $course_id, string $image_url): void
    {   
        // ON DELETE CASCADE

        $sql = 'SELECT id FROM lessons WHERE course_id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $lessons = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach($lessons as $lesson) {
                $query = 'DELETE FROM historic WHERE lesson_id = ?';
                $query = $this->database->prepare($query);
                $query->execute([$lesson['id']]);

                $query = 'DELETE FROM questionnaires WHERE lesson_id = ?';
                $query = $this->database->prepare($query);
                $query->execute([$lesson['id']]);

                $query = 'DELETE FROM videos WHERE lesson_id = ?';
                $query = $this->database->prepare($query);
                $query->execute([$lesson['id']]);
            }
        }

        $sql = 'DELETE FROM courses_has_students WHERE course_id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        $sql = 'DELETE FROM lessons WHERE course_id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        $sql = 'DELETE FROM modules WHERE course_id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        $sql = 'DELETE FROM courses WHERE id = :course_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':course_id', $course_id);
        $sql->execute();

        $abs_path = $_SERVER['DOCUMENT_ROOT'];
        $image_url = '/e-learning/assets/images/courses/'.$image_url;
        $file = $abs_path.$image_url;
        
        if(file_exists($abs_path.$image_url)) {
            unlink($file);
        }
    }

    public function add(string $name, string $description, string $image_name): void
    {
        $sql = 'INSERT INTO courses
                    (name, description, image)
                VALUES
                    (:name, :description, :image)';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':description', $description);
        $sql->bindValue(':image', $image_name);
        $sql->execute();
    }

    public function getCourse(int $course_id): array
    {
        $array = [];

        $sql = 'SELECT name, image, description
                FROM courses
                WHERE id = :id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':id', $course_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function update(string $name, 
                         string $description, 
                         string $image_name,
                         int $course_id): void
    {
        $params = func_get_args();
        $sql = 'UPDATE courses
                SET name = ?, description = ?, image = ?
                WHERE id = ?';
        $sql = $this->database->prepare($sql);
        $sql->execute($params);
    }

    public function getNameAndIdFromCourses(): array
    {
        $array = [];

        $sql = 'SELECT id, name FROM courses';
        $sql = $this->database->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getCoursesByStudent(int $student_id): array
    {
        $array = [];

        $sql = 'SELECT course_id
                FROM courses_has_students
                WHERE student_id = :student_id';
        $sql = $this->database->prepare($sql);
        $sql->bindValue(':student_id', $student_id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $rows = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach($rows as $row) {
                array_push($array, $row['course_id']);
            }
        }

        return $array;
    }

    public function deleteCoursesHasStudentsByStudentId(int $student_id): void
    {
        $params = func_get_args();

        $sql = 'DELETE FROM courses_has_students
                WHERE student_id = ?';
        $sql = $this->database->prepare($sql);
        $sql->execute($params);
    }

    public function addCoursesHasStudents(int $student_id, array $courses_id): void
    {
        foreach($courses_id as $course_id) {
            $sql = 'INSERT INTO courses_has_students
                        (student_id, course_id)
                    VALUES
                        (:student_id, :course_id)';
            $sql = $this->database->prepare($sql);
            $sql->bindValue(':student_id', $student_id);
            $sql->bindValue(':course_id', $course_id);
            $sql->execute();
        }
    }
}