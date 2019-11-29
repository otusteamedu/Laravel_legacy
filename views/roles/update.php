<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Изменение роли: ' . ' ' . $model->Name;

?>

<div class="roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
        'projects_tree'     =>$projects_tree,

    ]) ?>

</div>
