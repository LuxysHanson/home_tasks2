<?php

namespace app\models;

class User extends DBModel
{
    public $id;
    public $login;
    public $passwordHash;
    public $role;
    public $verifyKey;

    public function getTableName()
    {
        return 'users';
    }

    public function attributes()
    {
        return [];
    }

}