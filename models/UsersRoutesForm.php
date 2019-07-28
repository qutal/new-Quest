<?php


namespace app\models;


use yii\db\ActiveRecord;

class UsersRoutesForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'users_routers';
    }
}