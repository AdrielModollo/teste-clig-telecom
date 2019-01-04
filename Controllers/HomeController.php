<?php

namespace Controllers;

use \Core\Controller;
use \Models\Student;
use \Models\Course;

class HomeController extends Controller 
{
    public function __construct()
    {
        $student = new Student();

        if (!$student->isLoggedIn()) {
            header('Location: '.BASE_URL.'login');
        }
    }

    public function index(): void
    {
        $data = [
            'info' => [],
            'courses' => []
        ];

        $student = new Student();
        $student->setStudent($_SESSION['student']);

        $course = new Course();
        $data['courses'] = $course->getCoursesByStudent($student->getId());

        $data['info'] = $student;
        $this->loadTemplate('home', $data);
    }
}