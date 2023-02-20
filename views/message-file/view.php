<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MessageFile */

$this->title = $model->File_ID;
$this->params['breadcrumbs'][] = ['label' => 'Message Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->File_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->File_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'File_ID',
            'Path',
            'Message_ID',
        ],
    ]) ?>

</div>
