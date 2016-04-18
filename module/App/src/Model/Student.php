<?php


namespace App\Model;

/**
 * Class Student
 * @package App\Model
 */
class Student extends BaseEntity
{
    public function getName()
    {
        return $this->get('name');
    }
}