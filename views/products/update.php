<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
 
$this->title = 'Изменение продукта/набора услуг: ' . ' ' . $model->Name;

?>
<div style='width:500px;'>
<div class="products-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'blocked' => $blocked,
    ]) ?>

</div>
</div>