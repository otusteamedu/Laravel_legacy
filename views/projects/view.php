<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = $model->Name;
?>
<div style='width:500px;'>
<div class="projects-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Project_ID',
            'Name',
            'Description:ntext',
        ],
    ]) ?>

</div>
    </div>
