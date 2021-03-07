<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Xaridor;


/* @var $this yii\web\View */
/* @var $model app\models\Chiqim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chiqim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'xaridor_id')
     ->dropDownList(
            ArrayHelper::map(Xaridor::find()->all(), 'xaridor_id', 'ismi'),
            ['prompt'=>'Харидорларни танланг']
            )
    ?>

    <?= $form->field($model, 'ismi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'miqdori_kg')->textInput() ?>

    <?= $form->field($model, 'narxi')->textInput() ?>

    <?= $form->field($model, 'berilgan_sum')->textInput() ?>

    <?= $form->field($model, 'sana')->widget(\dosamigos\datepicker\DatePicker::className(), [
    'inline' => false, 
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
    ],
]) ?>

  


    <div class="form-group">
        <?= Html::submitButton('Сақлаш', ['class' => 'btn btn-primary btn-lg']) ?>
        <a href=<?php echo yii::$app->request->referrer;?> class="btn btn-primary btn-lg">Орқага</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
