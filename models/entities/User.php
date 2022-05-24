<?php

namespace app\models\entities;


use app\models\Model;

class User extends Model
{
    protected $id;
    protected $login;
    protected $password;
    protected $status;
    protected $email;
    protected $karma;

    protected $props = [
        'status' => false,
        'email' => false,
        'karma' => false,
        'login' => false,
        'password' => false,
    ];


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->password = password_hash($pass, PASSWORD_DEFAULT);;
    }
}