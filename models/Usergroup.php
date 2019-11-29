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
class Usergroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['User_ID', 'Group_ID'], 'required'],
            [['User_ID', 'Group_ID'], 'integer'],
    
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'User_ID' => 'User  ID',
            'Group_ID' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
}
