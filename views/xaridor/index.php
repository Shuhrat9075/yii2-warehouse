<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\ChiqimSearch;
use app\models\Chiqim;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\XaridorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Харидорлар';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(yii::$app->session->hasFlash('message')):?>
<div class="alert alert-dismissible alert-success">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo Yii::$app->session->getFlash('message');?>
</div>
<?php endif;?>

<div class="xaridor-index">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Харидор Қўшиш', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $gridColumns = [
        'xaridor_id',
        [
            'attribute' => 'ismi',
            'format' => 'raw',
            'footer' => 'Жами', 
        ],
        [
            'label' => 'Қарздорлик',
            'format' => ['decimal',0],
            'value' => function($model){
                $sum = 0;
                foreach ($model->chiqim as $ch)
                {
                    $sum += $ch->qolgan_sum;
                }
                return $sum;
            },
            'footer' => number_format($sum,0),
        ],
        'sana',
    ];

    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'footerRowOptions'=>['style'=>'font-weight:normal;background-color:#0275d8;color:white;'],
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
           'xaridor_id',
            [
                'attribute' => 'ismi',
                'format' => 'raw',
                'value'=>function($model){
                    return Html::a($model->ismi,'@web/chiqim?xaridor_id='.$model->xaridor_id);                   
                },
                'footer' => 'Жами', 
             ],
             [
                'label' => 'Қарздорлик',
                'format' => ['decimal',0],
                'value' => function($model){
                    $sum = 0;
                    foreach ($model->chiqim as $ch)
                    {
                        $sum += $ch->qolgan_sum;
                    }
                    return $sum;
                },
                'footer' => number_format($sum,0),
            ],
            [
                'attribute'=>'sana',
                'value' => 'sana',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'sana',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]),
            ],
           ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
