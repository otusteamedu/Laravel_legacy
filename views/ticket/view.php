<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */

$this->title = $model->Version_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Version_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Version_ID], [
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
            'Version_ID',
            'Ticket_ID',
            'Author',
            'AssignedTo',
            'Module_ID',
            'Category_ID',
            'Type_ID',
            'Priority_ID',
            'HighPriorityReason:ntext',
            'Status_ID',
            'Subject',
            'FD',
            'TD',
            'DependsOn',
        ],
    ]) ?>

</div>
