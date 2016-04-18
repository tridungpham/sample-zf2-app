<?php


namespace App\Model;

use Zend\Db\Sql\Exception\RuntimeException;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class BaseTable
 * @package App\Model
 */
class BaseTable
{
    const DEFAULT_LIMIT = 10;
    const DEFAULT_OFFSET = 0;

    protected $primaryKey = [];
    
    /**
     * @var TableGateway
     */
    protected $gateway;

    public function __construct(TableGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param $id
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function get($id)
    {
        $resultSet = $this->gateway->select(['id' => $id]);
        if ($resultSet->count() === 0) {
            throw new \Exception("Could not find row {$id}");
        }

        return $resultSet->current();
    }

    /**
     * @param array $where
     * @param array $order
     * @param int $limit
     * @param int $offset
     * @return null|\Zend\Db\ResultSet\ResultSetInterface
     * @throws \RuntimeException
     * @throws \Zend\Db\Sql\Exception\InvalidArgumentException
     */
    public function getItems(array $where = [], array $order = [], $limit = null, $offset = null)
    {
        $select = $this->gateway->getSql()->select();

        if (count($where) === 0) {
            $select->where($this->prepareGetItemsConditions($where));
        }

        $limit = $limit === null ? static::DEFAULT_LIMIT : $limit;
        $offset = $offset === null ? static::DEFAULT_OFFSET : $offset;
        
        $select->limit($limit)->offset($offset);
        $select->order('id');

        return $this->gateway->selectWith($select);
    }

    public function save(BaseEntity $entity)
    {
        $data = $entity->getData();
        $primaryKeys = $this->primaryKey;
        $isUpdateAction = $entity->getId() ? true : false;

        $data = array_filter($data, function($value, $key) use ($primaryKeys, $isUpdateAction) {
            if ($isUpdateAction && in_array($key, $primaryKeys, true)) {
                return false;
            }

            if (!$value) {
                return false;
            }

            return true;
        }, ARRAY_FILTER_USE_BOTH);

        try {
            if ($isUpdateAction) {
                // dont allow to update primary key
                $this->gateway->update($data, ['id' => $entity->getId()]);
            } else {
                $this->gateway->insert($data);
            }
        } catch (RuntimeException $e) {
            return false;
        }

        return $isUpdateAction ? $entity->getId() : $this->gateway->getLastInsertValue();
    }

    /**
     * @param array $where
     * @return array
     */
    protected function prepareGetItemsConditions(array $where = [])
    {
        return $where;
    }
}