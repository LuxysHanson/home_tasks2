<?php

namespace app\models;

abstract class DBModel extends Model
{

    public function insert()
    {
        $data = $this->dataMatchingByFields();
        if ($lastId = static::call()->insert($data)) {
            $this->id = $lastId;
        }
        return $this;
    }

    public function update()
    {
        static::call()->update($this->id, $this->getNewAttributes());
        return $this;
    }

    public function save()
    {
        if ($this->isNewRecord()) {
            return $this->insert();
        }
        return $this->update();
    }

    public function delete()
    {
        static::call()->delete($this->id);
    }

}