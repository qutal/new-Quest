<?php


namespace app\controllers;


use yii\web\Controller;

class ContController extends Controller
{
        public function actionC(){
            return $this->render('c');
        }
}