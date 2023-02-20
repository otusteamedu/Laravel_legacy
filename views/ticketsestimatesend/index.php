<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketsestimatesendQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticketsestimatesends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticketsestimatesend-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ticketsestimatesend', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Ticket_ID',
            'esttime',
            'last_send',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
