<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Periods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="period-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Period', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Period_ID',
            'Ticket_ID',
            'Year',
            'Month',
            'Week',
            // 'Weekday',
            // 'Day_Month',
            // 'time',
            // 'Month_check',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
