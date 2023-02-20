<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты/Наборы услуг';

?>
<div style='width:500px;'>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Product_ID',
            'Name',
            'Project_ID',
            'project.Name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>