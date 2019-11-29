<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Пользователи';


?>

<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'user_id',
            
            'username',
            //'name',
            'surname',
            //'department.company.Name',
           //  'department.Name',
            'position',
            //'password',
             'email:email',
             'phone',
            // 'department_id',
             'company',
            'department',
            // 'role_id',
            // 'additionalData',
            // 'FD',
            // 'TD',
           
            
            'status',
           
            [
    'class' => 'yii\grid\ActionColumn',
    'template' => '  {update} ',
    'buttons' => [
        'update' => function ($i, $data, $k) {
            return Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>',
                Url::base().'/users/update/'.$data['id'], 
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
