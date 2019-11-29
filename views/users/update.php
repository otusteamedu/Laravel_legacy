<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
if($_SESSION['first_edit']!=1){
$this->title = $model->name;
}
 
?>

 

<div class="users-update">

    <h3><?= Html::encode($this->title) ?>    ______________________________________________________________________________</h3>
 
    <?= $this->render('_form', [
        'model' => $model,
        'rolesArray'=>$rolesArray,
        'roles_this_user' =>$roles_this_user,
        'project_tree'=>$project_tree,
        'personal_role_id'=>$personal_role_id,
        'one_role'=>$one_role,
    ]) ?>

</div>
