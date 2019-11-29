<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="period-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Period_ID') ?>

    <?= $form->field($model, 'Ticket_ID') ?>

    <?= $form->field($model, 'Year') ?>

    <?= $form->field($model, 'Month') ?>

    <?= $form->field($model, 'Week') ?>

    <?php // echo $form->field($model, 'Weekday') ?>

    <?php // echo $form->field($model, 'Day_Month') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'Month_check') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
