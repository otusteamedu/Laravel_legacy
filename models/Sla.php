<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sla".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $product_id
 * @property integer $module_id
 * @property integer $priority_id
 * @property integer $status_id
 * @property double $sla
 * @property double $interval
 * @property string $last_send
 * @property string $message
 * @property integer $active
 * @property integer $type
 */
class Sla extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sla';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'product_id', 'module_id', 'priority_id', 'status_id', 'active', 'type_id', 'message', 'sla', 'interval', 'last_send'], 'required'],
            [['project_id', 'product_id', 'module_id', 'priority_id', 'status_id', 'active', 'type_id'], 'integer'],
            [['sla', 'interval'], 'number'],
            [['last_send'], 'safe'],
            [['message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Проект',
            'product_id' => 'Продукт/Набор услуг',
            'module_id' => 'Подсистема/Услуга',
            'priority_id' => 'Критичность',
            'status_id' => 'Статус',
            'sla' => 'SLA(Минуты)',
            'interval' => 'Интервал(Минуты)',
            'last_send' => 'Last Send',
            'message' => 'Сообщение',
            'active' => 'Активен/Неактивен',
            'type' => 'Тип',
            'status.Name'=>'Статус',
            'type.Name' => 'Тип',
            'project.Name'=> 'Проект',
            'product.Name'=>'Продукт/Набор услуг',
            'priority.Name'=>'Критичность',
            'module.Name'=>'Подсистема/Услуга'
            
        ];
    }
    
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['Project_ID' => 'project_id']);
    }
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['Product_ID' => 'product_id']);
    }
    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['Module_ID' => 'module_id']);
    }
    public function getType()
    {
        return $this->hasOne(Type::className(), ['Type_ID' => 'type_id']);
    }
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['Priority_ID' => 'priority_id']);
    }
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['Status_ID' => 'status_id']);
    }
    
}
