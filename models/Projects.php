<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property string $Project_ID
 * @property string $Name
 * @property string $Description
 *
 * @property Tickets[] $tickets
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Description'], 'required'],
            [['Description'], 'string'],
            [['Active'], 'integer'],
            [['Name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Project_ID' => 'Код проекта',
            'Name' => 'Проект',
            'Description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['Project_ID' => 'Project_ID']);
    }
    
     public function __toString() {
        return $this->Name;
    }
}
