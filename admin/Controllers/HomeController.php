<?php

namespace Controllers;

use \Core\Controller;
use \Models\User;
use \Models\Course;

class HomeController extends Controller 
{
    private $user;
    private $course;

    public function __construct()
    {
        $this->user = new User();
        $this->course = new Course();

        if (!$this->user->isLoggedIn()) {
            header('Location: '.BASE_URL.'/login');
        }
    }

    public function index() 
    {
        $data = [
            'courses' => []
        ];

        if (!empty($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            $image_url = $_POST['image_url'];
            $this->delete($course_id, $image_url);
            header('Location: '.BASE_URL);
        }

        $data['courses'] = $this->course->getCourses();
        $this->loadTemplate('home', $data);
    }

    public function delete(int $course_id, string $image_url): void
    {
        $this->course->delete($course_id, $image_url);
        header('Location: '.BASE_URL);
    }

    public function add()
    {
        if (!empty($_POST['name']) && !empty($_POST['description'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $_FILES['image'];

            if (!empty($image['tmp_name'])) {
                $image_name = md5(time().rand(0, 9999)).'.jpg';
                $types = ['image/jpeg', 'image/jpg', 'image/png'];

                if (in_array($image['type'], $types)) {
                    $abs_path = $abs_path = $_SERVER['DOCUMENT_ROOT'];
                    $file = $abs_path.'/e-learning/assets/images/courses/'.$image_name;
                    move_uploaded_file($image['tmp_name'], $file);
                    $this->course->add($name, $description, $image_name);
                    header('Location: '.BASE_URL);
                }
            }
        }

        $this->loadTemplate('course_add', []);
    }
}