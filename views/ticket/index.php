<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Version_ID',
            'Ticket_ID',
            'Author',
            'AssignedTo',
            // 'Module_ID',
            // 'Category_ID',
            // 'Type_ID',
            // 'Priority_ID',
            // 'HighPriorityReason:ntext',
            // 'Status_ID',
            // 'Subject',
            // 'FD',
            // 'TD',
            // 'DependsOn',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
