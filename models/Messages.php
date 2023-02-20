<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property string $Message_ID
 * @property string $Ticket_ID
 * @property string $InReplyTo
 * @property string $DateTime
 * @property string $User_ID
 * @property string $ProtocolItem
 * @property string $Text
 * @property string $RealEffort
 *
 * @property Tickets $ticket
 * @property Messages $inReplyTo
 * @property Messages[] $messages
 * @property Users $user
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID', 'DateTime', 'User_ID', 'Text'], 'required', 'message' => 'Заполните это поле'],
            [['Ticket_ID', 'InReplyTo', 'User_ID'], 'integer'],
            [['DateTime'], 'safe'],
            [['Text', 'ProtocolItem'], 'string'],
            [['RealEffort'], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Message_ID' => 'Message  ID',
            'Ticket_ID' => 'Ticket  ID',
            'InReplyTo' => 'In Reply To',
            'DateTime' => 'Date Time',
            'User_ID' => 'User  ID',
            'Text' => 'Text',
            'ProtocolItem' => 'Protocol Item',
            'RealEffort' => 'Real Effort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['Ticket_ID' => 'Ticket_ID'])->andOnCondition(['TD' => null]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInReplyTo()
    {
        return $this->hasOne(Messages::className(), ['Message_ID' => 'InReplyTo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['InReplyTo' => 'Message_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(MessageFile::className(), ['Message_ID' => 'Message_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles1()
    {
        return $this->hasMany(MessageFile1::className(), ['Message_ID' => 'message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'User_ID']);
    }
}
