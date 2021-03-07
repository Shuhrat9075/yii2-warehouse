<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qayerdan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'miqdori_kg')->textInput() ?>

    <?= $form->field($model, 'sana')->widget(\dosamigos\datepicker\DatePicker::className(), [
    'inline' => false, 
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
    ],
]) ?>

   
    
   
    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-primary btn-lg']) ?>
        <a href=<?php echo yii::$app->request->referrer;?> 
        class="btn btn-primary btn-lg" style="margin-left:20px;">Орқага</a>
           
    </div>

    <?php ActiveForm::end(); ?>

</div>
