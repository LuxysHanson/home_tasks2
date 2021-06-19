<?php

namespace app\models;

class User extends Model
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


}