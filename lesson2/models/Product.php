<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $imageId;

    protected function getTableName()
    {
        return 'products';
    }


}

