<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_roles".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class UsersRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'role_id' => 'Role ID',
        ];
    }
}
