<?php


namespace App\Model;


class BaseEntity
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * BaseEntity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data) !== 0) {
            $this->exchangeArray($data);
        }
    }
    
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * Populate data into model
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}