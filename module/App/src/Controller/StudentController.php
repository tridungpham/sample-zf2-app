<?php


namespace App\Controller;

use App\Model\CourseTable;
use App\Model\Student;
use App\Model\StudentTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class StudentController extends AbstractActionController
{
    /**
     * @var StudentTable
     */
    protected $studentTable;

    /**
     * @var CourseTable
     */
    protected $courseTable;

    public function __construct(StudentTable $studentTable, CourseTable $courseTable)
    {
        $this->studentTable = $studentTable;
        $this->courseTable = $courseTable;
    }

    public function createAction()
    {
        $courses = $this->courseTable->getCourses();
        $this->layout()->setVariable('section', 'student');
        return new ViewModel([
            'courses' => $courses
        ]);
    }

    public function saveAction()
    {
        $this->layout()->setVariable('section', 'student');
        $params = $this->params();
        $courseId = $params->fromPost('course');
        $course = $this->courseTable->get($courseId);

        if ($course->getId()) {
            $name = $params->fromPost('name');
            $id = $params->fromPost('id');

            $data = ['name' => $name, 'course_id' => $course->getId()];
            if ($id) {
                $data['id'] = $id;
            }

            $student = new Student($data);
            $this->studentTable->save($student);

            return $this->redirect()->toRoute('students', ['action' => 'list', 'id' => $course->getId()]);
        } else {
            // handling error
        }
    }
}