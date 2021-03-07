<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\LinkPager;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChiqimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Чиқим Жадвали';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chiqim-index">


<?php if(yii::$app->session->hasFlash('message')):?>
<div class="alert alert-dismissible alert-success">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo Yii::$app->session->getFlash('message');?>
</div>
<?php endif;?>

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Қўшиш', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $gridColumns = [
        'xaridor_id',
        'ismi',
        [
            'attribute'=>'nomi',
            'footer' => 'Жами', 
        ],
        [
            'attribute'=>'miqdori_kg',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('miqdori_kg'),0), 
        ],
        [
            'attribute'=>'narxi', 
            'format' => ['decimal',0],
        ],
        [
            'attribute'=>'jami_sum',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('jami_sum'),0), 
        ],
        [
            'attribute'=>'berilgan_sum',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('berilgan_sum'),0),
        ],
        [
            'attribute'=>'qolgan_sum',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('qolgan_sum'),0), 
          
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

            //'id',
            //'xaridor_id',
            'ismi',
            [
                'attribute'=>'nomi',
                'footer' => 'Жами', 
            ],
            [
                'attribute'=>'miqdori_kg',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('miqdori_kg'),0), 
            ],
            [
                'attribute'=>'narxi', 
                'format' => ['decimal',0],
            ],
            [
                'attribute'=>'jami_sum',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('jami_sum'),0), 
            ],
            [
                'attribute'=>'berilgan_sum',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('berilgan_sum'),0),
            ],
            [
                'attribute'=>'qolgan_sum',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('qolgan_sum'),0), 
              
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
