<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\sla */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = $model->id;

?>

<div class="sla-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    
    <div class="users-view">


  

    <table class="table table-striped table-bordered detail-view"><tr><th>ID</th><td><?=$model->id;?></td></tr>
<tr><th>Проект</th><td><?=$project_name;?></td></tr>
<tr><th>Продукт</th><td><?=$product_name;?></td></tr>
<tr><th>Подсистема</th><td><?=$module_name;?></td></tr>
<tr><th>Критичность</th><td><?=$priority_name;?></td></tr>
<tr><th>Cтатус</th><td><?=$status_name;?></td></tr>
<tr><th>Тип</th><td><?=$type_name;?></td></tr> 
<tr><th>SLA( минуты)</th><td><?=$model->sla;?></td></tr>
<tr><th>Интервал (минуты)</th><td><?=$model->interval;?></td></tr>
<tr><th>last_send</th><td><?=$model->last_send;?></td></tr>
<tr><th>Сообщение</th><td><?=$model->message;?></td></tr>   
<tr><th>Активен\Неактивен</th><td><?=$active_string;?></td></tr> 

    </table>
</div>
    
    

</div>
