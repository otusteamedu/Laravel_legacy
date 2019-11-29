<?php
/* @var $this yii\web\View */
$this->title = 'Отправка новой заявки в IT';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;
use vova07\imperavi\Widget;

?>
        <div class="row">
            <div class="col-lg-12">
              <a href="<?=$backurl?>">Назад к списку заявок</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Новая заявка</h2>
            </div>
        </div>
        <?php

                $form = ActiveForm::begin([
                          'method' => 'post',
                          'action' => ['newticket'],
                          'options' => ['enctype'=>'multipart/form-data'],
                          'enableClientValidation'=>true,
                ]);
                echo $form->field($ticket, 'Ticket_ID')->hiddenInput()->label(false);
                echo $form->field($ticket, 'Module_ID')->hiddenInput()->label(false);
                echo $form->field($ticket, 'Author')->hiddenInput()->label(false);
                echo $form->field($ticket, 'Status_ID')->hiddenInput()->label(false);
                echo $form->field($ticket, 'CreationTime')->hiddenInput()->label(false);
                echo $form->field($ticket, 'StartTime')->hiddenInput()->label(false);
                ?>
        <div class="row">
            <div class="col-md-12">

                <div class="form-group field-ticket-project_id">
                  <label class="control-label" for="ticket-project_id">Причина обращения:</label>
                  <select id="ticket-product_id" class="form-control" name="Ticket[Product_ID]"<?php if ($ticket->Ticket_ID) echo ' disabled'?>>
                        <option value="" disabled selected>Выберите причину обращения в IT-help</option>
                      <?php foreach ($products as $product): ?>
                        <option value="<?=$product->Product_ID ?>" data-module="<?=$target_modules[$product->Product_ID]->Module_ID ?>"><?=Html::encode("{$product->Name}") ?></option>
                      <?php endforeach ?>
                      </select>
                      <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($newmsg, 'Text')->textarea(['rows' => 8])->label('Содержание заявки:') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">

                <div class="form-group">
                <?= $form->field($ticket, 'EstTime')->widget(DateTimePicker::classname(),
                [
'model' => $ticket,
'attribute' => 'EstTime',
'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
'language' => 'ru',
'options' => [
    'placeholder' => 'Планируемая дата завершения', 'disabled' => $isReadOnly
],
'pluginOptions' => [
    'todayHighlight' => true,
    'todayBtn' => true,
    'autoclose'=>true,
    'format' => 'yyyy-mm-dd hh:ii:ss',
]
])->label('Планируемая дата завершения:') ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">

                  <?= $form->field($ticket, 'Priority_ID', [])->DropDownList(ArrayHelper::map(\app\models\Priority::find()->all(), 'Priority_ID', 'Name' ),
[ ])->label('Приоритет:') ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group attachment-group">
                    <div class="file js-file"><input type="file" name="MessageFile1[][Path]"><input type="text" name="MessageNote1[]" class="form-control" placeholder="Описание файла"><button type="button" class="remove js-remove disabled" title="Убрать файл">✕</button></div>
                    <p><button id="addmorefiles" type="button">Добавить еще файл</button></p>
                </div>
            </div>
            <div class="col-md-12 col-sm-6">
                  <div class="pull-right">
                    <div class="form-group"><?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?><div></div></div>
                  </div>
            </div>
        </div>
                <?php ActiveForm::end(); ?>

            </div>

        </div>

<?php
$this->registerCss("
.td {text-align: left; vertical-align: top; border: 1px solid #888; padding: 4px; font-size: .95em; }
.yellow {background-color: #ff9900; color: white; vertical-align:middle;}
.center {text-align: center;}
");

$this->registerJsFile('@web/js/jquery.tablesorter.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
/* Если придется возвращать информирование:
$this->registerJs("

var currentAssignedTo, currentInform, currentInformOnce;
$(function() {
  currentInform = $('#w1').val();
});

$('body').on('change', '#ticket-product_id', function(event) {
  var moduleId = $('option:selected', this).data('module');
  $('#ticket-module_id').val(moduleId);
  $('body').css('cursor','wait');
  $.ajax('". Url::toRoute(['tt/viewerlist', 'Ticket_ID' => '', 'Module_ID' => '']). "' + moduleId)
  .done(function(data) {
    $('#w1').html(data);
    $('#w1').val(currentInform).select2({language: 'ru'});
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});

$('body').on('change', '#w1', function(event) { currentInform = $(this).val(); });

", $this::POS_READY, 'ajax');
*/

$this->registerJs("
var statusReady = ".$ticket->statusReady().";

$('body').on('change', '#ticket-product_id', function(event) {
  var moduleId = $('option:selected', this).data('module');
  $('#ticket-module_id').val(moduleId);
});

var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).before(filefield.clone());
  $('.remove').removeClass('disabled');
});
$('form').on('click', '.remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});
", $this::POS_READY, 'ajax');
?>
