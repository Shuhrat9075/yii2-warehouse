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

    <?= $form->field($model, 'sana')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-primary btn-lg']) ?>
        <a href=<?php echo yii::$app->request->referrer;?> class="btn btn-primary btn-lg">Orqaga</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
