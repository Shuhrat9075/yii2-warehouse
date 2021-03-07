<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sklat */

$this->title = 'O\'zgartirish Sklat Kunlik';
$this->params['breadcrumbs'][] = ['label' => 'Sklat Kunlik', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'O\'zgartirish Sklat Kunlik';
?>
<div class="sklat-update">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
