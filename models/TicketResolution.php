<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TicketResolutions".
 *
 * @property string $Resolution_ID
 * @property string $Ticket_ID
 * @property string $FD
 * @property string $TD
 * @property string $Author
 * @property string $Problem
 * @property string $Actions
 * @property string $Result
 */
class TicketResolution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TicketResolutions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID', 'FD'], 'required', 'message' => 'Заполните это поле'],
            [['Problem', 'Actions', 'Result'], 'required', 'whenClient' => "function (attribute, value) {
                return $('#ticket-status_id').val() == 10;
            }", 'message' => 'Заполните это поле'],
            [['Ticket_ID'], 'integer'],
            [['FD', 'TD'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Resolution_ID' => 'Resolution  ID',
            'Ticket_ID' => 'Ticket  ID',
            'FD' => 'Fd',
            'TD' => 'Td',
            'Author' => 'Author',
            'Problem' => 'Problem',
            'Actions' => 'Actions',
            'Result' => 'Result',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['Ticket_ID' => 'Ticket_ID', 'TD' => null]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'Author']);
    }
}
