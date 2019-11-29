<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ticketsestimatesend */

$this->title = 'Create Ticketsestimatesend';
$this->params['breadcrumbs'][] = ['label' => 'Ticketsestimatesends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticketsestimatesend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
