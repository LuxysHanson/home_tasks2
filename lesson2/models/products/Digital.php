<?php

namespace app\models\products;

use app\traits\ProductTrait;

class Digital extends Product
{

   use ProductTrait;

    public function calculationOfCost($quantity)
    {
        static::$total = $quantity * ($this->getPrice()/2);
        parent::$totalCount += static::$total;
    }

    public function info()
    {
        echo "Стоимость цифрового товара - " . static::$total . "<br>";
    }
}