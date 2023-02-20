<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MessagesQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Message_ID') ?>

    <?= $form->field($model, 'Ticket_ID') ?>

    <?= $form->field($model, 'InReplyTo') ?>

    <?= $form->field($model, 'DateTime') ?>

    <?= $form->field($model, 'User_ID') ?>

    <?php // echo $form->field($model, 'Text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
