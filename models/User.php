<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $name;
    public $password;
    public $authKey;
    public $accessToken;
    public $user_id;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
    
  
 

    /**
     * @inheritdock
     */
   // public static function findIdentity($id)
   // {
     //   return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
   // }

    
     public static function tableName()
    {
        return '{{%users}}';
    }
    
    
     public static function findIdentity($id)
    {
          $h= static::findOne($id);
      
      self::$users= [  $h->oldAttributes['id'] => [
            'id' =>  $h->oldAttributes['id'],
            'username' => $h->oldAttributes['username'],
            'name' => $h->oldAttributes['name'],
            'password' => $h->oldAttributes['password'],
            'status' => $h->oldAttributes['status'],
            'user_id' => $h->oldAttributes['user_id'],
            'department_id' => $h->oldAttributes['department_id'],
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ] ];
        
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       
     $h= static::find()->where(['username' => $username])->one();
      
      self::$users= [  $h->oldAttributes['id'] => [
            'id' =>  $h->oldAttributes['id'],
            'username' => $h->oldAttributes['username'],
            'name' => $h->oldAttributes['name'],
            'password' => $h->oldAttributes['password'],
            'status' => $h->oldAttributes['status'],
            'user_id' => $h->oldAttributes['user_id'],
            'department_id' => $h->oldAttributes['department_id'],
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ] ];
      
   
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
              
                       
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    
     public function getUserId()
    {
        return $this->user_id;
    }
     public function getName()
    {
        return $this->name;
    }
}
