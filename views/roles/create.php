<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Roles */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Создание Роли';

?>

<div class="roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create_form', [
        'projects_tree' => $projects_tree,
        'model'=>$model,

    ]) ?>

</div>
