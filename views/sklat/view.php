<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sklat */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sklat Kunlik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sklat-view">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('O\'zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-lg',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
               <a href=<?php echo yii::$app->request->referrer;?> class="btn btn-primary btn-lg">Orqaga</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomi',
            'kirim_miqdor',
            'chiqim_miqdor',
            'qoldiq',
            'sana',
        ],
    ]) ?>

</div>
