<?php

namespace app\models;

class Gallery extends Model
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
        // TODO: Implement attributes() method.
    }
}