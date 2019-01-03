<?php

namespace Controllers;

use \Core\Controller;
use \Models\Student;
use \Models\Course;

class CoursesController extends Controller
{
	private $student;
	private $course;

	public function __construct()
	{
		$this->student = new Student();
		$this->course = new Course();

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
			'lessons' => []
		];

		$this->student->setStudent($_SESSION['student']);
		$data['info'] = $this->student;

		if ($this->student->isEnrolled($id)) {
			$this->course->setCourse($id);
			$data['course'] = $this->course;
			$this->loadTemplate('course_learning', $data);
		} else {
			header('Location: '.BASE_URL);
		}
	}
}