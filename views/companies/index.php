<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompaniesQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Компании';
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать компанию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Company_ID',
            'Name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
