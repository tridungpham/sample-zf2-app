<?php


namespace App\Factory;


use App\Controller\StudentsController;
use App\Model\CourseTable;
use App\Model\StudentTable;
use Zend\Mvc\Controller\ControllerManager;

class StudentsControllerFactory
{
    public function __invoke(ControllerManager $controllerManager)
    {
        $sl = $controllerManager->getServiceLocator();
        return new StudentsController(
            new StudentTable($sl->get('StudentTableGateway')),
            new CourseTable($sl->get('CourseTableGateway'))
        );
    }
}