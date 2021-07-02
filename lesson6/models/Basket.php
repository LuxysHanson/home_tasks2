<?php

namespace app\models;

class Basket extends DBModel
{
    public $id;
    public $productId;
    public $sessionId;
    public $totalCount;

    public function getTableName()
    {
        return 'basket';
    }

    public function attributes()
    {
        return [];
    }
}