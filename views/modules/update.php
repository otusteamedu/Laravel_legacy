<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modules */

$this->title = 'Изменение подсистемы/услуги: ' . ' ' . $model->Name;

?>
<div style='width:500px;'>
<div class="modules-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'blocked' => $blocked,
    ]) ?>

</div>
    </div>
