<?php


namespace App\Model;

/**
 * Class CourseTable
 * @package App\Model
 * @method Course get($id)
 */
class CourseTable extends BaseTable
{
    /**
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @return null|\Zend\Db\ResultSet\ResultSetInterface|Course[]
     * @throws \Zend\Db\Sql\Exception\InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getCourses(array $where = [], $limit = 10, $offset = 0)
    {
        return $this->getItems($where, ['id'], $limit, $offset);
    }
}