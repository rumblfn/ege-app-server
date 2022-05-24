<?php

namespace app\models\repositories;

use app\models\entities\User;
use app\models\Repository;

class UserRepository extends Repository
{
    public function Auth($login, $pass): bool
    {
        $user = $this->getWhere('login', $login);
        if (!$user) {
            return false;
        }
        if (password_verify($pass, $user->password)) {
            return true;
        }
        return false;
    }

    public function getTableName(): string
    {
        return 'users';
    }

    protected function getEntityClass(): string
    {
        return User::class;
    }
}