<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Period]].
 *
 * @see Period
 */
class PeriodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Period[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Period|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}