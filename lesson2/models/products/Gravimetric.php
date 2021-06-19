<?php

namespace app\models\products;

use app\traits\ProductTrait;

class Gravimetric extends Product
{
    use ProductTrait;

    const MAX_SIZE = 1000;

    public function calculationOfCost($quantity)
    {
        $percentage = $this->getTotalCostPercentage($quantity);
        static::$total = $percentage * $this->getPrice();
        parent::$totalCount += static::$total;
    }

    protected function getTotalCostPercentage($quantity, $amount = 10)
    {
        if ($quantity > 1000) {
            return $this->getTotalCostPercentage($quantity - static::MAX_SIZE, --$amount);
        }
        return 0.1 * $amount;
    }

    public function info()
    {
        echo "Стоимость весового товара - " . static::$total . "<br>";
    }
}