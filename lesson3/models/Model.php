<?php

namespace app\models;

use app\engine\Query;
use app\interfaces\IModel;

abstract class Model implements IModel
{

    abstract public function attributes();

    public static function call()
    {
        return (new Query(get_called_class()));
    }

    public function getOne($id)
    {
        return static::call()->onCondition([ 'id' => $id ])->one();
    }

    public function getAll()
    {
        return static::call()->all();
    }

    public function insert()
    {
        $data = $this->dataMatchingByFields();
        $lastId = static::call()->save($data);
        $this->id = $lastId;
    }

   /* public function update()
    {
        $data = $this->dataMatchingByFields();
        static::call()->update($data);
    }*/

    public function delete()
    {
        static::call()->delete($this->id);
    }

    private function dataMatchingByFields()
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