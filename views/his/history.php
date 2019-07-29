<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<?php if(!empty($posts)):?>
<?php foreach ($posts as $post):?>
    <?php $route_id=$post['route_id'];
    $route=$routes::findOne($route_id);
    ?>
    <div class="card w-80" style="width: 18rem;">
        <img class="card-img-top" src="/img.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $route['departure_city'].'-'.$route['arrival_city']?></h5>
            <p class="card-text"><?= 'Цена:'.$route['price'].'<br>'. 'Время отправления:'.$route['departure_time'].'<br>'.
                'Время прибытия:'.$route['arrival_time'].'<br>'.
                'Билетов осталось:'.$route['ticket'].'<br>'
                ?></p>
            <a href="<?=\yii\helpers\Url::to(['/his/delete','route_id'=>$route_id])?>" class="btn btn-danger">Удалить</a>
        </div>
    </div>
<?php endforeach; ?>
<?php endif;?>
<?php if(empty($posts)):?>
    <div class="alert alert-info">
        <h1>Похоже, что заказов нет.<a href="<?=\yii\helpers\Url::to('/app/order')?>">Заказать?</a></h1>
    </div>


<?php endif;?>

<?= \yii\widgets\LinkPager::widget(['pagination'=>$pages]);?>
