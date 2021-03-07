<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Xaridor */

$this->title = $model->xaridor_id;
$this->params['breadcrumbs'][] = ['label' => 'Харидорлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php if(yii::$app->session->hasFlash('message')):?>
<div class="alert alert-dismissible alert-success">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo Yii::$app->session->getFlash('message');?>
</div>
<?php endif;?>

<div class="xaridor-view">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ўзгартириш', ['update', 'id' => $model->xaridor_id], ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::a('Ўчириш', ['delete', 'id' => $model->xaridor_id], [
            'class' => 'btn btn-danger btn-lg',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <a href=<?php echo yii::$app->request->referrer;?> 
        class="btn btn-primary btn-lg">Орқага</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'xaridor_id',
            'ismi',
            'sana',
        ],
    ]) ?>

</div>
