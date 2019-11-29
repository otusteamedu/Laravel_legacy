<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Period */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="period-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Ticket_ID')->textInput() ?>

    <?= $form->field($model, 'Year')->textInput() ?>

    <?= $form->field($model, 'Month')->textInput() ?>

    <?= $form->field($model, 'Week')->textInput() ?>

    <?= $form->field($model, 'Weekday')->textInput() ?>

    <?= $form->field($model, 'Day_Month')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'Month_check')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
