<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tasks]].
 *
 * @see Tasks
 */
class TasksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Tasks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tasks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}