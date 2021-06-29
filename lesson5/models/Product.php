<?php

namespace app\models;

class Product extends DBModel
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $image_id;

    public function __construct($name = '', $description = '', $price = 0)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getTableName()
    {
        return 'products';
    }

    public function attributes()
    {
        return [
            'name',
            'description',
            'price'
        ];
    }

}

