<?php

namespace common\models;

use Yii;

/**
 * User model
 */
class User extends \Da\User\Model\User
{
    public function getName()
    {
        return isset($this->profile->name)
            ? $this->profile->name
            : $this->username;
    }
}
