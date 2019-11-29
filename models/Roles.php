<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property string $Role_ID
 * @property string $Name
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            ['Name', 'unique',  'message' => 'Такая роль уже существует. Измените название роли'],
            [['Name', 'Description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Role_ID' => 'Код',
            'Name' => 'Название роли',
            'Description' => 'Описание',
        ];
    }
}
