<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Departments */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Создание Департамента';
?>
<div class="departments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'a' =>$a,
    ]) ?>

</div>
