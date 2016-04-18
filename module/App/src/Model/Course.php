<?php


namespace App\Model;


class Course extends BaseEntity
{
    public function getName()
    {
        return $this->get('name');
    }
}