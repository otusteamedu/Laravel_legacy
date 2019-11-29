<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentsQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Department_ID') ?>

    <?= $form->field($model, 'IsSubdivisionOf') ?>

    <?= $form->field($model, 'Company_ID') ?>

    <?= $form->field($model, 'Name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
