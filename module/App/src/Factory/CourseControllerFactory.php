<?php


namespace App\Factory;


use App\Controller\CourseController;
use App\Model\CourseTable;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Class CourseControllerFactory
 * @package App\Factory
 */
class CourseControllerFactory
{
    public function __invoke(ControllerManager $controllerManager)
    {
        $sl = $controllerManager->getServiceLocator();
        return new CourseController(new CourseTable($sl->get('CourseTableGateway')));
    }

}