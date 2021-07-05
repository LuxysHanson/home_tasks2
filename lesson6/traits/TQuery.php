<?php

namespace app\traits;

trait TQuery
{
    protected $sort = null;
    protected $limit = null;
    protected $where = [];

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

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

}