<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Xaridor */

$this->title = 'Харидор Ўзгартириш : ' . $model->xaridor_id;
$this->params['breadcrumbs'][] = ['label' => 'Харидорлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->xaridor_id, 'url' => ['view', 'id' => $model->xaridor_id]];
$this->params['breadcrumbs'][] = 'Ўзгартириш';
?>
<div class="xaridor-update">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
