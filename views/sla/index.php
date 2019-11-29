<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SlaQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Sla';

?>

<div class="sla-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать SLA', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'project_id',
            //'product_id',
            //'module_id',
            //'priority_id',
            'project.Name',
            'product.Name',
            'module.Name',
            'type.Name',
            'priority.Name',
            'status.Name',
            // 'status_id',
             'sla',
             'interval',
            // 'last_send',
             'message:ntext',
             'active',
            // 'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
