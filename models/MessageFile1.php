<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MessageFiles".
 *
 * @property string $file_id
 * @property string $message_id
 * @property string $filetype_id
 * @property string $file_filename
 * @property string $file_filesize
 * @property string $file_mime
 * @property string $file_note
 * @property string $file_date
 * @property string $file_status
 *
 * @property Messages $message
 */
class MessageFile1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MessageFiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_id'], 'required'],
            [['message_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'ID файла',
            'message_id' => 'ID сообщения',
            'filetype_id' => 'ID типа документа',
            'file_filename' => 'Имя файла',
            'file_filesize' => 'Размер',
            'file_mime' => 'MIME-тип файла',
            'file_note' => 'Описание файла',
            'file_date' => 'Дата добавления',
            'file_status' => 'Состояние'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Messages::className(), ['Message_ID' => 'message_id']);
    }
}
