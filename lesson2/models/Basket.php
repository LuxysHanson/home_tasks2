<?php

namespace app\models;

class Basket extends Model
{
    public $id;
    public $productId;
    public $sessionId;
    public $totalCount;

    protected function getTableName()
    {
        return 'basket';
    }
}