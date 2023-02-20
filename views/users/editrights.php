<?php
use yii\helpers\Html;


$this->beginContent('@app/views/layouts/admin.php'); 

$this->endContent(); 
$this->title = 'Пользователи - Редактирование прав';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
   
    <?= $this->render('_form_editrights', [
        'model' => $model,
        'model1' => $model1,
        'rolesArray'=>$rolesArray,
        'roles_this_user' =>$roles_this_user,
        'project_tree'=> $project_tree,
        'a'=>$a,
    ]) ?>

</div>