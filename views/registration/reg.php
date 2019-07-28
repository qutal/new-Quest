<?php use yii\widgets\ActiveForm;
use yii\helpers\Html;


$form=ActiveForm::begin();

?>
<?= $form->field($model,'username');?>
<?= $form->field($model,'name');?>
<?= $form->field($model,'password')->passwordInput();?>
<?= $form->field($model,'email');?>
<?= Html::submitButton('Отправить',['name'=>'submit','value'=>'done','class'=>'btn btn-success']);?>

<?php ActiveForm::end();?>