<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property integer $department_id
 * @property string $position
 * @property integer $role_id
 * @property string $additionalData
 * @property string $FD
 * @property string $TD
 * @property integer $status
 * @property string $imageFile
 * @property string $responsible
 * @property string $email_responsible
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
    
   
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          
            [[ 'realname', 'username', 'email', 'phone', 'department_id', 'position', 'FD', 'TD', 'status', 'surname'], 'safe'],
            [['user_id', 'department_id', 'role_id', 'status'], 'integer'],
            [['FD', 'TD', 'password', 'user_id','second_name', 'name' ], 'safe'],
            ['email_responsible', 'email'],
            ['username', 'unique',  'message' => 'Пользователь с таким логином уже существует. Измените логин пользователя'],
            [['name', 'password', 'email', 'phone', 'position', 'additionalData', 'imageFile', 'responsible', 'email_responsible' ], 'string', 'max' => 255]
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
            'name' => 'ФИО',
            'username' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'phone' => 'Телефон',
            'department_id' => 'Department ID',
            'position' => 'Должность',
            'role_id' => 'Role ID',
            'additionalData' => 'Additional Data',
            'FD' => 'Fd',
            'TD' => 'Td',
            'status' => 'Статус',
            'imageFile' => 'Image File',
            'responsible' => 'Responsible',
            'email_responsible' => 'Email Responsible',
            'department'=>'Отдел',
            'company'=>'Компания',
            'surname'=>'Фамилия'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionlogs()
    {
        return $this->hasMany(Actionlog::className(), ['User_ID' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['User_ID' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['Author' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets0()
    {
        return $this->hasMany(Tickets::className(), ['AssignedTo' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsernotifications()
    {
        return $this->hasMany(Usernotifications::className(), ['User_ID' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['Role_ID' => 'role_id']);
    }
    
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['Department_ID' => 'department_id']);
    }
    
     public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['Company_ID' => $this->getDepartment()]);
    }
    
    
    
   
}
