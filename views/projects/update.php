<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = 'Изменение проекта: ' . ' ' . $model->Name;

?>
<div style='width:500px;'>
<div class="projects-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'blocked' => $blocked,
    ]) ?>

</div>
</div>