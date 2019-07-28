<?php


namespace app\models;


use yii\db\ActiveRecord;

class RegForm extends ActiveRecord
{

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username','password','name','email'],'required'],
            [['username','password','name','email'],'trim'],
            [['username','name'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
            ['username','checkUsername'],
            ['email','checkEmail']
        ];
    }

    public function checkUsername(){
        $user=RegForm::find()->where(['username'=>$this->username])->one();
        if($user!=null){
            $this->addError('username','Этот логин занят');
        }
    }

    public function checkEmail(){
        $user=RegForm::find()->where(['email'=>$this->email])->one();
        if($user!=null){
            $this->addError('email','Этот email занят');
        }
    }

    public function attributeLabels()
    {
        return ['username'=>'Логин','name'=>'Имя','email'=>'email','password'=>'Пароль'];
    }

}