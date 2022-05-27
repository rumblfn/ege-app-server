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
    protected $profileImg;
    protected $profileBannerImg;
    protected $verification_code;
    protected $verification_time;

    protected $props = [
        'status' => false,
        'email' => false,
        'karma' => false,
        'login' => false,
        'password' => false,
        'profileImg' => false,
        'profileBannerImg' => false,
        'verification_code' => false,
        'verification_time' => false
    ];


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->password = password_hash($pass, PASSWORD_DEFAULT);;
    }
}