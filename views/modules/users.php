<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = "Пользователи связанные с данным модулем";
?>
<div style='width:500px;'>
<div class="projects-view">

    <h3><?= Html::encode($this->title) ?></h3>

  <table border="1">
   <?php foreach ($ar_users as $key=>$value){?>
    
        <tr>
    <td><a href='<?php echo Url::base(); ?>/users/update/<?php echo $key;?>'><?php echo $value['name']; ?></a></td>  
    <td><?php echo $value['company_name']; ?></td> 
    <td><?php echo $value['position']; ?></td> 
    
    </tr>
    
   <?php 
   } 
?>
    
</table>
    

</div>
    </div>
<?php $this->registerCss("td {padding:5px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 11px;} "
        . "");
