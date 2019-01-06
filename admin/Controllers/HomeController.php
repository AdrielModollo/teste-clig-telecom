<?php

namespace Controllers;

use \Core\Controller;
use \Models\User;
use \Models\Course;
use \Models\Module;
use \Models\Lesson;

class HomeController extends Controller 
{
    private $user;
    private $course;
    private $module;
    private $lesson;

    public function __construct()
    {
        $this->user = new User();
        $this->course = new Course();
        $this->module = new Module();
        $this->lesson = new Lesson();

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

    public function add(): void
    {   $this->record('add');
        $this->loadTemplate('course_add', []);
    }

    public function edit(int $course_id): void
    {
        $data = [
            'course' => [],
            'modules' => []
        ];

        $data['course'] = $this->course->getCourse($course_id);
        $data['modules'] = $this->module->getModules($course_id);

        if (count($data['course']) === 0) {
            header('Location: '.BASE_URL);
        }

        if (!empty($_POST['module_name'])) {
            $this->module->add($_POST['module_name'], $course_id);
            header('Location: '.BASE_URL.'home/edit/'.$course_id);
        }

        if (!empty($_POST['module_id'])) {
            $this->module->delete($_POST['module_id']);
            header('Location: '.BASE_URL.'home/edit/'.$course_id);
        }

        if (!empty($_POST['lesson_id'])) {
            $this->lesson->delete($_POST['lesson_id']);
            header('Location: '.BASE_URL.'home/edit/'.$course_id);
        }

        if (!empty($_POST['add_lesson_name'])) {
            $name = $_POST['add_lesson_name'];
            $module = $_POST['add_lesson_module'];
            $type = $_POST['add_lesson_type'];

            $this->lesson->add($course_id, $name, $module, $type);
            header('Location: '.BASE_URL.'home/edit/'.$course_id);
        }
        
        $this->record('update', $course_id); 
        $this->loadTemplate('course_edit', $data);
    }

    private function record(string $type, int $course_id = 0): void
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
                    
                    switch($type) {
                        case 'add':
                            $this->course->add($name, $description, $image_name);
                            break;
                        case 'update':
                            $this->course->update($name, $description, $image_name, $course_id);
                    }

                    header('Location: '.BASE_URL);
                }
            }
        }
    }

    public function edit_module(int $module_id): void
    {
        $data = [
            'module' => $this->module->getModule($module_id)
        ];

        if (count($data['module']) === 0) {
            header('Location: '.BASE_URL);
        }

        if (!empty($_POST['module_name'])) {
            $this->module->update($_POST['module_name'], $module_id);
            header('Location: '.BASE_URL.'home/edit_module/'.$module_id);
        }

        $this->loadTemplate('module_edit', $data);
    }

    public function edit_lesson(int $lesson_id): void
    {
        $data = [];  

        $data['lesson'] = $this->lesson->getLesson($lesson_id);

        if (!count($data['lesson']) > 0) {
            header('Location: '.BASE_URL);
        }

        if ($data['lesson']['type'] === 'video') {
            $view = 'edit_lesson_video';
        } else {
            $view = 'edit_lesson_questionnaire';
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $url = $_POST['url'];
            $this->lesson->updateVideoLesson($name, $description, $url, $lesson_id);
            header('Location: '.BASE_URL.'home/edit_lesson/'.$lesson_id);
        } 

        if (!empty($_POST['question'])) {
            $fields = ['option1', 'option2', 'option3', 'option4', 'answer'];
            $valid = true;

            foreach($fields as $field) {
                if(empty($_POST[$field])) {
                    $valid = false;
                }
            }

            if($valid) {
                $question = $_POST['question'];
                $option1 = $_POST['option1'];
                $option2 = $_POST['option2'];
                $option3 = $_POST['option3'];
                $option4 = $_POST['option4'];
                $answer = $_POST['answer'];
                $this->lesson->updateQuestionnaireLesson($question,
                                                         $option1,
                                                         $option2,
                                                         $option3,
                                                         $option4,
                                                         $answer,
                                                         $lesson_id);
            }
            header('Location: '.BASE_URL.'home/edit_lesson/'.$lesson_id);
        }

        $this->loadTemplate($view, $data); 
    }
}