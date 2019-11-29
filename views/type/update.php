<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Type */

$this->title = 'Update Type: ' . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Type_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
