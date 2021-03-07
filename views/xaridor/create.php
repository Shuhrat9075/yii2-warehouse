<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Xaridor */

$this->title = 'Харидор Қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Харидорлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="xaridor-create">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
