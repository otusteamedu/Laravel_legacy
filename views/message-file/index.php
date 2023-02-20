<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Message Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Message File', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'File_ID',
            'Path',
            'Message_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
