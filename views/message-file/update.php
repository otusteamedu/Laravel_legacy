<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MessageFile */

$this->title = 'Update Message File: ' . ' ' . $model->File_ID;
$this->params['breadcrumbs'][] = ['label' => 'Message Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->File_ID, 'url' => ['view', 'id' => $model->File_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="message-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
