<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SlaQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sla-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_id')->label('Проект') ?>

    <?= $form->field($model, 'product_id')->label('Продукт/Набор услуг') ?>

    <?= $form->field($model, 'module_id')->label('Подсистема/Услуга') ?>

    <?= $form->field($model, 'priority_id')->label('Критичность') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'sla') ?>

    <?php // echo $form->field($model, 'interval') ?>

    <?php // echo $form->field($model, 'last_send') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
