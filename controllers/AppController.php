<?php


namespace app\controllers;


use app\models\RoutesForm;
use app\models\User;
use app\models\UsersRoutesForm;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class AppController extends Controller
{
    public function Pagination($query){
        $routes=new RoutesForm();

        //Создаем объект пагинации
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 1]);
        //Формируем объект таблицы
        $posts = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return ['pages' => $pages, 'posts' => $posts,'routes'=>$routes];
    }


    public function actionOrder(){

        if(!\Yii::$app->user->isGuest){
            $query = RoutesForm::find();
            return $this->render('main', $this->Pagination($query));
        }else{
            return $this->render('errorAccess');
        }
    }

    public function actionWork($route_id){
        if(!\Yii::$app->user->isGuest){
            $routes = RoutesForm::findOne($route_id);
            $user_id = \Yii::$app->user->id;
            $users_routes = new UsersRoutesForm();
            $users_routes->user_id = $user_id;
            $users_routes->route_id =$route_id;
            $users_routes->save();
            $routes->ticket = $routes->ticket - 1;
            $routes->save();
            return $this->redirect('/app/order');
        }else{
            return $this->render('errorAccess');
        }
    }



}