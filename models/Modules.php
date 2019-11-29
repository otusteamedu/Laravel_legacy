<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modules".
 *
 * @property string $Module_ID
 * @property string $Name
 * @property string $Product_ID
 *
 * @property Tickets[] $tickets
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $Project_ID;
    
    public static function tableName()
    {
        return 'modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Product_ID'], 'required'],
            [['Product_ID'], 'integer'],
            [['Active'], 'integer'],
            [['Name'], 'string', 'max' => 255],
            [['product', 'Project_ID'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Module_ID' => 'Module  ID',
            'Name' => 'Название Подсистемы',
            'Product_ID' => 'Product  ID',
            'product.Name' => 'Product'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['Module_ID' => 'Module_ID']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['Product_ID' => 'Product_ID']);
    }
     
     public function __toString() {
        echo $Name;
    }
    
     
     public function getProject()
    {
        return $this->hasOne(Projects::className(), ['Project_ID' => $this->getProduct()]);
    }
    
}
