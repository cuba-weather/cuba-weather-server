<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Record]].
 *
 * @see Record
 */
class RecordQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Record[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Record|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
