<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Modules */

$this->title = $model->Name;

?>
<div style='width:500px;'>
<div class="modules-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <table class="table table-striped table-bordered detail-view">
        <tr><th>Код подсистемы</th><td><?=$model->Module_ID;?></td></tr>
        <tr><th>Продукт</th><td><?=$product_name;?></td></tr>
        <tr><th>Подсистема</th><td><?=$model->Name?></td></tr>
    </table>
    
 

</div>
    </div>
