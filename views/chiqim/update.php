<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chiqim */

$this->title = 'Ўзгартириш Чиқим';
$this->params['breadcrumbs'][] = ['label' => 'Чиқим Жадвали', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ўзгартириш Чиқим';
?>
<div class="chiqim-update">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
