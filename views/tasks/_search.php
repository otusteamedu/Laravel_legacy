<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TasksQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Type_Task') ?>

    <?= $form->field($model, 'Date_Time') ?>

    <?= $form->field($model, 'Ticket_ID') ?>

    <?= $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'Params') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
