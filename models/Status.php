<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property string $Status_ID
 * @property string $Name
 *
 * @property Tickets[] $tickets
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Status_ID' => 'Status  ID',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['Status_ID' => 'Status_ID']);
    }
}
