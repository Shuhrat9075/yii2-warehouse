<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
        <?= Html::a('Sign in', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </p>
<div class="site-about">
   
<?= Html::a('Shuhrat Shamuratov', ['my-form/abc.pdf']) ?><br>
<?= Html::a('Abdulla buxoro', ['my-form/abc.pdf']) ?><br>
<?= Html::a('Ewmat quronboy', ['my-form/abc.pdf']) ?><br>

</div>
