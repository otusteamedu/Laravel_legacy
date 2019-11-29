<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
 
?>

<div class="users-form">

   
    
    <div class="users-view-panel">

<?php 
                      ?>
<?php ?>

<?php ?>
        <table style="width: 100%; vertical-align: top;">
    <tr>
        <td>
            <div class="img-group">
            <?php if ($model->imageFile!='') {
                ActiveForm::begin([
                                      'method' => 'post',
                                      'action' => ["users/update/$model->id"],
       
                                  ]);
              echo Html::img("@web/uploads/photos/$model->imageFile", ['class' => 'img-group-avatar', 'width'=>'200', 'height'=>'200']);
              echo "<p>";
              echo Html::submitButton($model->isNewRecord ? 'Create' : 'Удалить аватару', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'delete_avatar', 'value'=>'1']);
              echo "</p>"; ?>
              <input type='hidden' name='id' value="<?php echo  $model->id; ?>"> <?php;
              ActiveForm::end();
            }
            else {
                $form = ActiveForm::begin([
                                      'method' => 'post',
                                      'action' => ['users/photofile'],
                                     'options' => ['enctype'=>'multipart/form-data'],
                                  ]);
              echo Html::img("@web/uploads/photos/no.png", ['width'=>'200', 'height'=>'200']);
              ?>
                <div class="form-group">
              <div class="file js-file"><input type="file" name="photoFile"> <button type="button" class="remove disabled" title="Убрать файл">✕</button></div>
              <input type='hidden' name='ui' value="<?php echo  $model->id; ?>">

            </div>
            <div class="form-group" >
                <?= Html::submitButton('Добавить фото', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); }?>
            </div>
        </td>
        <td style="width:85%">
          
     <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id'=>'subm']]) ?>
    
   
<?php if($_SESSION['first_edit']!=1){?>
<table width=100%><tr><td width='25%'><?php echo Html::label('Генерировать новый пароль');?></td><td><?php echo Html::checkbox('generate_password', false);?></td></tr></table>

<?php }?>
    <table width=100%><tr><td width='25%'><?php echo Html::label('Фамилия* :');?></td><td width='20%'><?= $form->field($model, 'surname')->textInput(['maxlength' => true])->label(false); ?></td>
           <td width='8%' >&nbsp;&nbsp;&nbsp;<?php echo Html::label('Имя* :');?></td><td width='20%'><?= $form->field($model, 'realname')->textInput(['maxlength' => true])->label(false); ?></td>
             <td width='11%'>&nbsp;&nbsp;&nbsp;<?php echo Html::label('Отчество :');?></td><td width='21%'><?= $form->field($model, 'second_name')->textInput(['maxlength' => true])->label(false); ?></td>
        </tr></table>

     <table width=100%><tr><td width='25%'><?php echo Html::label('Логин пользователя*:');?></td><td><?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false) ?></td></tr></table>
       <table width=100%><tr><td width='25%'><?php echo Html::label('Компания*:');?></td><td><?= $form->field($model, 'role_id')->textInput()->dropDownList(ArrayHelper::map(\app\models\Companies::find()->all(), 'Company_ID', 'Name' ))->label(false) ?></td></tr></table>
    
    <table width=100%><tr><td width='25%'><?php echo Html::label('Отдел*:');?></td><td> <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(\app\models\Departments::find()->all(), 'Department_ID', 'Name' ))->label(false) ?></td></tr></table>
     <table width=100%><tr><td width='25%'><?php echo Html::label('Должность*:');?></td><td> <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label(false) ?></td></tr></table>
      <table width=100%><tr><td width='25%'><?php echo Html::label('Email*:');?></td><td> <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?></td></tr></table>
                
      
        </td>
        </tr>
        </table>




   
    
   
    
 

    <table width=100%><tr>
                         <td width='50%'>
                             <table width=100%><tr><td width='25%'><?php echo Html::label('Номер телефона*:');?></td><td>  <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label(false) ?></td></tr></table>
          </td>
     
           
          <td> 
               <table width=100% ><tr><td width='20%' style='padding-left:10px;'><?php echo Html::label('Статус*:');?></td><td> <?= $form->field($model, 'status')->dropDownList($a= ['0' => 'Уволен', '1' => 'Заблокирован', '2' => 'Активен'])->label(false) ?></td></tr></table>
          </td>
                     </tr></table>
        
        <table width=100%><tr>
                         <td width='50%'>
                             <table width=100%><tr><td width='20%' ><?php echo Html::label('Ответственное лицо:');?></td><td style='padding-left:25px;'> <?= $form->field($model, 'responsible')->textInput(['maxlength' => true])->label(false) ?></td></tr></table>
          </td>
     
           
          <td>
               <table width=100%><tr><td width='20%' style='padding-left:10px;'><?php echo Html::label('Email:');?></td><td> <?= $form->field($model, 'email_responsible')->textInput(['maxlength' => true])->label(false) ?></td></tr></table>
          </td>
                     </tr></table>
    
    
    
    
    
    
    </div>
                <?php

?>
   <h3>Работа с ролями пользователя       __________________________________________________________</h3>
    
    <span><?php echo Html::label('Назначенные роли');?>
    
   
       
    
    
    
     
  
    
    
    

  
  
  
  
  
<?php

$this->registerJs('$("#example-basic").treetable({ expandable: true });  $("#example-basic1").treetable({ expandable: true });');
?>
        
        
        
    
    
    
    <?php // echo $form->field($model, 'FD')->textInput() ?>

    <?php // echo $form->field($model, 'TD')->textInput() ?>
     

    <?php echo Html::dropDownList('one_role', $one_role, $rolesArray, ['class'=>'form-control', 'style'=>'width:500px;display:inline; margin-left:20px;', 'onChange'=>'this.form.submit();']);?>
    
        
        <?php echo Html::a(
                'Добавить роль',
                Url::base().'/usersroles/add/'.$model->user_id, 
                [
                    'title' => 'добавить роль',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help btn btn-success add',
                    'style'=>'display:inline; margin-left:20px;',
                    
                ]
            );?>
        
        <?php echo Html::a(
                'Удалить роль',
                Url::base().'/usersroles/remove/'.$model->user_id, 
                [
                    'title' => 'Удалить роль',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help btn btn-success',
                    'style'=>'display:inline; margin-left:20px;',
                ]
            );?>
        
   
    </span>
    
    <?php // echo $form->field($model, 'imageFile')->fileInput() ?>
   



 <table id="example-basic1">
        
        <thead>
          <tr>
            <th>Наименование</th>
            <th>Нет прав</th>
            <th>Только Просмотр</th>
            <th>Просмотр + Создание</th>
            <th>Просмотр + Редактирование</th>
            <th>Все права</th>
          </tr>
        </thead>
        <tbody>
           
            <?php foreach($project_tree as $key=>$project){?>
             <?php if ($project['active']==0){ }
             else{ ?>
            <tr data-tt-id='<?php echo $key;?>'>
                <td><?=$project['name'] ?></td>
                <td>
     
      </td>
       <td>
     
      </td>
      <td>
     
      </td>
      <td>
     
      </td>
      <td>
     
      </td>
    
            </tr>
             <?php }?>
            <?php foreach ($project['products']  as $keyd=>$product) {?>
            <?php if ($product['active']==0){ }
             else{ ?>
            <tr data-tt-id='<?php echo $key.'.'.$keyd;?>' data-tt-parent-id='<?php echo $key;?>'>
                <td><?=$product['name'] ?></td>
                     <td>
     
      </td>
                 <td>
     
      </td>
      <td>
     
      </td>
      <td>
     
      </td>
      <td>
     
      </td>

            </tr>
            <?php }?>
            <?php if($personal_role_id==$one_role){ ?>
            
                <?php foreach($product['modules'] as $keym=>$module) {?>
             <?php if ($module['active']==0){ }
             else{ ?>
            <tr data-tt-id='<?php echo $key.'.'.$keyd.'.'.$keym;?>' data-tt-parent-id='<?php echo $key.'.'.$keyd;?>'>
                <td><?=$module['name'] ?></td>
               <?php for($i=0; $i<5; $i++){
                   if ($i>=0){
                   echo "<td style='text-align:center;'>";
                   if($i == $module['right']) {
                      echo "<input type='radio' name='access[$keym]' checked value='$i'> ";
                   }
                       
               
               else {
                  
                      echo "<input type='radio' name='access[$keym]'  value='$i'> ";
                       
               }
               }
               echo "</td>";
               }
               ?>
              
            </tr>
             <?php }?>
            <?php  }} else {?>
            
            
            
            
            
            
             <?php foreach($product['modules'] as $keym=>$module) {?>
            <?php if ($module['active']==0){ }
             else{ ?>
            <tr data-tt-id='<?php echo $key.'.'.$keyd.'.'.$keym;?>' data-tt-parent-id='<?php echo $key.'.'.$keyd;?>'>
                <td><?=$module['name'] ?></td>
                     <td>
     
      </td>
               <?php for($i=1; $i<5; $i++){
                   echo "<td style='text-align:center;'>";
                   if($i == $module['right'])
                       echo '✔';
                       
               }
               echo "</td>";
               ?>
              
            </tr>
              <?php }?>
            <?php  }}?>
          
            <?php  }?>
          
            <?php  }?>
             <?php if($personal_role_id==Yii::$app->request->post()['one_role']){ ?>
             <tr>
                <td>
                    </td>
                    <td>
                    </td>
                <td>
                    </td>  
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            <tr>
                <td>
                   
<?php echo Html::a(
                'Добавить Проект',
                Url::base().'/usersroles/addproject/'.$model->user_id, 
                [
                    'title' => 'добавить проект',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help btn btn-success',
                    'style'=>'display:inline; margin-left:20px;',
                ]
            );?>

                    </td>
                    <td>
                    </td>  
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
            </tr>
            <tr>
                <td>
                    </td>
                <td>
                    </td>
                <td>
                    </td>  
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
           <?php  }
?>
          </tbody>
          </table>
 <div class="form-group">
    
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Сохранить', ['class' =>'btn btn-success', 'name'=>'onlysave', 'value'=>'2']) ?>
        
    </div>

            <?php ActiveForm::end(); ?>

</div>
<?php 
if (!empty($_POST) || empty($_POST) ){

    $this->registerJs("
    $('#users-phone').mask('+?999999999999');
$('body').on('change', '#users-role_id', function(event) {
  if ($('#sla-module_id')) $('#sla-module_id').empty().prop('disabled', true);
  if ($('#users-department_id')) $('#users-department_id').empty().prop('disabled', true);
  if ($('#sla-assignedto')) $('#sla-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/departmentslistall', 'Company_ID' => '']). "' + id)
  .done(function(data) {
    $('#users-department_id').html(data).prop('disabled', false);
    $('#sla-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
   
   
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});

  
function updateProjectProduct(el) {
  var up0 = $('option:selected', el).data('up');
  if (up0) $('#users-department_id').val(up0);
  var up1 = $('option:selected', '#users-department_id').data('up');
  if (up1) $('#users-role_id').val(up1);
}
$('body').on('change', '#sla-module_id', function(event) {
  updateProjectProduct(this);
});
updateProjectProduct($('#sla-module_id'));
var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).before(filefield.clone());
  $('.remove').removeClass('disabled');
});
$('form').on('click', '.remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});

$('.js-ruleslink').on('click', function(event) {
  if (event.which == 1) {
    $('body').css('cursor','wait');
    var link = this.href;
    $.ajax(link + '?1')
    .done(function(data) {
      $('#rulesModal .modal-body').html(data);
      $('#rulesModal .modal-header h2').replaceWith($('#rulesModal .modal-body h2'));
      $('#rulesModal').modal('show');
    })
    .fail(function() {
      console.log('error with ' + id);
      window.open(link);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  }
});
", $this::POS_READY, 'ajax');
}
else {
   
    $this->registerJs("
    $('#users-phone').mask('+?999999999999');
   

     $('#users-role_id').prepend( $('<option value=\"0\" selected>-</option>'))
     $('#users-department_id').empty().prop('disabled', true);
     $('#users-department_id').html('<option value=\"\">Сначала выберите компанию</option>').prop('disabled', true);
$('body').on('change', '#users-role_id', function(event) {
  if ($('#sla-module_id')) $('#sla-module_id').empty().prop('disabled', true);
  if ($('#users-department_id')) $('#users-department_id').empty().prop('disabled', true);
  if ($('#sla-assignedto')) $('#sla-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/departmentslistall', 'Company_ID' => '']). "' + id)
  .done(function(data) {
    $('#users-department_id').html(data).prop('disabled', false);
    $('#sla-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
   
   
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});


  
function updateProjectProduct(el) {
  var up0 = $('option:selected', el).data('up');
  if (up0) $('#users-department_id').val(up0);
  var up1 = $('option:selected', '#users-department_id').data('up');
  if (up1) $('#users-role_id').val(up1);
}
$('body').on('change', '#sla-module_id', function(event) {
  updateProjectProduct(this);
});
updateProjectProduct($('#sla-module_id'));
var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).before(filefield.clone());
  $('.remove').removeClass('disabled');
});
$('form').on('click', '.remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});

var myPlaceholder = 'Введите имя получателя или выберите из списка';
var myPlaceholders = { w1: true, w2: true }
var isIE10 = !!navigator.userAgent.match(/MSIE 10/i);
var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);

if (isIE11 || isIE10) {
  $('#w1, #w2').select2({ multiple: true, placeholder: '', language: 'ru' });
  $('.select2-search__field').after('<span class=\'ersatz-placeholder\'>'+myPlaceholder+'</span>');

  $('body').on('blur', '.select2-search__field', function(e) {
    var select2 = $(e.target).closest('.select2');
    if (!myPlaceholders[select2.prev().attr('id')]) return;
    if ($('.select2-selection__choice', select2).length == 0 && $('.ersatz-placeholder', select2).length == 0) {
      $(e.target).after('<span class=\'ersatz-placeholder\'>'+myPlaceholder+'</span>');
    }
  });

  $('body').on('focus', '.select2-search__field', function(e) {
    var select2 = $(e.target).closest('.select2');
    if (!myPlaceholders[select2.prev().attr('id')]) return;
    $('.ersatz-placeholder', select2).remove();
  });
}
$('.js-ruleslink').on('click', function(event) {
  if (event.which == 1) {
    $('body').css('cursor','wait');
    var link = this.href;
    $.ajax(link + '?1')
    .done(function(data) {
      $('#rulesModal .modal-body').html(data);
      $('#rulesModal .modal-header h2').replaceWith($('#rulesModal .modal-body h2'));
      $('#rulesModal').modal('show');
    })
    .fail(function() {
      console.log('error with ' + id);
      window.open(link);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  }
});
", $this::POS_READY, 'ajax');

}
?>
<?php
    $this->registerJs("


$('.js-ruleslink').on('click', function(event) {
 
  if (event.which == 1) {
    $('body').css('cursor','wait');
    var link = this.href;
    $.ajax(link + '?1')
    .done(function(data) {
      $('#rulesModal .modal-body').html(data);
      $('#rulesModal .modal-header h2').replaceWith($('#rulesModal .modal-body h2'));
      $('#rulesModal').modal('show');
    })
    .fail(function() {
     
      window.open(link);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  }
});
  


  ", $this::POS_READY, '');?>

    
    <?php
    if ($model->getAttribute('username')==''){
    $this->registerJs("
  


$('#users-role_id').prepend( $('<option value=\"0\" selected>-</option>'))
     $('#users-department_id').empty().prop('disabled', true);
     $('#users-department_id').html('<option value=\"\">Сначала выберите компанию</option>').prop('disabled', true);


  ", $this::POS_READY, '');
    } ?>

<?php 
Modal::begin([
    'id' => 'rulesModal',
    'header' => '<h2 id="modal-header"></h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
]);
Modal::end();

?>
  