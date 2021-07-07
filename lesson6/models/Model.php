<?php

namespace app\models;

use app\engine\Query;
use app\interfaces\IModel;

abstract class Model implements IModel
{

    private $_newAttributes = [];

    abstract public function attributes();

    public function __set($name, $value)
    {
        $this->_newAttributes[$name] = $value;
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getNewAttributes()
    {
        return $this->_newAttributes;
    }

    public function setNewAttributes($newAttributes)
    {
        $this->_newAttributes = $newAttributes;
    }

    public function isNewRecord()
    {
        return !$this->id;
    }

    public static function call()
    {
        return (new Query(get_called_class()));
    }

    public static function getOne($id)
    {
        return static::call()->onCondition([ 'id' => $id ])->one();
    }

    public static function getOneByQuery(array $condition)
    {
        return static::call()->onCondition($condition)->one();
    }

    public static function getAll()
    {
        return static::call()->all();
    }

    public static function getLimit($limit = 5)
    {
        return static::call()->limit($limit)->all();
    }

    public static function updateByCondition(array $condition)
    {
        return static::call()->update($condition);
    }

    protected function dataMatchingByFields()
    {
        $data = [];
        foreach ($this->attributes() as $attribute) {
            if (isset($this->$attribute)) {
                $data[$attribute] = $this->$attribute;
            }
        }
        return $data;
    }
}