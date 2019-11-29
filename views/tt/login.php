<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Авторизация';

?>

<p style='color:red'><?php echo $message;?></p>
    <div class="site-login row">
    <h2 class="col-md-offset-2 col-md-10"><?= Html::encode($this->title) ?></h2>



    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-3\">{input}</div>\n<div class=\"col-md-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-md-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->label('Имя пользователя:') ?>

    <?= $form->field($model, 'password')->passwordInput()->label('Пароль :') ?> 
 
    <?php echo Html::a(
                'Забыли пароль?',
                Url::base().'/users/sendpassword', 
                [
                    'title' => 'Забыли пароль?',
                    'data-pjax' => '0',
                    'class' => 'js-ruleslink help ',
                    'style'=>'display:inline; margin-left:20px;',
                ]
            );?>
   

    <div class="form-group row">
        <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

   
</div>
<div style="margin-top:100px;">
 <?php echo  Html::a('Регистрация нового пользователя (шаблон)', '@web/uploads/Регистрация нового пользователя (шаблон).docx');?>
</div>
<?php
$this->registerJs("
  
$('.js-ruleslink').on('click', function(event) {
  if (event.which == 1) {
    $('body').css('cursor','wait');
    var link = this.href;
    $.ajax(link + '?1')
    .done(function(data) {
      $('#rulesModal .modal-body').html(data);
      $('#rulesModal .modal-header h2').replaceWith($('#rulesModal .modal-body h2'));
      $('#rulesModal').modal('show');
    })
    .fail(function() {
     
      window.open(link);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  }
});
  


  ", $this::POS_READY, 'tree');?>


<?php 
Modal::begin([
    'id' => 'rulesModal',
    'header' => '<h2 id="modal-header"></h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
]);
Modal::end();

?>