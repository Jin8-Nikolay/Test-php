<?php

namespace frontend\repositories;

use common\models\User;

/**
 * @UserRepository class
 * @package frontend\repositories
 */
class UserRepository
{
    public static function getAll(): array
    {
        return User::find()->where(['role' => User::ROLE_MANAGER])->all();
    }

    public static function getById(int $id)
    {
        return User::find()->where(['id' => $id])->one();
    }
}