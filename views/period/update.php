<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Period */

$this->title = 'Update Period: ' . ' ' . $model->Period_ID;
$this->params['breadcrumbs'][] = ['label' => 'Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Period_ID, 'url' => ['view', 'id' => $model->Period_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="period-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
