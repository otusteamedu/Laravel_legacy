<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->context->layout = 'index-main';

$this->title = $model->name;

?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

<div class="users-view-panel">

<div class="img-group">
<?php if ($model->imageFile!='') {
  echo Html::img("@web/uploads/photos/$model->imageFile", ['class' => 'img-group-avatar']);
}
else {
  echo Html::img("@web/uploads/photos/no.png", ['width'=>'200', 'height'=>'200']);
}
?>
</div>
  
<div class="users-view-item">
    <table class="table table-striped table-bordered detail-view"><tr><th>Имя</th><td><?=$model->name;?></td></tr>
<tr><th>Email</th><td><a href="mailto:<?=$model->email;?>"><?=$model->email;?></a></td></tr>
<tr><th>Телефон</th><td><?=$model->phone;?></td></tr>
<tr><th>Компания</th><td><?=$company_name;?></td></tr>
<tr><th>Отдел</th><td><?=$department_name;?></td></tr>
<tr><th>Должность</th><td><?=$model->position;?></td></tr></table>
</div>

</div>

</div>
<?php
$this->registerCss("
.users-view-panel { display: flex; width: 100%; }
.users-view-item { margin-left: 40px; flex: 1 1 auto; }
.img-group { width: 200px; height: 200px; position: relative; margin-bottom: 1em; }
.img-group-avatar { position: absolute; max-width: 200px; max-height: 200px; top: 0; right: 0; bottom: 0; left: 0; margin: auto; }
");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

