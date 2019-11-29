<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'username') ?>

    <?php // echo  $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'department_id') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'role_id') ?>

    <?php // echo $form->field($model, 'additionalData') ?>

    <?php // echo $form->field($model, 'FD') ?>

    <?php // echo $form->field($model, 'TD') ?>

    <?php  echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
