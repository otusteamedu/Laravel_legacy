<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $ID
 * @property integer $Type_Task
 * @property string $Date_Time
 * @property integer $Ticket_ID
 * @property integer $Status
 * @property string $Params
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Type_Task', 'Ticket_ID', 'Status'], 'integer'],
            [['Date_Time'], 'safe'],
            [['Params'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Type_Task' => 'Type  Task',
            'Date_Time' => 'Date  Time',
            'Ticket_ID' => 'Ticket  ID',
            'Status' => 'Status',
            'Params' => 'Params',
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }
}
