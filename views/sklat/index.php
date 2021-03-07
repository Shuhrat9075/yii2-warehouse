<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SklatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склат Кунлик';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklat-index">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $gridColumns = [
        [
            'attribute'=>'nomi',
            'footer' => 'Жами', 
        ],
        [
            'attribute'=>'kirim_miqdor',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('kirim_miqdor'),0), 
        ],
        [
            'attribute'=>'chiqim_miqdor',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('chiqim_miqdor'),0), 
        ],
        [
            'attribute'=>'qoldiq',
            'format' => ['decimal',0],
            'footer' => number_format($dataProvider->query->sum('qoldiq'),0), 
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
            [
                'attribute'=>'nomi',
                'footer' => 'Жами', 
            ],
            [
                'attribute'=>'kirim_miqdor',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('kirim_miqdor'),0), 
            ],
            [
                'attribute'=>'chiqim_miqdor',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('chiqim_miqdor'),0), 
            ],
            [
                'attribute'=>'qoldiq',
                'format' => ['decimal',0],
                'footer' => number_format($dataProvider->query->sum('qoldiq'),0), 
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
