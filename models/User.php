<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['email', 'password', 'mobile_number'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['email', 'password', 'mobile_number'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 6],
            [['created_at', 'updated_at'], 'safe'],
            [['mobile_number'], 'string', 'max' => 15],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'mobile_number' => 'Mobile Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
