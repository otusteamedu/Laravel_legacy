<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolesQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Роли';
?>

<div class="roles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать роль', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Role_ID',
            'Name',
            'Description',
           
               
            [
    'class' => 'yii\grid\ActionColumn',
    'template' => '  {update} {delete} ' ,
    'buttons' => [
        'update' => function ($i, $data, $k) {
            return Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>',
                Url::base().'/roles/update/'.$data['Role_ID'], 
                [
                    'title' => 'Update',
                    'data-pjax' => '0',
                ]
            );
        },        
             
    ],
],
            
        ],
    ]); ?>

</div>
