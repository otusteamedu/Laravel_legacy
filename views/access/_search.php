<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccessQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Role_id') ?>

    <?= $form->field($model, 'Module_ID') ?>

    <?= $form->field($model, 'Level_Rights') ?>


    <?php // echo $form->field($model, 'Allow_Create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
