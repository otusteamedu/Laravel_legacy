<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Users */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Создание пользователя';

?>

<div class="users-create">
    
   
    <h3><?= Html::encode($this->title) ?>    ______________________________________________________________________________</h3>
 
    <?= $this->render('_form_create', [
        'model' => $model,
        'rolesArray'=>$rolesArray,
        'roles_this_user' =>$roles_this_user,
        'project_tree'=>$project_tree,
        'personal_role_id'=>$personal_role_id,
        'one_role'=>$one_role,
    ]) ?>

</div>
