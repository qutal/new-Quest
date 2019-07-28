<?php


namespace app\controllers;


use app\models\RoutesForm;
use app\models\UsersRoutesForm;
use yii\data\Pagination;
use yii\web\Controller;

class HisController extends Controller
{
    public function Pagination($query){
        $routes=new RoutesForm();

        //Создаем объект пагинации
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 1]);
        //Формируем объект таблицы
        $posts = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return ['pages' => $pages, 'posts' => $posts,'routes'=>$routes];
    }
    public function actionHistory(){
        if(!\Yii::$app->user->isGuest) {
            $user_id = \Yii::$app->user->id;
            if(\Yii::$app->request->post('submit')!=null){
                $routes = RoutesForm::findOne(\Yii::$app->request->post('submit'));
                $routes->ticket = $routes->ticket+1;
                $routes->save();

                $users_routes = UsersRoutesForm::find()->where(['user_id'=>$user_id,'route_id'=>\Yii::$app->request->post('submit')])->one();
                $users_routes->delete();
            }
            $query = UsersRoutesForm::find()->where(['=','user_id',$user_id]);
            return $this->render('history', $this->Pagination($query));
        }else{
            return $this->render('errorAccess');
        }
    }

}