<?php


namespace App\Model;

use Zend\Db\Exception\RuntimeException;

/**
 * Class StudentTable
 * @package App\Model
 */
class StudentTable extends BaseTable
{
    const DEFAULT_LIMIT = 20;

    /**
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @return null|\Zend\Db\ResultSet\ResultSetInterface|Student[]
     * @throws \Zend\Db\Sql\Exception\InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getStudents(array $where = [], $limit = self::DEFAULT_LIMIT, $offset = 0)
    {
        return $this->getItems($where, ['id'], $limit, $offset);
    }

    protected function prepareGetItemsConditions(array $where = [])
    {
        $preparedConditions = [];

        if (isset($where['course'])) {
            $preparedConditions['course_id = ?'] = $where['course'];
        }

        return $preparedConditions;
    }


    /**
     * @param $id
     * @return Student[]|null|\Zend\Db\ResultSet\ResultSetInterface
     * @throws \RuntimeException
     * @throws \Zend\Db\Sql\Exception\InvalidArgumentException
     */
    public function getStudentsByCourse($id)
    {
        return $this->getStudents(['course' => $id]);
    }

}