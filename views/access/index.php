<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccessQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доступы';
$this->params['breadcrumbs'][] = $this->title;
?><?= $this->render('_admin');?>
<div class="access-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать доступ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Role_id',
            'Module_ID',
            'Level_Rights',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
