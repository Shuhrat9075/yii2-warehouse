<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sklat */

$this->title = 'Create Sklat';
$this->params['breadcrumbs'][] = ['label' => 'Sklats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
