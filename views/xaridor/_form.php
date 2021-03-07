<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Xaridor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xaridor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ismi')->textInput(['maxlength' => true]) ?>
    
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
        class="btn btn-primary btn-lg">Орқага</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
