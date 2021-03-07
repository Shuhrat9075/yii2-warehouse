<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SklatOylikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склат Ойлик';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sklat-index">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <form action="<?= \yii\helpers\Url::to(['sklat-oylik/index']) ?>">

        <?php @field_cref ?>
        
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="date" value="<?= $date ?>">
            </div>
        </div>
        
        <br>

        <button type="submit" class="btn btn-primary btn-lg">Чиқариш</button>
        
    </form>
    <form action="<?= \yii\helpers\Url::to(['sklat-oylik/export-excel']) ?>">

    <?php @field_cref ?>
    <button type="submit" class="btn btn-success btn-lg pull-right">Ехcелга Юклаш</button>
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" class="form-control" name="date" value="<?= $date ?>">
        </div>
    </div>

    

    </form>
    <br>
    <?php

        $j = 1;

    ?>
<div class="row">
    
<div class="col-md-8">
    
    <table class="table">

        <thead class="bg-primary">

            <tr>
            <th scope="col">#</th>
            <th scope="col">Номи</th>
            <th scope="col">Кирим Миқдор Кг</th>
            <th scope="col">Чиқим Миқдор Кг</th>
            <th scope="col">Қолдиқ</th>
            </tr>
        
        </thead>

        <tbody>

        <?php
            $i = 1;
            //var_dump($datas);
        ?>  

            <?php foreach($datas as $data) { 
                
                $kirim += $data['kirim_miqdor'];
                $chiqim += $data['chiqim_miqdor'];
                $qoldiq += $data['qoldiq'];
                
            ?>
                <tr>

                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $data['nomi'] ?></td>
                    <td><?= number_format($data['kirim_miqdor']) ?></td>
                    <td><?= number_format($data['chiqim_miqdor']) ?></td>
                    <td><?= number_format($data['qoldiq']) ?></td>
                   
                </tr>

            <?php } ?>
                

        </tbody>

        <tfoot class="bg-primary">
            <tr>
                <td></td>
                <td>Жами</td>
                <td><?= number_format($kirim) ?></td>
                <td><?= number_format($chiqim) ?></td>
                <td><?= number_format($qoldiq) ?></td>
            </tr>
        </tfoot>
        
    </table>


    </div>


    <div class="col-md-4">

    <table class="table">
        <thead class="bg-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Номи</th>
                <th scope="col">Ўтган ойдан қолдиқ кг</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($datas_otgan as $data) { 
                
                $qoldiq2 += $data['qoldiq'];
                
                ?>


                <tr>

                    <th scope="row"><?= $j++; ?></th>
                    <td><?= $data['nomi'] ?></td>
                    <td><?= number_format($data['qoldiq'],0) ?></td>

                </tr>
            <?php } ?>
        </tbody>

        <tfoot class="bg-primary">
            <tr>
                <td></td>
                <td>Жами</td>
                <td><?= number_format($qoldiq2,0) ?></td>
            </tr>
        </tfoot>

    </table>
    </div>

</div>
    
    
</div>
