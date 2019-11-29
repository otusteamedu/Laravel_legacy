<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Modules */

$this->title = 'Создание подсистемы/услуги';

?>
<div style='width:500px;'>
<div class="modules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a'=>$a
    ]) ?>

</div>
</div>