<?php

namespace app\traits;

trait TQuery
{
    public $sort = null;
    public $where = [];

    public function orderBy($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    public function onCondition($condition = [])
    {
        $this->where = $condition;
        return $this;
    }

}