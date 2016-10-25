<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property integer $age
 * @property string $input_date
 * @property string $file
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $uploadedFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'age', 'input_date'], 'required', 'message'=>'Поле "{attribute}" должно быть заполнено.'],
            [['age'], 'integer', 'min'=>17, 'max'=>65],
            [['input_date'], 'safe'],
            [['full_name', 'email', 'file'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true],
            ['full_name', 'match', 'pattern' => '/^[A-ZА-Я]{1}[а-яА-ЯёЁa-zA-Z]+\s[A-ZА-Я]{1}[а-яА-ЯёЁa-zA-Z0-9-]+/u']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Имя и фамилия',
            'email' => 'Email',
            'age' => 'Возраст',
            'input_date' => 'Дата',
            'file' => 'Файл',
        ];
    }


    public function getFeed($feedId){
        return $this->findOne($feedId);
    }




    public function insertMy($table ='', $data = array()){
        $db = Yii::$app->db;
        $db->createCommand()->insert($table, $data)->execute();
    }

    public function fileUpload(){
        $this->uploadedFile->saveAs('uploads/' . $this->uploadedFile->baseName . '.' . $this->uploadedFile->extension);
        return true;
    }
}
