<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'Company_ID')->dropDownList(ArrayHelper::map(\app\models\Companies::find()->all(), 'Company_ID', 'Name' ))->label('Компания') ?>

    <?= $form->field($model, 'IsSubdivisionOf')->dropDownList(ArrayHelper::map(\app\models\Departments::find()->all(), 'Department_ID', 'Name' ))->label('Головной Отдел') ?> 

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->label('Название отдела') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
if (!empty($_POST)){

    $this->registerJs("
    $('#users-phone').mask('+?999999999999');
$('body').on('change', '#departments-company_id', function(event) {
  if ($('#sla-module_id')) $('#sla-module_id').empty().prop('disabled', true);
  if ($('#departments-issubdivisionof')) $('#departments-issubdivisionof').empty().prop('disabled', true);
  if ($('#sla-assignedto')) $('#sla-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/departmentslistall', 'Company_ID' => '']). "' + id)
  .done(function(data) {
    $('#departments-issubdivisionof').html(data).prop('disabled', false);
    $('#sla-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
   
   
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});

  
function updateProjectProduct(el) {
  var up0 = $('option:selected', el).data('up');
  if (up0) $('#depatments-issubdivisionof').val(up0);
  var up1 = $('option:selected', '#departments-issubdivisionof').data('up');
  if (up1) $('#departments-company_id').val(up1);
}
$('body').on('change', '#sla-module_id', function(event) {
  updateProjectProduct(this);
});
updateProjectProduct($('#sla-module_id'));
var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).before(filefield.clone());
  $('.remove').removeClass('disabled');
});
$('form').on('click', '.remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});

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
      console.log('error with ' + id);
      window.open(link);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  }
});
", $this::POS_READY, 'ajax');
}
else {
   
    $this->registerJs("
    $('#users-phone').mask('+?999999999999');
   

     $('#departments-company_id').prepend( $('<option value=\"0\" selected>-</option>'))
     $('#departments-issubdivisionof').empty().prop('disabled', true);
     $('#departments-issubdivisionof').html('<option value=\"\">Сначала выберите компанию</option>').prop('disabled', true);
$('body').on('change', '#departments-company_id', function(event) {
  if ($('#sla-module_id')) $('#sla-module_id').empty().prop('disabled', true);
  if ($('#departments-issubdivisionof')) $('#departments-issubdivisionof').empty().prop('disabled', true);
  if ($('#sla-assignedto')) $('#sla-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/departmentslistall', 'Company_ID' => '']). "' + id)
  .done(function(data) {
    $('#departments-issubdivisionof').html(data).prop('disabled', false);
    $('#sla-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
   
   
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});


  
function updateProjectProduct(el) {
  var up0 = $('option:selected', el).data('up');
  if (up0) $('#depatments-issubdivisionof').val(up0);
  var up1 = $('option:selected', '#depatments-issubdivisionof').data('up');
  if (up1) $('#departments-company_id').val(up1);
}
$('body').on('change', '#sla-module_id', function(event) {
  updateProjectProduct(this);
});
updateProjectProduct($('#sla-module_id'));
var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).before(filefield.clone());
  $('.remove').removeClass('disabled');
});
$('form').on('click', '.remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});

var myPlaceholder = 'Введите имя получателя или выберите из списка';
var myPlaceholders = { w1: true, w2: true }
var isIE10 = !!navigator.userAgent.match(/MSIE 10/i);
var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);

if (isIE11 || isIE10) {
  $('#w1, #w2').select2({ multiple: true, placeholder: '', language: 'ru' });
  $('.select2-search__field').after('<span class=\'ersatz-placeholder\'>'+myPlaceholder+'</span>');

  $('body').on('blur', '.select2-search__field', function(e) {
    var select2 = $(e.target).closest('.select2');
    if (!myPlaceholders[select2.prev().attr('id')]) return;
    if ($('.select2-selection__choice', select2).length == 0 && $('.ersatz-placeholder', select2).length == 0) {
      $(e.target).after('<span class=\'ersatz-placeholder\'>'+myPlaceholder+'</span>');
    }
  });

  $('body').on('focus', '.select2-search__field', function(e) {
    var select2 = $(e.target).closest('.select2');
    if (!myPlaceholders[select2.prev().attr('id')]) return;
    $('.ersatz-placeholder', select2).remove();
  });
}
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
      console.log('error with ' + id);
      window.open(link);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  }
});
", $this::POS_READY, 'ajax');

}
?>