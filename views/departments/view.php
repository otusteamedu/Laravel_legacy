<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = $model->Name;

?>

<div class="departments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Department_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Department_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table class="table table-striped table-bordered detail-view">
        <tr><th>ID Отдела</th><td><?=$model->Department_ID;?></td></tr>
        <tr><th>Компания</th><td><?=$company_name;?></td></tr>
        <tr><th>Головной Отдел</th><td><?=$name_sub_dep;?></td></tr>
        <tr><th>Отдел</th><td><?=$model->Name;?></td></tr>


    </table>
</div>
    
    
   

</div>
