<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Messages */

$this->title = 'Изменение запроса: ' . ' ' . $model->Message_ID;
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Message_ID, 'url' => ['view', 'id' => $model->Message_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
