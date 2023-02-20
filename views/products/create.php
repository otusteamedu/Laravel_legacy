<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Создание продукта/набора услуг';

?>
<div style='width:500px;'>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a'=>$a,
    ]) ?>

</div>
    </div>
