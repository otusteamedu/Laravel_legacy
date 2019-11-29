<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticketsestimatesend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticketsestimatesend-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Ticket_ID')->textInput() ?>

    <?= $form->field($model, 'esttime')->textInput() ?>

    <?= $form->field($model, 'last_send')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
