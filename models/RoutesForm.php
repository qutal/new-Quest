<?php


namespace app\models;


use yii\db\ActiveRecord;

class RoutesForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'routes';
    }
}