<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chiqim */

$this->title = 'Қўшиш Чиқимга';
$this->params['breadcrumbs'][] = ['label' => 'Чиқим Жадвали', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chiqim-create">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
