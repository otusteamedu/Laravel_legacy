<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MessageFiles".
 *
 * @property string $File_ID
 * @property string $Path
 * @property string $Message_ID
 *
 * @property Messages $message
 */
class MessageFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MessageFiles0';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Path', 'Message_ID'], 'required'],
            [['Message_ID'], 'integer'],
            [['Path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'File_ID' => 'File  ID',
            'Path' => 'Path',
            'Message_ID' => 'Message  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Messages::className(), ['Message_ID' => 'Message_ID']);
    }
}
