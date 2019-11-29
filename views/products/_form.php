<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
$project_id = Yii::$app->request->get()['project'];
$project_name = Yii::$app->request->get()['project_name'];
?>
<div style='width:500px;'>
<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'Project_ID')->textInput(['value'=>$project_name, 'disabled'=>'true'])->label('Проект') ?> 
    
  <?= Html::hiddenInput('Products[Project_ID]', $project_id) ?> 

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->label('Название продукта') ?>

   
    
    <?php if($blocked==1){ ?>
        
     <?= $form->field($model, 'Active')->textInput(['value'=>'Активен', 'disabled'=>'true'])->label('Активен*') ?> 
     
    <?php echo "*вы не можете деактивировать данный модуль т.к. есть активные запросы связанные с ним";?>
    
    <?php } else { ?>
    
     <?= $form->field($model, 'Active')->dropDownList($a= ['1' => 'Активен', '0' => 'Неактивен'])->label('Активен*') ?>
    
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cоздать' : 'Редактировать', ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>