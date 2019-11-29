<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = $model->name;

?>

<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>
 <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>
  
 
<div class="users-view">


  

    <table class="table table-striped table-bordered detail-view">
        <tr><th>User_ID</th><td><?=$model->user_id;?></td></tr>
        <tr><th>Имя</th><td><?=$model->name;?></td></tr>
<tr><th>Email</th><td><a href="mailto:<?=$model->email;?>"><?=$model->email;?></a></td></tr>
<tr><th>Телефон</th><td><?=$model->phone;?></td></tr>
<tr><th>Компания</th><td><?=$company_name;?></td></tr>
<tr><th>Отдел</th><td><?=$department_name;?></td></tr>
<tr><th>Должность</th><td><?=$model->position;?></td></tr></table>
</div>
    
   
     <h3>Доступные пользователю роли</h3>
    <?php
          foreach ($rolesArray as $key=>$value){
        
             
              if (in_array($key, $roles_this_user)){
               echo "<span>".Html::label("$value")."</span>,  "; 
              }
              
          }
    ?>
</div>




<h3>Права доступа к подсистемам</h3>
<ul class="project-table">
  <li class="module-row module-title">
    <span>Наименование проекта</span>
    <span>Только просмотр</span>
    <span>Просмотр + редактирование</span>
    <span>Просмотр + создание</span>
    <span>Все права</span>
  </li>
<?php

$n = 1;
foreach ($project_tree as $project) {
  ?><li class="project-row" data-toggle="group<?=$n ?>"><span><?=$project['name'] ?></span></li><?php
  foreach ($project['products'] as $product) {
    ?><li class="product-row group<?=$n ?>"><span><?=$product['name'] ?></span></li><ul class="module-group group<?=$n ?>"><?php
    foreach($product['modules'] as $module) {
      ?><li class="module-row"><span class="module-name"><?=$module['name'] ?></span><?php
        for ($i = 1; $i <= 4; $i++) {
          ?><span class="module-right"><?=($i == $module['right'] ? '✔' : ' ') ?></span><?php
        }
      ?></li><?php
    }
    ?></ul><?php
  }
  $n++;
}

?></ul><?php
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
");
$this->registerJs("
  $('.product-row, .module-group').hide();
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
  ", $this::POS_READY, 'tree');
?>
