<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "priorities".
 *
 * @property string $Priority_ID
 * @property string $Name
 *
 * @property Tickets[] $tickets
 */
class Priority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priorities';
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
            'Priority_ID' => 'Priority  ID',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['Priority_ID' => 'Priority_ID']);
    }
}
