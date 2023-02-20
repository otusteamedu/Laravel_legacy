<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Ticket_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AssignedTo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Module_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Category_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Type_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Priority_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HighPriorityReason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Status_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FD')->textInput() ?>

    <?= $form->field($model, 'TD')->textInput() ?>

    <?= $form->field($model, 'DependsOn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
