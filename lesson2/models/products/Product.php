<?php

namespace app\models\products;

abstract class Product
{

    protected $name;
    protected $price;

    protected static $totalCount = 0;

    abstract public function info();
    abstract public function calculationOfCost($quantity);

    public function getInfo()
    {
        echo "Общая стоимость - " . self::$totalCount . "<br>";
    }

}