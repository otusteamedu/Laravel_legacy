<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MessageFile */

$this->title = 'Create Message File';
$this->params['breadcrumbs'][] = ['label' => 'Message Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
