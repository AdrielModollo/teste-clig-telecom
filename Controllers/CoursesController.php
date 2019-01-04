<?php

namespace Controllers;

use \Core\Controller;
use \Models\Student;
use \Models\Course;
use \Models\Module;

class CoursesController extends Controller
{
    private $student;
    private $course;
    private $modules;

    public function __construct()
    {
        $this->student = new Student();
        $this->course = new Course();
        $this->module = new Module();

        if (!$this->student->isLoggedIn()) {
            header('Location: '.BASE_URL.'login');
        }
    }

    public function index()
    {
        header('Location: '.BASE_URL);
    }

    public function learning(int $id)
    {
        $data = [
            'info' => [],
            'course' => [],
            'modules' => []
        ];

        $this->student->setStudent($_SESSION['student']);
        $data['info'] = $this->student;

        if ($this->student->isEnrolled($id)) {
            $this->course->setCourse($id);
            $data['course'] = $this->course;
            $data['modules'] = $this->module->getModules($id);
            $this->loadTemplate('course_learning', $data);
        } else {
            header('Location: '.BASE_URL);
        }
    }
}