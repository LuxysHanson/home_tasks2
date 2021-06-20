<?php

namespace app\traits;

trait TProduct
{

    protected static $total = 0;

    public function __construct($price = 0)
    {
        $this->setPrice($price);
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

}