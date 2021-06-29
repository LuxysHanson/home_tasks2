<?php

namespace app\models;

class Gallery extends DBModel
{
    public $id;
    public $name;
    public $views;

    public function getTableName()
    {
        return 'galleries';
    }

    public function attributes()
    {
        return [];
    }
}