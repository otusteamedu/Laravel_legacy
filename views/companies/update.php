<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Изменение компании: ' . ' ' . $model->Name;
?>
<div class="companies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
