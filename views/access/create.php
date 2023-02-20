<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Access */

$this->title = 'Создание права доступа';
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
<?= $this->render('_admin');?>
?>
<div class="access-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_admin');?>
    <?= $this->render('_form', [
        'model' => $model,
        'a' =>$a,
        'a1'=>$a1,
    ]) ?>

</div>
