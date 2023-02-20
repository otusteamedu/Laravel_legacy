<?php
/* @var $this yii\web\View */
$this->title = 'Система ведения абонентских запросов';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;
use yii\bootstrap\Modal;

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
              <a href="<?=$backurl?>">Назад к списку АЗ</a>
              <?php if ($ticket->dependsOn): ?>
                » <a href="<?=Html::encode(Url::toRoute(['site/view', 'id' => $ticket->dependsOn->Ticket_ID])) ?>"><b>#<?=$ticket->dependsOn->Ticket_ID ?></b>: <?=Html::encode("{$ticket->dependsOn->Subject}") ?></a>
              <?php endif ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h2><?php if ($ticket->Ticket_ID) { ?>Редактирование абонентского запроса #<?php echo $ticket->Ticket_ID; } else { ?>Создание абонентского запроса (или подзапроса)<?php } ?></h2>
                <?php $form = ActiveForm::begin([
                          'method' => 'post',
                          'action' => [$ticket->Ticket_ID ? 'editticket' : 'newticket'],
                          'options' => ['enctype'=>'multipart/form-data'],
                          'enableClientValidation'=>true,
                ]);
                echo $form->field($ticket, 'Ticket_ID')->hiddenInput()->label(false);
                ?>
                <div class="ticket-view-meta">
                  <div class="field-group fullwidth">
                    <?= $form->field($ticket, 'Subject')->textInput(['maxlength' => true])->label('Тема') ?>
                  </div>
                  <div class="field-group project">
                    <div class="form-group field-ticket-project_id">
                      <label class="control-label" for="ticket-project_id">Проект:</label>
                      <select id="ticket-project_id" class="form-control" name="Ticket[Project_ID]">
                        <option value="" disabled<?php if (!$currentModule && count($projects) > 1) echo ' selected'; ?>>—</option>
                      <?php foreach ($projects as $project): ?>
                        <option value="<?=$project->Project_ID ?>"><?=Html::encode("{$project->Name}") ?></option>
                      <?php endforeach ?>
                      </select>
                      <div class="help-block"></div>
                    </div>
                    <div class="form-group field-ticket-product_id">
                      <label class="control-label" for="ticket-product_id">Продукт/Набор услуг:</label>
                      <select id="ticket-product_id" class="form-control" name="Ticket[Product_ID]">
                        <option value="" disabled<?php if (!$currentModule && count($products) > 1) echo ' selected'; ?>>—</option>
                      <?php foreach ($products as $product): ?>
                        <option value="<?=$product->Product_ID ?>" data-up="<?=$product->Project_ID ?>"><?=Html::encode("{$product->Name}") ?></option>
                      <?php endforeach ?>
                      </select>
                      <div class="help-block"></div>
                    </div>
                    <?= $form->field($ticket, 'Module_ID')->DropDownList(ArrayHelper::map($modules, 'Module_ID', 'Name' ),
[ 'prompt' => '—', 'options' => $module_options ])->label('Подсистема/Услуга:') ?>
                  </div>
                  <div class="field-group classify">
                    <?= $form->field($ticket, 'Type_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Типы.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору типа'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(\app\models\Type::find()->all(), 'Type_ID', 'Name' ),
[ 'prompt' => '—' ])->label('Тип:') ?>
                    <?= $form->field($ticket, 'Category_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Категории.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору категории'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(\app\models\Categories::find()->all(), 'Category_ID', 'Name' ),
[ 'prompt' => '—' ])->label('Категория:') ?>
                    <?= $form->field($ticket, 'Priority_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Приоритет.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору критичности'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(\app\models\Priority::find()->all(), 'Priority_ID', 'Name' ),
[ ])->label('Критичность:') ?>
                  </div>
                  <div class="field-group history">
                    <?= $form->field($ticket, 'StartTime')->textInput(['disabled' => true])->label('Дата создания:') ?>
                    <?= $form->field($ticket, 'EstTime')->widget(DateTimePicker::classname(),
                    [
    'model' => $ticket,
    'attribute' => 'EstTime',
    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
    'language' => 'ru',
    'options' => [
        'placeholder' => 'Планируемая дата завершения'
    ],
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss',
    ]
])->label('Планируемая дата завершения:') ?>
                    <hr class="spacing">
                    <?= $form->field($ticket, 'Author')->DropDownList(ArrayHelper::map([$ticket->author], 'user_id', 'name' ),
[ 'prompt' => '—', 'disabled' => true ])->label('Автор:') ?>
                    <?= $form->field($ticket, 'AssignedTo')->DropDownList(ArrayHelper::map($editors, 'user_id', 'name' ),
[ 'prompt' => '—' ])->label('Исполнитель:') ?>
                    <div class="form-group field-ticket-inform">
                      <label class="control-label">Информирование:</label>
                      <?= Select2::widget([
    'name' => 'inform',
    'language' => 'ru',
    'value' => ArrayHelper::getColumn($ticket->usernotifications, 'User_ID'),
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($viewers, 'user_id', 'name'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'Введите имя получателя или выберите из списка',
        'multiple' => true,
    ],
]);
?>
                    </div>
                  </div>
                  <div class="field-group processing">
                    <hr class="spacing">
                    <?= $form->field($ticket, 'DependsOn')->textInput([])->label('Родительская задача:') ?>
                    <?= $form->field($ticket, 'Status_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Статусы.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору статуса'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(\app\models\Status::find()->all(), 'Status_ID', 'Name' ),$ticket->Ticket_ID ? [ 'prompt' => '—' ] : [ 'prompt' => '—', 'disabled' => true])->label('Статус:') ?>
                    <?= $form->field($ticket, 'Progress')->textInput($ticket->Ticket_ID ? [] : ['disabled' => true])->label('Выполнено, %:') ?>
                  </div>
                  <div class="field-group fullwidth">
                  <?= $form->field($ticket, 'Author')->hiddenInput()->label(false);?>
                  <?= $form->field($ticket, 'StartTime')->hiddenInput()->label(false);?>
                  <?php
                    if ($ticket->Ticket_ID) {
                      ?>
                    <div class="form-group ticket-message-text">
                      <label class="control-label" for="messages-text">Содержание запроса:</label>
                      <?=Html::encode("{$ticketbody->Text}") ?>
                    </div>
                  </div>
                  <div class="field-group fullwidth">
                    <?= $form->field($newmsg, 'Text')->textarea(['rows' => 4])->label('Новое сообщение:') ?>
                  </div>
                  <div class="form-group attachment-group">
                    <div class="file js-file"><input type="file" name="MessageFile[][Path]"> <button type="button" class="remove disabled" title="Убрать файл">✕</button></div>
                    <p><button id="addmorefiles" type="button">Добавить еще файл</button></p>
                  </div>
                  <div class="form-group field-message-inform">
                    <label class="control-label" for="message-inform">Проинформировать:</label>
                    <?= Select2::widget([
                        'name' => 'inform_once',
                        'language' => 'ru',
                        'attribute' => 'User_ID',
                        'data' => ArrayHelper::map($viewers, 'user_id', 'name'),
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => [
                            'placeholder' => 'Введите имя получателя или выберите из списка',
                            'multiple' => true,
                        ],
                        ]);
                    ?>
                  </div>
                  <div class="field-group fullwidth">
                    <div class="form-group"><?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?><div></div></div>
                      <?php
                    }
                    else {
                      ?>
                      <?= $form->field($ticket, 'Status_ID')->hiddenInput()->label(false);?>
                      <?= $form->field($newmsg, 'Text')->textarea(['rows' => 12])->label('Содержание запроса:') ?>
                  </div>
                  <div class="form-group attachment-group">
                    <div class="file js-file"><input type="file" name="MessageFile[][Path]"> <button type="button" class="remove disabled" title="Убрать файл">✕</button></div>
                    <p><button id="addmorefiles" type="button">Добавить еще файл</button></p>
                  </div>
                  <div class="form-group field-message-inform">
                    <label class="control-label" for="message-inform">Проинформировать:</label>
                    <?= Select2::widget([
                        'name' => 'inform_once',
                        'language' => 'ru',
                        'attribute' => 'User_ID',
                        'data' => ArrayHelper::map($viewers, 'user_id', 'name'),
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => [
                            'placeholder' => 'Введите имя получателя или выберите из списка',
                            'multiple' => true,
                        ],
                        ]);
                    ?>
                  </div>
                  <div class="field-group fullwidth">
                    <div class="form-group"><?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?><div></div></div>
                    <?php
                    }
                  ?>
                  </div>
                </div>
                <?php ActiveForm::end(); ?>

<?php
  if ($ticket->Ticket_ID) {
?>

                <div class="ticket-subitem-block">
                  <?php
                  $subs = count($subtickets);
                  if ($subs > 0) { ?>
                  <h4>
                  <?php
                  $plural=($subs%10==1 && $subs%100!=11 ? 0 : ($subs%10>=2 && $subs%10<=4 && ($subs%100<10 || $subs%100>=20) ? 1 : 2));
                  $forms = ['доступный подзапрос','доступных подзапроса','доступных подзапросов'];
                  echo $subs . ' ' . $forms[$plural];
                  ?>
                  </h4>

                  <ol>
                  <?php foreach ($subtickets as $subticket): ?>
                    <li value="<?=$subticket->Ticket_ID ?>"><a href="<?=Url::toRoute(['site/view', 'id' => $subticket->Ticket_ID]) ?>"><?=Html::encode("{$subticket->Subject}") ?></a></li>
                  <?php endforeach ?>
                  </ol>
                  <?php } else { ?>
                  <h4>Доступных подзапросов нет</h4>
                  <?php } ?>
                </div>

                <hr>

                <div class="protocol">
                <?php
                $cnt = 0;
                $messages = array_reverse($messages);
                array_pop($messages);
                if (count($messages) > 0) {
                  ?><h4>Протокол запроса</h4><?php
                }
                foreach ($messages as $message) {
                ?>
                <div class="protocol-item">
                  <div class="msg-meta" id="msg<?=$message->Message_ID ?>">
                    <a href="#msg<?=$message->Message_ID ?>">#<?=$message->Message_ID ?></a>
                    <?=$message->DateTime ?>, автор:
                    <a href="<?=Html::encode(Url::toRoute(['profile/alien', 'id' => $message->user->id])) ?>"><?=Html::encode("{$message->user->name}") ?></a>
                  </div>
                  <?php if ($message->ProtocolItem) { ?>
                  <div class="ticket-message-text"><?=$message->ProtocolItem ?></div>
                  <?php }
                        if ($message->Text) { ?>
                  <div class="ticket-message-text"><h5>Добавлен комментарий:</h5><div class="ticket-message-content"><?=$message->Text ?></div></div>
                  <?php } ?>
                  <div class="attachments">
                  <?php if (isset($attachmentsByMessage[$message->Message_ID])) {
                    if (count($attachmentsByMessage[$message->Message_ID]) == 1) {
                      ?><h5>Добавлен файл:</h5><?php
                    } else {
                      ?><h5>Добавлены файлы:</h5><?php
                    }
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

    </div>
</div>
<?php
$this->registerCss("
.td {text-align: left; vertical-align: top; border: 1px solid #888; padding: 4px; font-size: .95em; }
.yellow {background-color: #ff9900; color: white; vertical-align:middle;}
.center {text-align: center;}
");

Modal::begin([
    'id' => 'rulesModal',
    'header' => '<h2 id="modal-header"></h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
]);
Modal::end();

  $this->registerJs("
$('body').on('change', '#ticket-project_id', function(event) {
  if ($('#ticket-module_id')) $('#ticket-module_id').empty().prop('disabled', true);
  if ($('#ticket-product_id')) $('#ticket-product_id').empty().prop('disabled', true);
  if ($('#ticket-assignedto')) $('#ticket-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/productlist', 'Project_ID' => '']). "' + id)
  .done(function(data) {
    $('#ticket-product_id').html(data).prop('disabled', false);
    $('#ticket-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
    $('#ticket-assignedto').html('<option value=\"\">Сначала выберите продукт и подсистему/услугу</option>').prop('disabled', true);
    $('#w1').empty().select2({language: 'ru'});
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});
$('body').on('change', '#ticket-product_id', function(event) {
  var up = $('option:selected', this).data('up');
  if (up) $('#ticket-project_id').val(up);
  if ($('#ticket-module_id')) $('#ticket-module_id').empty().prop('disabled', true);
  if ($('#ticket-assignedto')) $('#ticket-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/modulelist', 'Product_ID' => '']). "' + id)
  .done(function(data) {
    $('#ticket-module_id').html(data).prop('disabled', false);
    $('#ticket-assignedto').html('<option value=\"\">Сначала выберите подсистему/услугу</option>').prop('disabled', true);
    $('#w1, #w2').empty().select2({language: 'ru'});
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
});
$('body').on('change', '#ticket-module_id', function(event) {
  if ($('#ticket-assignedto')) $('#ticket-assignedto').empty().prop('disabled', true);
  $('body').css('cursor','wait');
  var obj = this, id = this.value;
  $.ajax('". Url::toRoute(['site/editorlist', 'Module_ID' => '']). "' + id)
  .done(function(data) {
    $('#ticket-assignedto').html(data).prop('disabled', false);
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
  $.ajax('". Url::toRoute(['site/viewerlist', 'Ticket_ID' => $ticket->Ticket_ID, 'Module_ID' => '']). "' + id)
  .done(function(data) {
    $('#w1, #w2').html(data).select2({language: 'ru'});
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
  if (up0) $('#ticket-product_id').val(up0);
  var up1 = $('option:selected', '#ticket-product_id').data('up');
  if (up1) $('#ticket-project_id').val(up1);
}
$('body').on('change', '#ticket-module_id', function(event) {
  updateProjectProduct(this);
});
updateProjectProduct($('#ticket-module_id'));
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
