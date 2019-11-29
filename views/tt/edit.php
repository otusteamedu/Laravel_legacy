<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;
use vova07\imperavi\Widget;

function shorten_text($text, $shorttext_limit) {
  preg_match('/^(.{1,'.($shorttext_limit-1).'}[^\s.!?,:;-])([\s.!?,:;-]|$)/u', $text, $m);
  return $m[1];
}

function plural($n, $forms) {
  $plural=($n%10==1 && $n%100!=11 ? 0 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 1 : 2));
  return $n . ' ' . $forms[$plural];
}

$this->title = 'Заявка №'.$ticket->Ticket_ID;

?>
        <div class="row">
            <div class="col-lg-12">
              <a href="<?=$backurl?>">Назад к списку заявок</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Заявка №<?= $ticket->Ticket_ID; ?></h2>
            </div>
        </div>
        <?php

        $form = ActiveForm::begin([
                  'method' => 'post',
                  'action' => ['editticket'],
                  'options' => ['enctype'=>'multipart/form-data'],
                  'enableClientValidation'=>true,
        ]);
        echo $form->field($ticket, 'Ticket_ID')->hiddenInput()->label(false);
        echo $form->field($ticket, 'Module_ID')->hiddenInput()->label(false);
        echo $form->field($ticket, 'Author')->hiddenInput()->label(false);
        echo $form->field($ticket, 'Status_ID')->hiddenInput()->label(false);
        echo $form->field($ticket, 'StartTime')->hiddenInput()->label(false);
        ?>
        <div class="ticketbody col-md-12">
          <div class="row">
              <div class="col-md-12">

                  <div class="form-group field-ticket-project_id">
                    <label class="control-label" for="ticket-project_id">Причина обращения:</label>
                    <input class="form-control" name="Ticket[Product_ID]" disabled value="<?= $ticket->module->product->Name; ?>">
                    <div class="help-block"></div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <p class="control-label"><b>Содержание заявки:</b></p>
                    <div class="form-control">
                      <?=$ticketbody->Text ?>
                    </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-3 col-sm-6">
                  <div class="form-group">
                  <?= $form->field($ticket, 'CreationTime')->widget(DateTimePicker::classname(),
                  [
  'model' => $ticket,
  'attribute' => 'CreationTime',
  'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
  'language' => 'ru',
  'options' => [
      'placeholder' => 'Дата создания', 'disabled' => true
  ],
  'pluginOptions' => [
      'todayHighlight' => true,
      'todayBtn' => true,
      'autoclose'=>true,
      'format' => 'yyyy-mm-dd hh:ii:ss',
  ]
  ])->label('Дата создания:') ?>
                  </div>
              </div>
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
              <div class="col-md-3 col-sm-6">

                    <?= $form->field($ticket, 'Status_ID', [])->DropDownList(ArrayHelper::map(\app\models\Status::find()->all(), 'Status_ID', 'Name' ),
  [ ])->label('Статус:') ?>
              </div>
              <?php
              $n1=0;
              foreach ($attachments1 as $attachment) {
                   if ($attachment->file_status != '0') continue;
                   $n1++;
                }
              $n_all = count($attachments) + $n1;
              
              if (true) { ?>
              <div class="col-sm-12">
                  <div class="form-group attachment-group">
                  <p><b>Прикрепленных файлов: <?=$n_all?></b></p>
                  <?php
                    foreach ($attachments as $attachment) {
                      $path_parts = explode('/', $attachment->Path);
                      if (count($path_parts) > 1) {
                        $filelink = Html::a($path_parts[1], '@web/uploads/attachments/'.$attachment->Path, ['target'=>'_blank']).' ('.$path_parts[0].')';
                      }
                      else {
                        $filelink = Html::a($attachment->Path, '@web/uploads/attachments/'.$attachment->Path, ['target'=>'_blank']);
                      }
                  ?>
                  <div class="file"><?= $filelink ?></div><?php 
                    }
                    foreach ($attachments1 as $attachment1) {
                      $filelink = Html::a($attachment1->file_filename, Url::toRoute(['site/file', 'file_id' => $attachment1->file_id]), ['target'=>'_blank']);
                      $shorttext = shorten_text($attachment1->file_note, 40);
                      if (trim($shorttext) != trim($attachment1->file_note)) $shorttext .= '...';
                        ?>
                  <div class="file<?=($attachment1->file_status != '0')?' removed-file':''?>" id="file<?=$attachment1->file_id?>"><?= $filelink ?>&nbsp;<span title="<?=$attachment1->file_note?>"><?php if(!empty($shorttext)) echo "(".$shorttext.")"?></span></div>
                      <?php
                    }
                    ?>
                </div>
              </div>
              <?php 
              } ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                  <?= $form->field($newmsg, 'Text')->widget(Widget::className(), [
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 200,
                        'formatting' => ['p', 'blockquote'],
                        'buttons' => ['formatting', 'bold', 'italic'],
                    ]
                ])->label('Новое сообщение:');?>
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group attachment-group">
                    <div class="file js-file"><input type="file" name="MessageFile1[][Path]"><input type="text" name="MessageNote1[]" class="form-control" placeholder="Описание файла"><button type="button" class="remove js-remove disabled" title="Убрать файл">✕</button></div>
                    <p><button id="addmorefiles" type="button">Добавить еще файл</button></p>
                </div>
            </div>
            <div class="col-sm-6">
                  <div class="pull-right">
                    <div class="form-group"><?= Html::submitButton('Сохранить', ['class' => 'btn']) ?><div></div></div>
                  </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

<?php
  if ($ticket->Ticket_ID) {
?>

                <div class="protocol">
                <?php
                $cnt = 0;
                $messages = array_reverse($messages);
                array_pop($messages);
                if (count($messages) > 0) {
                  ?><h4>Протокол заявки</h4><?php
                }
                foreach ($messages as $message) {
                ?>
                <div class="protocol-item">
                  <div class="protocol-item-meta" id="msg<?=$message->Message_ID ?>">
                    <span class="protocol-item-heading">
                      <a href="#msg<?=$message->Message_ID ?>">#<?=$message->Message_ID ?></a>
                      <?=$message->DateTime ?>, автор:
                      <a href="<?=Html::encode(Url::toRoute(['profile/alien', 'id' => $message->user->id])) ?>"><?=Html::encode("{$message->user->name}") ?></a>
                    </span>
                    <button class="message-quote js-quote">Цитировать</button>
                  </div>
                  <?php if ($message->ProtocolItem) { ?>
                  <div class="protocol-item-text"><?=$message->ProtocolItem ?></div>
                  <?php } ?>
                  <?php if ($message->Text) { ?>
                  <div class="protocol-item-message js-quotable">
                    <?=$message->Text ?>
                  </div>
                  <?php } ?>
                  <div class="protocol-item-attachments">
                  <?php
                    $n0 = $n = 0;
                    if (isset($attachmentsByMessage[$message->Message_ID])) $n0 = count($attachmentsByMessage[$message->Message_ID]);
                    if (isset($attachments1ByMessage[$message->Message_ID])) $n = count($attachments1ByMessage[$message->Message_ID]);
                    if ($n0 + $n > 0) {
                      if ($n0 + $n == 1) {
                        ?><h5>Добавлен файл:</h5><?php
                      } else {
                        ?><h5>Добавлены файлы:</h5><?php
                      }
                      ?><div><?php
                      if ($n0) {
                        foreach ($attachmentsByMessage[$message->Message_ID] as $attachment) {
                          $path_parts = explode('/', $attachment->Path);
                          if (count($path_parts) > 1) {
                            $filelink = Html::a($path_parts[1], '@web/uploads/attachments/'.$attachment->Path, ['target'=>'_blank']).' ('.$path_parts[0].')';
                          }
                          else {
                            $filelink = Html::a($attachment->Path, '@web/uploads/attachments/'.$attachment->Path, ['target'=>'_blank']);
                          }
                        ?>
                      <div class="file"><?= $filelink ?></div>
                      <?php
                        }
                      }
                      if ($n) {
                        foreach ($attachments1ByMessage[$message->Message_ID] as $attachment) {
                          $filelink = Html::a($attachment->file_filename, Url::toRoute(['site/file', 'file_id' => $attachment->file_id]), ['target'=>'_blank']);
                          $shorttext = shorten_text($attachment->file_note, 40);
                          if (trim($shorttext) != trim($attachment->file_note)) $shorttext .= '...';
                          ?>
                        <div class="file<?=($attachment->file_status != '0')?' removed-file':''?>" id="file<?=$attachment->file_id?>"><?= $filelink ?>&nbsp;<span title="<?=$attachment->file_note?>">(<?=$shorttext?>)</span></div>
                        <?php
                        }
                      }
                      ?></div><?php
                    }
                  ?>
                  </div>
                </div>
                <?php
                }
                ?>
                </div>

<?php
  }
?>

            </div>

        </div>

<?php
$this->registerCss("
.td {text-align: left; vertical-align: top; border: 1px solid #888; padding: 4px; font-size: .95em; }
.yellow {background-color: #ff9900; color: white; vertical-align:middle;}
.center {text-align: center;}
.ticketbody { background: #eee; margin-bottom: 1em; }
div.form-control {
  height: auto;
  min-height: 68px;
  background: #eee;
}
");

$this->registerJsFile('@web/js/jquery.tablesorter.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("
var statusReady = ".$ticket->statusReady().";

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

var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).before(filefield.clone());
  $('.remove').removeClass('disabled');
});
$('form').on('click', '.remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});

$(function() {
  $('#subtickets').tablesorter();
});

function getSelectionHTML() {
  var el = document.createElement('div');
  el.appendChild(window.getSelection().getRangeAt(0).cloneContents());
  return el.innerHTML;
}

function containsSelection(elt) {
  return $.contains(elt, window.getSelection().anchorNode) && $.contains(elt, window.getSelection().focusNode);
}

$('.js-quote').click(function() {
  var container = $(this).closest('.protocol-item'), msg = container.find('.js-quotable'), text;
  if (containsSelection(msg[0])) text = getSelectionHTML();
  else text = msg.html();
  $('#messages-text').redactor('insert.html','<blockquote><p><small>'+container.find('.protocol-item-heading').html()+'</small><p>'+text+'</blockquote>');
});
", $this::POS_READY, 'ajax');
?>
