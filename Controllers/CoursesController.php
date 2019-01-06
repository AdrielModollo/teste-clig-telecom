<?php

namespace Controllers;

use \Core\Controller;
use \Models\Student;
use \Models\Course;
use \Models\Module;
use \Models\Lesson;

class CoursesController extends Controller
{
    private $student;
    private $course;
    private $module;
    private $lesson;

    public function __construct()
    {
        $this->student = new Student();
        $this->course = new Course();
        $this->module = new Module();
        $this->lesson = new Lesson();

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

    public function lesson(int $lesson_id)
    {
        $data = [
            'info' => [],
            'course' => [],
            'modules' => [],
            'lesson_info' => []
        ];

        $this->student->setStudent($_SESSION['student']);
        $data['info'] = $this->student;
        $id = $this->lesson->getCourseByLesson($lesson_id);

        if ($this->student->isEnrolled($id)) {
            $this->course->setCourse($id);
            $data['course'] = $this->course;
            $data['modules'] = $this->module->getModules($id);
            $data['assisted_lessons'] = $this->student->getCountAssistedLessons($id);
            $data['lesson_info'] = $this->lesson->getLesson($lesson_id);
            $data['total_lessons'] = $this->course->getTotalLessons();
            $data['percentage'] = number_format($data['assisted_lessons'] / $data['total_lessons'] * 100, 2);

            if ($data['lesson_info']['type'] == 'video') {
                $view = 'course_lesson_video';
            } else {
                $view = 'course_lesson_questionnaire';
            }

            if (!empty($_POST['question'])) {
                $question = $_POST['question'];
                $this->lesson->setQuestion($question, $this->student->getId());
            }

            if (!empty($_POST['option'])) {
                $option = $_POST['option'];

                if ($option == $data['lesson_info']['answer']) {
                    $data['answer'] = true;
                } else {
                    $data['answer'] = false;
                }
            }

            if (!empty($_POST['mark_assisted'])) {
                $this->lesson->toggleWatched($data['lesson_info']['id']);
                header('Location: '.BASE_URL.'courses/lesson/'.$data['lesson_info']['id']);
            }

            $this->loadTemplate($view, $data);
        } else {
            header('Location: '.BASE_URL);
        }
    }
}