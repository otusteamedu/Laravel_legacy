<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property string $Type_ID
 * @property string $Name
 *
 * @property Tickets[] $tickets
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'types';
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
            'Type_ID' => 'Type  ID',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['Type_ID' => 'Type_ID']);
    }
}
