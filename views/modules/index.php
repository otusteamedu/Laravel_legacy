<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModulesQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подсистемы/Услуги';

?>
<div style='width:500px;'>
<div class="modules-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать подсистему/услугу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Module_ID',
            'Name',
            'Product_ID',
            'product.Name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
    </div>
