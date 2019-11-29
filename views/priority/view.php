<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Priority */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Priorities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priority-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Priority_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Priority_ID], [
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
            'Priority_ID',
            'Name',
        ],
    ]) ?>

</div>
