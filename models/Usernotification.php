<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usernotifications".
 *
 * @property string $ID
 * @property string $Ticket_ID
 * @property string $User_ID
 *
 * @property Tickets $ticket
 */
class Usernotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usernotifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID', 'User_ID'], 'required'],
            [['Ticket_ID', 'User_ID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Ticket_ID' => 'Ticket  ID',
            'User_ID' => 'User  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::className(), ['Ticket_ID' => 'Ticket_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'User_ID']);
    }
}
