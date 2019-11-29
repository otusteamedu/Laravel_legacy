<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property string $Category_ID
 * @property string $Name
 *
 * @property Tickets[] $tickets
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Category_ID' => 'Category  ID',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['Category_ID' => 'Category_ID']);
    }
}
