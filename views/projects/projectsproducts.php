<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
 $this->title = 'Проекты Продукты Подсистемы';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <div class="form-group">
      <?= Html::a("Создать Проект",  Url::base().'/projects/create/', ['class' => 'btn btn-success js-ruleslink help'])?>
 
    </div>
<div class="companies-create">
    
    
    
    
    
    
    
     <table id="example-basic1">
        
        <thead>
          <tr>
            <th>Наименование</th>
            <th>Просмотр</th>
            
          </tr>
        </thead>
        <tbody>
            
            <?php foreach($projects_tree as $key=>$project){?>
            <tr data-tt-id='<?php echo $key;?>' <?php if ($project['active']==0){?> style='color:#ccc' <?php };?>>
                <td><?=$project['name'] ?></td>
                <td>
      <span>
      <?php echo Html::a(
                '',
                Url::base().'/projects/update/'.$key, 
                [
                    'title' => 'редактировать',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help glyphicon glyphicon-pencil',
                ]
            );?></span>
      <span>
      <?php echo Html::a(
                '<img style="margin-right:10px;" src='.Url::base().'/img/user1.png>',
                Url::base().'/projects/users/'.$key, 
                [
                    'title' => 'просмотр',
                    'data-pjax' => '0',
                    'class'=>"js-ruleslink help glyphicon ",
                ]
            );?></span>
      </td>
            </tr>
            
            <?php foreach ($project['products']  as $keyd=>$product) {?>
            <tr data-tt-id='<?php echo $key.'.'.$keyd;?>' data-tt-parent-id='<?php echo $key;?>'  <?php if ($product['active']==0){?> style='color:#ccc' <?php };?>>
                <td><?=$product['name'] ?></td>
                <td>
      <span>
      <?php echo Html::a(
                '',
                Url::base().'/products/update/'.$keyd.'?project_name='.$project['name'].'&project='.$key.'&', 
                [
                    'title' => 'редактировать',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help glyphicon glyphicon-pencil',
                ]
            );?></span>
      <span>
      <?php echo Html::a(
                '<img style="margin-right:10px;" src='.Url::base().'/img/user1.png>',
                Url::base().'/products/users/'.$keyd, 
                [
                    'title' => 'просмотр',
                    'data-pjax' => '0',
                    'class'=>"js-ruleslink help glyphicon ",
                ]
            );?></span>
      </td>
            </tr>
            
             <?php foreach($product['modules'] as $keym=>$module) {?>
            
            <tr data-tt-id='<?php echo $key.'.'.$keyd.'.'.$keym;?>' data-tt-parent-id='<?php echo $key.'.'.$keyd;?>'  <?php if ($module['active']==0){?> style='color:#ccc' <?php };?>>
                <td><?=$module['name'] ?></td>
                <td>
      <span>
      <?php echo Html::a(
                '',
                Url::base().'/modules/update/'.$keym.'?product='.$keyd.'&product_name='.$product['name'].'&project='.$key.'&project_name='.$project['name'].'&', 
                [
                    'title' => 'редактировать',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help glyphicon glyphicon-pencil',
                ]
            );?></span>
      <span>
      <?php echo Html::a(
                '<img style="margin-right:10px;" src='.Url::base().'/img/user1.png>',
                Url::base().'/modules/users/'.$keym, 
                [
                    'title' => 'просмотр',
                    'data-pjax' => '0',
                    'class'=>"js-ruleslink help glyphicon ",
                ]
            );?></span>
        </td>
            </tr>
            
            <?php  }?>
            <tr data-tt-id='<?php echo $key.'.'.$keyd.'.m';?>' data-tt-parent-id='<?php echo $key.'.'.$keyd;?>'>
                <td>
                        <?php echo Html::a(
                '<span style="color:#5cb85c; margin-left:-20px; font-weight: 600;">Создать новую подсистему</span>',
                Url::base().'/modules/create/?product='.$keyd.'&product_name='.$product['name'].'&project='.$key.'&project_name='.$project['name'].'&', 
                [
                    'title' => 'Создать',
                    'data-pjax' => '0',
                    'class'=>"js-ruleslink help",
                ]
            );?>
                        
                        
                        </td>
                <td></td>
                </tr>
            <?php  }?>
            <tr data-tt-id='<?php echo $key.'.'.$keyd.'.p'?>' data-tt-parent-id='<?php echo $key?>'>
                <td>
                     <?php echo Html::a(
                '<span style="color:#5cb85c; margin-left:-20px; font-weight: 600;">Создать новый продукт</span>',
                Url::base().'/products/create/?project='.$key.'&project_name='.$project['name'].'&', 
                [
                    'title' => 'создать',
                    'data-pjax' => '0',
                    'class'=>"js-ruleslink help",
                ]
            );?>
                </td>
                <td></td>
                </tr>
            <?php  }?>
          </tbody>
          </table>
    
    
    
     
  
    
    
    

  
  
  
  
  
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


