<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = 'Изменение Катагории: ' . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Category_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
