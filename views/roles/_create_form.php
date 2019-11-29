<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

    
    <div class="roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->label('Название Роли') ?>
     <?= $form->field($model, 'Description')->textInput(['maxlength' => true])->label('Описание  Роли') ?>
    

</div>
    
    
    
    
    
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
           
            <?php foreach($projects_tree as $key=>$project){?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  
  
  
  
  
<?php

$this->registerJs('$("#example-basic").treetable({ expandable: true });  $("#example-basic1").treetable({ expandable: true });');
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
  


  ", $this::POS_READY, 'tree');?>


<?php 
Modal::begin([
    'id' => 'rulesModal',
    'header' => '<h2 id="modal-header"></h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
]);
Modal::end();

?>


