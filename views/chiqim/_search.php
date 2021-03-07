<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChiqimSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chiqim-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ismi') ?>

    <?= $form->field($model, 'nomi') ?>

    <?= $form->field($model, 'miqdori_kg') ?>

    <?= $form->field($model, 'narxi') ?>

    <?php // echo $form->field($model, 'jami_sum') ?>

    <?php // echo $form->field($model, 'berilgan_sum') ?>

    <?php // echo $form->field($model, 'qolgan_sum') ?>

    <?php // echo $form->field($model, 'sana') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
