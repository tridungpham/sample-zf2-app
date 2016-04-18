<?php


namespace App\Factory;


use App\Controller\StudentController;
use App\Model\CourseTable;
use App\Model\StudentTable;
use Zend\Mvc\Controller\ControllerManager;

class StudentControllerFactory
{
    public function __invoke(ControllerManager $controllerManager)
    {
        $sl = $controllerManager->getServiceLocator();
        return new StudentController(
            new StudentTable($sl->get('StudentTableGateway')),
            new CourseTable($sl->get('CourseTableGateway'))
        );
    }
}