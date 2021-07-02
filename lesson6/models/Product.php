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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImageId()
    {
        return $this->image_id;
    }

    public function setImageId($image_id)
    {
        $this->image_id = $image_id;
    }

}

