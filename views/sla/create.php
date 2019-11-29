<?php

use yii\helpers\Html;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\sla */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = 'Создание SLA';

?>
<div class="sla-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php 
 $this->registerJs("
$('body').on('change', '#sla-project_id', function(event) {
  if ($('#sla-module_id')) $('#sla-module_id').empty().prop('disabled', true);
  if ($('#sla-product_id')) $('#sla-product_id').empty().prop('disabled', true);
  if ($('#sla-assignedto')) $('#sla-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/productlistall', 'Project_ID' => '']). "' + id)
  .done(function(data) {
    $('#sla-product_id').html(data).prop('disabled', false);
    $('#sla-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
   
    
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});
$('body').on('change', '#sla-product_id', function(event) {
  var up = $('option:selected', this).data('up');
  if (up) $('#sla-project_id').val(up);
  if ($('#sla-module_id')) $('#sla-module_id').empty().prop('disabled', true);
 
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/modulelistall', 'Product_ID' => '']). "' + id)
  .done(function(data) {
    $('#sla-module_id').html(data).prop('disabled', false);
   
  
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
  if (up0) $('#sla-product_id').val(up0);
  var up1 = $('option:selected', '#sla-product_id').data('up');
  if (up1) $('#sla-project_id').val(up1);
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
?>