<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticketsestimatesend".
 *
 * @property integer $id
 * @property integer $Ticket_ID
 * @property string $esttime
 * @property string $last_send
 */
class Ticketsestimatesend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticketsestimatesend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID'], 'integer'],
            [['esttime', 'last_send'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Ticket_ID' => 'Ticket  ID',
            'esttime' => 'Esttime',
            'last_send' => 'Last Send',
        ];
    }
}
