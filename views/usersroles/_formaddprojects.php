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
  <table border="1" width="100%">  
    <?php
   
    foreach ($projectsArray as $key=>$value){?>
        <tr>
            <td><?php  echo $value;?> </td>
            <td><input type='checkbox' name="projects[<?php echo $key;?>]"></td>
        </tr>
  <?php  }
    ?>
</table>


    <input type="hidden" name='one_role' value="<?php echo $personal_role_id; ?>">

    <div class="form-group">
        <br>
        <?= Html::submitButton($model->isNewRecord ? 'Добавить проекты' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerCss("td {padding:5px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 11px;} "
        . "");