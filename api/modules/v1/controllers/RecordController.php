<?php

namespace api\modules\v1\controllers;

use api\models\Record;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class RecordController extends ActiveController
{
    public $modelClass = 'api\models\Record';
}
