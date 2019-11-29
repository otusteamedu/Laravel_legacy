<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Type_Task',
            'Date_Time',
            'Ticket_ID',
            'Status',
            // 'Params:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
