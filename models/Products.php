<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property string $Product_ID
 * @property string $Name
 * @property integer $Project_ID
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Project_ID'], 'required'],
            [['Project_ID'], 'integer'],
            [['Active'], 'integer'],
            [['Name'], 'string', 'max' => 255],
            [['project'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Product_ID' => 'Код продукта',
            'Name' => 'Продукт',
            'Project_ID' => 'Код проекта',
            'project.Name' => 'Проект',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['Project_ID' => 'Project_ID']);
    }
    
     public function __toString() {
        return $this->Name;
    }
}
