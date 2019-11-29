<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
 $this->title = 'Компании и Отделы';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
 <div class="form-group">
      <?= Html::a("Создать Компанию",  Url::base().'/companies/create/', ['class' => 'btn btn-success'])?>
      <?= Html::a("Создать Отдел",  Url::base().'/departments/create/', ['class' => 'btn btn-success'])?>
    </div>
<div class="companies-create">

    <h1><?= Html::encode($this->title) ?></h1>
    

    
            
            <?php
foreach ($companies_tree as $key=>$company) {
  ?><li class="project-row"  data-toggle="group<?=$n ?>"><span><?=$company['name'] ?></span></li><span class='prospan' style=' margin-top: -20px; margin-left: -200px; position: relative; float :right;'><?php echo Html::a(
                '<span class="glyphicon glyphicon-eye-open"></span>',
                Url::base().'/companies/'.$key, 
                [
                    'title' => 'view',
                    'data-pjax' => '0',
                ]
            );?>
      <?php echo Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>',
                Url::base().'/companies/update/'.$key, 
                [
                    'title' => 'view',
                    'data-pjax' => '0',
                ]
            );?>
  </span><?php
  foreach ($company['departments'] as $keyd=>$department) {
    ?><li class="product-row  group<?=$n ?>" data-toggle="group<?=$k ?>"><span><?=$department['name'] ?></span><span class='prospan' style='margin-left:20px;'><?php echo Html::a(
                '<span class="glyphicon glyphicon-eye-open"></span>',
                Url::base().'/departments/'.$keyd, 
                [
                    'title' => 'view',
                    'data-pjax' => '0',
                ]
            );?>
           <?php echo Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>',
                Url::base().'/departments/update/'.$keyd, 
                [
                    'title' => 'view',
                    'data-pjax' => '0',
                ]
            );?>
      </span></li><ul class="module-group group<?=$n ?>"><?php
      
      foreach ($department['departments_level'] as $keydl=>$departmentdl) {
        ?>  
         <p class="group<?=$n ?>" data-toggle="group<?=$k ?>"><b><span style='margin-left:90px;'><?=$departmentdl['name'] ?></span></b><span class='prospan' style='margin-left:20px;'><?php echo Html::a(
                '<span class="glyphicon glyphicon-eye-open"></span>',
                Url::base().'/departments/'.$keydl, 
                [
                    'title' => 'view',
                    'data-pjax' => '0',
                ]
            );?>
           <?php echo Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>',
                Url::base().'/departments/update/'.$keydl, 
                [
                    'title' => 'view',
                    'data-pjax' => '0',
                ]
            );?>
      </span></p>
  <?php       
      }
      
      
   
    ?></ul><?php
    $k++;
  }
  $n++;
}

?>
        </div>

 <?php
$this->registerCss("
.users-view-panel { display: flex; width: 100%; }
.users-view-item { margin-left: 40px; flex: 1 1 auto; }
.img-group { width: 200px; height: 200px; position: relative; margin-bottom: 1em; }
.img-group-avatar { position: absolute; max-width: 200px; max-height: 200px; top: 0; right: 0; bottom: 0; left: 0; margin: auto; }
.module-title span { vertical-align: middle; text-align: center; min-width: 5em; padding: 0 .5em; }
.project-table { display: table; width: 100%; border-collapse: collapse; border: 1px solid #ddd; border-width: 0 1px 1px; position: relative; }
.project-table::before { content: ''; position: absolute; top: 0; right: 0; bottom: 0; left: 0; border: 1px solid #ddd; z-index: -1; }
:-webkit-any(u), .project-table::before { right: -1px; bottom: -1px; }
.module-group { display: table-row-group; }
.project-row, .product-row { display: table-row-group; font-weight: bold; white-space: nowrap; cursor: pointer; }
.project-row { font-size: 1.1em; }
.project-row span, .product-row span { display: inline-block; white-space: normal; vertical-align: top; padding: .5em 0 .2em; }
.project-row::before { padding-left: 10px; }
.product-row::before { padding-left: 25px; }
.project-row::before, .product-row::before { display: inline-block; content: '▼'; padding-right: .5em; vertical-align: top; padding-top: .5em; }
.group-closed::before { content: '►'; padding-right: .5em; }
.module-row { display: table-row; }
.module-row:nth-of-type(odd) { background: #f9f9f9; }
.module-row span { display: table-cell; border: 1px solid #ddd; }
.module-name { padding-left: 40px; }
.module-right { font-weight: bold; text-align: center; }
.message {margin-top:100px;}
.area {width:700px; height:500px;}
.prokrutka {overflow-y: scroll; height:750px; /* высота нашего блока *//* прокрутка по вертикали */}
");
$this->registerJs("
  $('.product-row, .module-group').hide();
 // $('.prospan').click(function(){alert('Вы нажали один раз на первую кнопку!');});
  //$('.project-row span, .product-row span').width('calc(80% + ' + ($('.project-table').width() - $('.module-name').width()) + 'px)');
  $('.product-row').click(function(e) {
   $(this).next().toggle();
   $(this).toggleClass('group-closed');
  });
  $('.project-row').addClass('group-closed').click(function(e) {
    var gr = $(this).attr('data-toggle');
    $(this).toggleClass('group-closed');
    $(this).hasClass('group-closed') ? $('.'+gr).hide() : $('.'+gr).show();

  });
  


  ", $this::POS_READY, 'tree');?>
