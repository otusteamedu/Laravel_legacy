<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property string $Department_ID
 * @property string $IsSubdivisionOf
 * @property string $Company_ID
 * @property string $Name
 *
 * @property Companies $company
 * @property Departments $isSubdivisionOf
 * @property Departments[] $departments
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsSubdivisionOf', 'Company_ID'], 'integer'],
            [['Company_ID', 'Name'], 'required'],
            [['Name'], 'string', 'max' => 255],
           // [['company.Name'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Department_ID' => 'ID',
            'IsSubdivisionOf' => 'Головной Отдел',
            'Company_ID' => 'Id Компании',
            'Name' => 'Название Отдела',
           // 'company.Name'=> 'Company Name'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['Company_ID' => 'Company_ID']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsSubdivisionOf()
    {
        return $this->hasOne(Departments::className(), ['Department_ID' => 'IsSubdivisionOf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['IsSubdivisionOf' => 'Department_ID']);
    }
    
    
    
}
