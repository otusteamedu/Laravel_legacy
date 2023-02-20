<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Projects */
//$this->beginContent('@app/views/layouts/admin.php'); 

 //$this->endContent(); 
$this->title = 'Создание проекта';

?>
<div style='width:500px;'>
<div class="projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
