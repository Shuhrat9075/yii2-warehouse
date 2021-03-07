<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sklat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sklat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kirim_miqdor')->textInput() ?>

    <?= $form->field($model, 'chiqim_miqdor')->textInput() ?>

    <?= $form->field($model, 'qoldiq')->textInput() ?>

    <?= $form->field($model, 'sana')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
