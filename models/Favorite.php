<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userfavorite".
 *
 * @property string $User_ID
 * @property string $Ticket_ID
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['User_ID', 'Ticket_ID'], 'required'],
            [['User_ID', 'Ticket_ID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'User_ID' => '',
            'Ticket_ID' => '',
        ];
    }
}
