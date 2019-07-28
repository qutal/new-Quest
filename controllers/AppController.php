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
            if(Yii::$app->request->post('submit')!=null) {
                $routes = RoutesForm::findOne(Yii::$app->request->post('submit'));
                if ($routes->ticket > 0  ) {
                    $user_id = \Yii::$app->user->id;
                    $users_routes = new UsersRoutesForm();
                    $users_routes->user_id = $user_id;
                    $users_routes->route_id = Yii::$app->request->post('submit');
                    $users_routes->save();

                    $routes->ticket = $routes->ticket - 1;
                    $routes->save();
                }
            }
            $query = RoutesForm::find();
            return $this->render('main', $this->Pagination($query));
        }else{
            return $this->render('errorAccess');
        }
    }



}