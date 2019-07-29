<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php if(!empty($posts)):?>
<?php foreach ($posts as $post):?>
    <div class="card w-80" style="width: 18rem;">
        <img class="card-img-top" src="/img.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $post['departure_city'].'-'.$post['arrival_city']?></h5>
            <p class="card-text"><?= 'Цена:'.$post['price'].'<br>'. 'Время отправления:'.$post['departure_time'].'<br>'.
                                     'Время прибытия:'.$post['arrival_time'].'<br>'.
                                      'Билетов осталось:'.$post['ticket'].'<br>'
                                     ?></p>

                <?php if($post['ticket']<=0):?>
                    <div class="alert alert-danger" role="alert">
                        Билеты закончились
                    </div>
                <?php endif;?>
                <?php if($post['ticket']>0):?>
                <a href="<?= \yii\helpers\Url::to(['/app/work','route_id'=>$post['route_id']]) ?>" class="btn btn-success">Заказать</a>
<!--                    --><?php //$form= ActiveForm::begin();?>
<!--                        --><?//= Html::submitButton('Заказать',['name'=>'submit','value'=>$post['route_id'],'class'=>'btn btn-success']) ?>
<!--                    --><?php //ActiveForm::end();?>
                <?php endif;?>

        </div>
    </div>

<?php endforeach; ?>
<?php endif;?>
<br>
<?php if(\Yii::$app->request->post('submit')!=null) : ?>
    <div class="alert alert-success" role="alert">
        Покупка успешна
    </div>
<?php endif ?>


<?= \yii\widgets\LinkPager::widget(['pagination'=>$pages]);?>
