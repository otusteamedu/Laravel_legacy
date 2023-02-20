
<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

if (isset($_POST['emails'])){
    foreach ($_POST['emails'] as $key=>$value){     
        $to=" ".$key." ,";
        mail($to, '=?UTF-8?B?'.base64_encode($_POST['theme']).'?=', $_POST['message'], "Content-type: text/plain; charset=utf-8"); 
    }
  
}
//echo $to;
$n = 1;
$k = 1; ?>



    <div class="row">
        <div class="col-md-6 prokrutka">
            
            <?php
foreach ($companies_tree as $company) {
  ?><li class="project-row"  data-toggle="group<?=$n ?>"><span><?=$company['name'] ?></span></li><span class='prospan' style=' margin-top: -20px; margin-left: -200px; position: relative; float :right;'> <?php echo Html::label("");echo Html::checkbox('company', false, ['id'=>'divid', 'class'=>'company'.$n, 'onclick'=>"if($('.company$n').prop('checked')==true){ $('.use$n, .dep$n').prop('checked', true);} else { $('.use$n, .dep$n').prop('checked', false);}"]);?></span><?php
  foreach ($company['departments'] as $department) {
    ?><li class="product-row  group<?=$n ?>" data-toggle="group<?=$k ?>"><span><?=$department['name'] ?></span><span class='prospan'> <?php echo Html::label("");echo Html::checkbox('department', false, ['id'=>'divid', 'class'=>'dep'.$n.' department'.$k, 'onclick'=>"if($('.department$k').prop('checked')==true){ $('.users$k').prop('checked', true).stopPropagation();} else { $('.users$k').prop('checked', false).stopPropagation();}"]);?></span></li><ul class="module-group group<?=$n ?>"><?php
    foreach($department['users'] as $user) {
      ?><li class="module-row  group<?=$k ?>"><span class="module-name"><?=$user['name'] ?></span><span> <?php echo Html::label("");echo Html::checkbox("emails[".$user['email']."]", false, ['class'=>'use'.$n. ' users'.$k]);?></span><?php
       
      ?></li><?php
    }
    ?></ul><?php
    $k++;
  }
  $n++;
}

?></ul>
        </div>
        <div class="col-md-6"><div>Введите тему письма:</div><div><input type='text' name='theme' style='width:700px;'></div><br><div>Введите текст сообщения <br><textarea class='area' name='message'></textarea></div>  <div class='message'>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Отправить сообщение', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>
  
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


    <?php ActiveForm::end(); ?>


