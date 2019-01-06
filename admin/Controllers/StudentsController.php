<?php

namespace Controllers;

use \Core\Controller;
use \Models\User;
use \Models\Student;
use \Models\Course;

class StudentsController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
        $this->student = new Student();
        $this->course = new Course();

        if (!$this->user->isLoggedIn()) {
            header('Location: '.BASE_URL.'login');
        }
    }

    public function index()
    {
        $data = [];
        $data['students'] = $this->student->getAll();

        if (!empty($_POST['student_id'])) {
            $student_id = $_POST['student_id'];
            $this->student->delete($student_id);
            header('Location: '.BASE_URL.'students');
        }

        $this->loadTemplate('students', $data);
    }

    public function add(): void
    {
        if (!empty($_POST['name']) && !empty($_POST['email']) & !empty($_POST['password'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(!$this->student->studentAlreadyExists($email)) {
                $this->student->add($name, $email, $password);
            }
            header('Location: '.BASE_URL.'students');
        }
        $this->loadTemplate('student_add', []);
    }

    public function edit($student_id): void
    {
        $data = [];
        $data['student'] = $this->student->getStudentById($student_id);
        $data['courses'] = $this->course->getNameAndIdFromCourses();
        $data['courses_by_student'] = $this->course->getCoursesByStudent($student_id);

        if (!count($data['student']) > 0) {
            header('Location: '.BASE_URL);
        }

        if (!empty($_POST['name']) && !empty($_POST['email'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $courses = [];

            if (!empty($_POST['courses'])) {
                $courses = $_POST['courses'];
            }

            $this->student->update($name, $email, $student_id);
            $this->course->deleteCoursesHasStudentsByStudentId($student_id);
            $this->course->addCoursesHasStudents($student_id, $courses);
            header('Location: '.BASE_URL.'students/edit/'.$student_id);
        }

        $this->loadTemplate('student_edit', $data);
    }
}