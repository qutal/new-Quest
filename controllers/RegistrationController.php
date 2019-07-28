<?php


namespace app\controllers;


use app\models\RegForm;
use app\models\User;
use yii\web\Controller;
use Yii;

class RegistrationController extends Controller
{

    public function actionReg(){
        $model=new RegForm();
        $user=new User();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->password=md5($model->password);
            $model->save();
            Yii::$app->user->login(User::findByUsername($model->username));
            return $this->goHome();
        }
        return $this->render('reg',['model'=>$model]);
    }

}