<?php
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
 ActiveForm::begin([
                                      'method' => 'post',
                                      'action' => ["users/sendpassword"],
                                  ]);
             echo Html::label($error_message);
              echo "<br>";
              echo Html::label('Введите e-mail или логин');
              echo "<br>";
              echo Html::textInput('mail', '', ['style'=>'width:500px;']);
              echo "<br>"; echo "<br>";
              echo "<p>";
              echo Html::submitButton($model->isNewRecord ? 'Create' : 'Выслать пароль', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'email', 'value'=>'1']);
              echo "</p>"; ?>
              <input type='hidden' name='id' value="<?php echo  $model->id; ?>" <?php;
              ActiveForm::end();

?>


