<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "period".
 *
 * @property integer $Period_ID
 * @property integer $Ticket_ID
 * @property integer $Year
 * @property integer $Month
 * @property integer $Week
 * @property integer $Weekday
 * @property string $Day_Month
 * @property string $time
 * @property integer $Month_check
 */
class Period extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ticket_ID', 'Year', 'Month', 'Week', 'Weekday', 'Month_check'], 'integer'],
            [['Day_Month', 'time'], 'safe'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Period_ID' => 'Period  ID',
            'Ticket_ID' => 'Ticket  ID',
            'Year' => 'Year',
            'Month' => 'Month',
            'Week' => 'Week',
            'Weekday' => 'Weekday',
            'Day_Month' => 'Day  Month',
            'time' => 'Time',
            'Month_check' => 'Month Check',
        ];
    }

    /**
     * @inheritdoc
     * @return PeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeriodQuery(get_called_class());
    }
}
