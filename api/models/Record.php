<?php

namespace api\models;

use common\models\Record as BaseRecord;
use Yii;
use yii\web\Linkable;
use yii\helpers\Url;

class Record extends BaseRecord implements Linkable
{

    public function fields(){
        return [
            'location',
            'timestamp' => 'created_at',
            'data',
        ];
    }

    public function getLinks(){
        return [
        ];
    }

}

