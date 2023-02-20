<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\UsersRoles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-roles-form">
        <?php $form = ActiveForm::begin(); ?>
  <table border="1">  
    <?php
    foreach ($rolesArray as $key=>$value){?>
        <tr>
            <td><?php  echo $value;?> </td>
            <td><input type='checkbox' name="roles[<?php echo $key;?>]"></td>
        </tr>
  <?php  }
    ?>
</table>


   

    <div class="form-group">
        <br>
        <?= Html::submitButton($model->isNewRecord ? 'Удалить роли' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerCss("td {padding:5px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 11px;} "
        . "");