<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->Name;

?>
<div style='width:500px;'>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
<table class="table table-striped table-bordered detail-view">
        <tr><th>Код продукта</th><td><?=$model->Product_ID;?></td></tr>
        <tr><th>Проект</th><td><?=$project_name;?></td></tr>
        <tr><th>Продукт</th><td><?=$model->Name;?></td></tr>
        


    </table>
    
    

</div>
</div>