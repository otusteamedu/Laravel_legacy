<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Ticket_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InReplyTo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DateTime')->textInput() ?>

    <?= $form->field($model, 'User_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
