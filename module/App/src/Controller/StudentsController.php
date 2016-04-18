<?php


namespace App\Controller;


use App\Model\CourseTable;
use App\Model\StudentTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StudentsController  extends AbstractActionController
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

    /**
     * @return ViewModel
     * @throws \Zend\Mvc\Exception\RuntimeException
     */
    public function listAction()
    {
        $this->layout()->setVariable('section', 'student');
        $id = $this->params()->fromRoute('id');
        $course = $this->courseTable->get($id);

        if (!$course) {
            die('invalid');
        }

        $students = $this->studentTable->getStudentsByCourse($id);

       return new ViewModel([
           'course' => $course,
           'items' => $students
       ]);
    }
}