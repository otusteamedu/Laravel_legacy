<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Type_Task')->textInput() ?>

    <?= $form->field($model, 'Date_Time')->textInput() ?>

    <?= $form->field($model, 'Ticket_ID')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'Params')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
