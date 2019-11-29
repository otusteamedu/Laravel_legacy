<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\sla */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sla-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Projects::find()->all(), 'Project_ID', 'Name' ))->label('Проект') ?>

    <?= $form->field($model, 'product_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Products::find()->all(), 'Product_ID', 'Name' ))->label('Продукт') ?>

    <?= $form->field($model, 'module_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Modules::find()->all(), 'Module_ID', 'Name' ))->label('Подсистема') ?>

    <?= $form->field($model, 'priority_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Priority::find()->all(), 'Priority_ID', 'Name' ))->label('Приоретит') ?>

    <?= $form->field($model, 'status_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Status::find()->all(), 'Status_ID', 'Name' ))->label('Статус') ?>
    
    <?= $form->field($model, 'type_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Type::find()->all(), 'Type_ID', 'Name' ))->label('Тип')  ?>

    <?= $form->field($model, 'sla')->textInput()->label('SLA (Минуты) ') ?>

    <?= $form->field($model, 'interval')->textInput()->label('Интервал напоминания (Минуты) ') ?>



    <?= $form->field($model, 'message')->textarea(['rows' => 6])->label('Сообщение') ?>

    <?= $form->field($model, 'active')->textInput()->dropDownList(['0' => 'Неактивен', '1' => 'Активен'])->label('Активен/Неактивен') ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
