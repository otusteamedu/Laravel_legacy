<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Modules */
/* @var $form yii\widgets\ActiveForm */
$project_id = Yii::$app->request->get()['project'];
$product_id = Yii::$app->request->get()['product'];
$project_name = Yii::$app->request->get()['project_name'];
$product_name = Yii::$app->request->get()['product_name'];
//echo $project_id;
//var_dump(\app\models\Projects::findOne($project_id));
?>
<div style='width:500px;'>
<div class="modules-form">

     
    
    <?php $form = ActiveForm::begin(); ?>
    
    

  <?= $form->field($model, 'Project_ID')->textInput(['value'=>$project_name, 'disabled'=>'true'])->label('Проект') ?> 
    
  <?= Html::hiddenInput('Modules[Project_ID]', $project_id) ?> 
    
  <?= $form->field($model, 'Product_ID')->textInput(['value'=>$product_name, 'disabled'=>'true'])->label('Продукт') ?>
   
   <?= Html::hiddenInput('Modules[Product_ID]', $product_id) ?>   

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->label('Подсистема') ?>
    
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
