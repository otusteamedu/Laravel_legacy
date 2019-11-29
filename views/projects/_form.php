<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>
    
  <?php if($blocked==1){ ?>
        
     <?= $form->field($model, 'Active')->textInput(['value'=>'Активен', 'disabled'=>'true'])->label('Активен*') ?> 
     
    <?php echo "*вы не можете деактивировать данный модуль т.к. есть активные запросы связанные с ним";?>
    
    <?php } else { ?>
    
     <?= $form->field($model, 'Active')->dropDownList($a= ['1' => 'Активен', '0' => 'Неактивен'])->label('Активен*') ?>
    
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
