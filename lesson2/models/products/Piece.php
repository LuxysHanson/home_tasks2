<?php

namespace app\models\products;

use app\traits\ProductTrait;

class Piece extends Product
{

    use ProductTrait;

    public function calculationOfCost($quantity)
    {
        static::$total = $quantity * $this->getPrice();
        parent::$totalCount += static::$total;
    }

    public function info()
    {
        echo "Стоимость штучного товара - " . static::$total . "<br>";
    }
}