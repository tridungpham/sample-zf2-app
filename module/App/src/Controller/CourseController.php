<?php


namespace App\Controller;

use App\Model\Course;
use App\Model\CourseTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class CourseController extends AbstractActionController
{
    /**
     * @var CourseTable
     */
    protected $courseTable;

    public function __construct(CourseTable $courseTable)
    {
        $this->courseTable = $courseTable;
    }

    public function indexAction()
    {
        $params = $this->params();
        
        $limit = $params->fromQuery('limit', CourseTable::DEFAULT_LIMIT);
        $page = $params->fromPost('page', 1);
        $offset = ($page - 1) * $limit;
        
        $items = $this->courseTable->getCourses([], $limit, $offset);
        
        return new ViewModel([
            'items' => $items
        ]);
    }

    public function createAction()
    {
        return new ViewModel();
    }
    
    public function saveAction()
    {
        $data = $this->params()->fromPost();
        $course = new Course($data);
        $this->courseTable->save($course);

        $this->redirect()->toRoute('course');
    }
}