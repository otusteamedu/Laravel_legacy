<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property string $Version_ID
 * @property string $Ticket_ID
 * @property string $Author
 * @property string $AssignedTo
 * @property string $Project_ID
 * @property string $Module_ID
 * @property string $Category_ID
 * @property string $Type_ID
 * @property string $Priority_ID
 * @property string $HighPriorityReason
 * @property string $Status_ID
 * @property string $Subject
 * @property string $FD
 * @property string $TD
 * @property string $CreationTime 
 * @property string $StartTime
 * @property string $EstTime
 * @property string $EstEffort
 * @property string $DependsOn
 *
 * @property Messages[] $messages
 * @property Projects $project
 * @property Modules $module
 * @property Categories $category
 * @property Types $type
 * @property Priorities $priority
 * @property Ticket $dependsOn
 * @property Ticket[] $tickets
 * @property Users $author
 * @property Users $assignedTo
 * @property Statuses $status
 * @property Usernotifications[] $usernotifications
 * @property TicketResolution $ticketResolution
 */
class Ticket extends \yii\db\ActiveRecord
{
    public static function statusReady() {
      return 10;
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AssignedTo', 'Module_ID', 'Category_ID', 'Type_ID', 'Priority_ID', 'Status_ID', 'Subject', 'FD', 'StartTime'], 'required', 'message' => 'Заполните это поле'],
            [['Author', 'Module_ID', 'Category_ID', 'Type_ID', 'Priority_ID', 'Status_ID', 'DependsOn', 'Progress'], 'integer', 'message' => 'Введите целое число'],
            [['Progress'], 'in', 'range' => range(0,100), 'message' => 'Должно быть от 0 до 100'],
            [['HighPriorityReason'], 'string'],
            [['Ticket_ID', 'FD', 'TD', 'CreationTime', 'StartTime', 'EstTime'], 'safe'],
            [['StartTime'], 'date', 'format' => 'php:Y-m-d H:i:s', 'message' => 'Неверный формат даты'],
            ['StartTime', 'compare', 'compareAttribute' => 'CreationTime', 'operator' => '>=', 'message' => 'Должна быть не раньше даты создания'],
            [['EstTime'], 'date', 'format' => 'php:Y-m-d H:i:s', 'message' => 'Неверный формат даты'],
            ['EstTime', 'compare', 'compareAttribute' => 'CreationTime', 'operator' => '>=', 'message' => 'Должна быть не раньше даты создания'],
            ['EstTime', 'compare', 'compareAttribute' => 'StartTime', 'operator' => '>=', 'message' => 'Должна быть не раньше даты начала'],
            [['Subject'], 'string', 'max' => 255, 'message' => 'Не более 255 символов'],
            [['EstEffort'], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Version_ID' => 'Version  ID',
            'Ticket_ID' => 'Ticket  ID',
            'Author' => 'Author',
            'AssignedTo' => 'Assigned To',
            'Module_ID' => 'Module  ID',
            'Category_ID' => 'Category  ID',
            'Type_ID' => 'Type  ID',
            'Priority_ID' => 'Priority  ID',
            'HighPriorityReason' => 'High Priority Reason',
            'Status_ID' => 'Status  ID',
            'Subject' => 'Subject',
            'FD' => 'Fd',
            'TD' => 'Td',
            'CreationTime' => 'Creation Time',            
            'StartTime' => 'Start Time',
            'EstTime' => 'Estimated End Time',
            'EstEffort' => 'Estimated Effort',
            'Progress' => 'Progress',
            'DependsOn' => 'Depends On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['Ticket_ID' => 'Ticket_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['Module_ID' => 'Module_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['Category_ID' => 'Category_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['Type_ID' => 'Type_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['Priority_ID' => 'Priority_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependsOn()
    {
        return $this->hasOne(Ticket::className(), ['Ticket_ID' => 'DependsOn'])->andOnCondition(['TD' => null]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['DependsOn' => 'Ticket_ID'])->andOnCondition(['TD' => null]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'Author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'AssignedTo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['Status_ID' => 'Status_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsernotifications()
    {
        return $this->hasMany(Usernotification::className(), ['Ticket_ID' => 'Ticket_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketResolution()
    {
        return $this->hasOne(TicketResolution::className(), ['Ticket_ID' => 'Ticket_ID'])->andOnCondition(['TD' => null]);;
    }
}
