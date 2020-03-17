<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use daxslab\behaviors\UploaderBehavior;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\Inflector;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            BlameableBehavior::class => [
                'class' => BlameableBehavior::class,
            ],
            TimestampBehavior::class => [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
