<?php
/* @var $this yii\web\View */
$this->title = 'Система ведения абонентских запросов';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Select2;
use vova07\imperavi\Widget;
use kartik\time\TimePicker;

function shorten_text($text, $shorttext_limit) {
  preg_match('/^(.{1,'.($shorttext_limit-1).'}[^\s.!?,:;-])([\s.!?,:;-]|$)/u', $text, $m);
  return $m[1];
}

function plural($n, $forms) {
  $plural=($n%10==1 && $n%100!=11 ? 0 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 1 : 2));
  return $n . ' ' . $forms[$plural];
}

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
                <?php
                if ($ticket->Ticket_ID) {

                  $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => Url::toRoute(['favorite/update']),
                            'enableClientValidation'=>false,
                            'options' => ['class' => 'favorite-form'],
                  ]);
                  ?>
                    <?= $form->field($fav, 'User_ID')->hiddenInput() ?>
                    <?= $form->field($fav, 'Ticket_ID')->hiddenInput() ?>
                    <label class="control-label" for="favoriteTicket" style="width: auto;">В избранное:</label>
                    <?= Html::checkbox('add', $isFav, ['id' => 'favoriteTicket', 'style' => 'align-self:baseline;margin:.5em 0 0 .5em']); ?>
                  <?php
                  ActiveForm::end();


                  if ($canCreate) { ?>
                  <div class="pull-right" style="margin-bottom: 5px;">
                    <a class="btn btn-success" href="<?=Html::encode(Url::toRoute(['site/create', 'id' => $ticket->Ticket_ID])) ?>">Новый подзапрос</a>
                  </div>
                  <?php
                  }
                ?>
                <h2>Редактирование абонентского запроса #<?php echo $ticket->Ticket_ID; ?></h2><?php
                }
                else {
                  // виджет-заглушка, нужен только для поддержания порядка автогенерируемых ID
                  $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => Url::toRoute(['favorite/update']),
                            'enableClientValidation'=>false,
                  ]);
                  ActiveForm::end();
                  ?>
                <h2>Создание абонентского запроса (или подзапроса) </h2><?php
                }

                $form = ActiveForm::begin([
                          'method' => 'post',
                          'action' => [$ticket->Ticket_ID
                            ? $isReadOnly
                              ? 'newmessage'
                              : 'editticket'
                            : 'newticket'],
                          'options' => ['enctype'=>'multipart/form-data'],
                          'enableClientValidation'=>true,
                ]);
                echo $form->field($ticket, 'Ticket_ID')->hiddenInput()->label(false);
                if ($ticket->Ticket_ID) echo $form->field($ticketbody, 'Ticket_ID')->hiddenInput()->label(false);
                ?>
                <div class="ticket-view-meta">
                  <div class="field-group fullwidth">
                    <?php
                    if ($ticket->Ticket_ID && !$isReadOnly) {
                    ?>
                    <button type="button" class="change_projprod_btn js-enable_projprod" title="Редактировать"><span class="glyphicon glyphicon-pencil"></span></button>
                    <?php
                    }
                    ?>
                    <?= $form->field($ticket, 'Subject')->textInput(['maxlength' => true, 'disabled' => (bool)$ticket->Ticket_ID ])->label('Тема') ?>
                  </div>
                  <div class="field-group project">
                    <div class="form-group field-ticket-project_id">
                      <label class="control-label" for="ticket-project_id">Проект:</label>
                      <select id="ticket-project_id" class="form-control" name="Ticket[Project_ID]"<?php if ($ticket->Ticket_ID) echo ' disabled'?>>
                        <option value="" disabled<?php if (!$currentModule && count($projects) > 1) echo ' selected'; ?>>—</option>
                      <?php foreach ($projects as $project): ?>
                        <option value="<?=$project->Project_ID ?>"<?php if ($ticket->Module_ID && $ticket->module->product->Project_ID == $project->Project_ID) echo ' selected'; ?>><?=Html::encode("{$project->Name}") ?></option>
                      <?php endforeach ?>
                      </select>
                      <div class="help-block"></div>
                    </div>
                    <div class="form-group field-ticket-product_id">
                      <label class="control-label" for="ticket-product_id">Продукт/Набор услуг:</label>
                      <select id="ticket-product_id" class="form-control" name="Ticket[Product_ID]"<?php if ($ticket->Ticket_ID) echo ' disabled'?>>
                        <option value="" disabled<?php if (!$currentModule && count($products) > 1) echo ' selected'; ?>>—</option>
                      <?php foreach ($products as $product): ?>
                        <option value="<?=$product->Product_ID ?>" data-up="<?=$product->Project_ID ?>"<?php if ($ticket->Module_ID && $ticket->module->Product_ID == $product->Product_ID) echo ' selected'; ?>><?=Html::encode("{$product->Name}") ?></option>
                      <?php endforeach ?>
                      </select>
                      <div class="help-block"></div>
                    </div>
                    <?= $form->field($ticket, 'Module_ID')->DropDownList(
                    $ticket->Ticket_ID
                      ? [$ticket->Module_ID => $ticket->module->Name]
                      : ArrayHelper::map($modules, 'Module_ID', 'Name'),
[ 'disabled' => (bool)$ticket->Ticket_ID ])->label('Подсистема/Услуга:') ?>
                  </div>
                  <div class="field-group classify">
                    <?= $form->field($ticket, 'Type_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Типы.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору типа'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(
                      $isReadOnly
                        ? [ \app\models\Type::find()->where(['Type_ID' => $ticket->Type_ID])->one() ]
                        : \app\models\Type::find()->all()
                    , 'Type_ID', 'Name' ),
[ 'prompt' => '—', 'disabled' => (bool)$ticket->Ticket_ID ])->label('Тип:') ?>
                    <?= $form->field($ticket, 'Category_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Категории.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору категории'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(
                    $isReadOnly
                        ? [ \app\models\Categories::find()->where(['Category_ID' => $ticket->Category_ID])->one() ]
                        : \app\models\Categories::find()->all()
                    , 'Category_ID', 'Name' ),
[ 'prompt' => '—', 'disabled' => (bool)$ticket->Ticket_ID ])->label('Категория:') ?>
                    <?= $form->field($ticket, 'Priority_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Приоритет.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору критичности'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(
                      $isReadOnly
                        ? [ \app\models\Priority::find()->where(['Priority_ID' => $ticket->Priority_ID])->one() ]
                        : \app\models\Priority::find()->all(), 'Priority_ID', 'Name' ),
[ 'disabled' => $isReadOnly ])->label('Критичность:') ?>
                  </div>
                  <div class="field-group history">
                    <?= $form->field($ticket, 'CreationTime')->textInput(['disabled' => true])->label('Дата создания:') ?>
                    <?= $form->field($ticket, 'StartTime')->widget(DateTimePicker::classname(),
                    [
    'model' => $ticket,
    'attribute' => 'StartTime',
    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
    'language' => 'ru',
    'options' => [
        'placeholder' => 'Дата начала', 'disabled' => $isReadOnly
    ],
    'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss',
    ]
])->label('Дата начала:') ?>
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
                    <div class="form-group">
                      <label class="control-label" for="ticket-period">Периодическая задача:</label>
                      <input type="checkbox" id="ticket-period" name="is-periodic" class="" value="true"  <?php echo $date_next_task ? 'checked' : ''; ?> >
                      <button class="btn btn-primary js-show-periodic" style="margin: -.4em 0 .5em .5em; max-width:calc(100% - 12em);"><span style="display: block; white-space: normal">Следующее повторение: <span style="white-space:nowrap"><?php echo $date_next_task ? $date_next_task : 'не запланировано'; ?></span></span></button>
                      <div class="help-block"></div>
                      <div class="periodic-popup">
                                      <?php
Modal::begin([
    'id' => 'periodicModal',
    'header' => '<h2>Укажите периодичность повторения</h2><p style="font-size: 1.2em"><b>Внимание:</b> введенные данные сохранятся только при сохранении запроса!</p>',
    'footer' => '<button type="button" class="btn btn-primary js-check-periodic" data-dismiss="modal">Применить изменения</button> <button type="button" class="btn btn-default js-close-periodic" data-dismiss="modal">Закрыть, не применяя</button>',
    'closeButton' => false,
    'options' => [ 'data-backdrop' => "static", 'data-keyboard' => "false" ]
]);
?>
                        <div class="form-group field-ticket-inform">
                      <label class="control-label">Год:</label>
                      <?= Select2::widget([
    'name' => 'select_years',
    'language' => 'ru',
   //'value' => ArrayHelper::getColumn($modules, 'md'),
    'value' => $select_years_base,
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($array_of_years, 'id', 'data'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'год',
        'multiple' => true,
        'disabled' => $isReadOnly
    ],
]);
?>
                    </div>
                        <div class="form-group field-ticket-inform">
                      <label class="control-label">Месяц:</label>
                      <?= Select2::widget([
    'name' => 'select_months',
    'language' => 'ru',
    'value' => $select_months_base,
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($array_of_months, 'id', 'data'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'месяц',
        'multiple' => true,
        'disabled' => $isReadOnly
    ],
]);
?>
                    </div>
                    <div class="form-group field-ticket-inform">
                      <label class="control-label">Каждый:</label>
                      <div style="display:flex;width:100%;align-items:center;">
                        <div style="flex:3">
                      <?= Select2::widget([
    'name' => 'select_everething',
    'language' => 'ru',
    'value' => $select_everything_base,
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($array_of_everything, 'id', 'data'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'например, второй',
        'multiple' => true,
        'disabled' => $isReadOnly
    ],
]);
?></div>
                        <div style="flex:3; padding-left: 5px;">
                      <?= Select2::widget([
    'name' => 'select_days_of_week',
    'language' => 'ru',
    'value' => $select_days_of_week_base,
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($array_days_of_week, 'id', 'data'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'например, четверг',
        'multiple' => true,
        'disabled' => $isReadOnly
    ],
]);
?></div>
                        <div style="flex:2; padding-left: 5px;">
                          <label><input type="checkbox" id="month-check" name="month-check" class="" value="true" <?=$period_month_check ? ' checked' : ''?>> месяца</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group field-ticket-inform">
                      <label class="control-label">Число:</label>
                      <?= Select2::widget([
    'name' => 'select_dates',
    'language' => 'ru',
    'value' => $select_dates_base,
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($array_of_dates, 'id', 'data'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'дата',
        'multiple' => true,
        'disabled' => $isReadOnly
    ],
]);
?>
                    </div>
                    <div id='clone' class="form-group field-ticket-inform">
                      <div class="control-label">
                        <label class="control-label">Время запуска:</label>
                        <button id="add_time" type="button">Еще время</button>
                      </div>
                      
                      <div class="time-container js-time-container">
<?php
                      $time_fields_cnt = count($select_time_base);
                      foreach($select_time_base as $i => $value) { ?>

                      <div class="time-field js-time">
                        <div>
     <?php

echo TimePicker::widget([
    'name' => 'time_task[]',
    'value' => $value,
    'id'=>'timepickerbase'.$i,
    'pluginOptions' => [
        'showSeconds' => false,
        'minuteStep' => 1,
        'showMeridian'=>false,
    ],
    'options' => ['class' => 'timepicker-field'],
    'containerOptions' => ['class' => 'timepicker-container']
]);
?></div>
                        <div>
                            <button type="button" class="remove js-remove-time<?=($time_fields_cnt > 1) ? '' : ' disabled' ?>" title="Убрать установку времени">✕</button>
                        </div>
                      </div>
<?php
                      } ?>
                    </div>

                    </div>

<?php
Modal::end();
                ?>
                      </div>
                    </div>
                    

                    <?= $form->field($ticket, 'Author')->DropDownList(ArrayHelper::map([$ticket->author], 'user_id', 'name' ),
[ 'prompt' => '—', 'disabled' => true ])->label('Автор:') ?>
                    <?= $form->field($ticket, 'AssignedTo')->DropDownList(ArrayHelper::map($editors, 'user_id', 'name' ),
[ 'prompt' => '—', 'disabled' => $isReadOnly ])->label('Исполнитель:') ?>
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
        'disabled' => $isReadOnly
    ],
]);
?>
                    </div>
                  </div>
                  <div class="field-group processing">
                    <hr class="spacing">
                    <?= $form->field($ticket, 'DependsOn')->textInput(['disabled' => $isReadOnly])->label('Родительская задача:') ?>
                    <?= $form->field($ticket, 'Status_ID', ['template' => "<span class=\"control-label\">{label}\n ".Html::a('?', '@web/uploads/wiki/Правила выбора. Статусы.htm', ['class'=>'js-ruleslink help', 'title' => 'Памятка по выбору статуса'])."</span>\n{input}\n{hint}\n{error}"])->DropDownList(ArrayHelper::map(
                      $isReadOnly
                          ? [ \app\models\Status::find()->where(['Status_ID' => $ticket->Status_ID])->one() ]
                          : \app\models\Status::find()->all()
                      , 'Status_ID', 'Name' ),
                      $ticket->Ticket_ID
                        ? [ 'prompt' => '—', 'disabled' => $isReadOnly ]
                        : [ 'prompt' => '—', 'disabled' => true]
                    )->label('Статус:') ?>
                    <?= $form->field($ticket, 'Progress')->textInput($ticket->Ticket_ID ? ['disabled' => $isReadOnly] : ['disabled' => true])->label('Выполнено, %:') ?>
                    <?= $form->field($ticket, 'EstEffort')->textInput(['disabled' => (bool)$ticket->Ticket_ID, 'placeholder' => 'Например, 2.5'])->label('Планируемое время, ч.:') ?>
                    <?php if ($ticket->Ticket_ID) {
                       if (count($subtickets) > 0) { ?>
                    <div class="form-group">
                      <label class="control-label" for="ticket-realeffort">Затраченное время, ч.:</label>
                      <div style="display:flex;align-items:flex-end">
                        <div>
                          <label class="control-label" for="ticket-realeffort">на сам запрос</label>
                          <input type="text" id="ticket-realeffort" class="form-control" disabled value="<?=number_format($ticket_total, 1, ',', ' ')?>">
                        </div>
                        <div>
                          <label class="control-label" for="ticket-subtickets-realeffort">на подза&shy;просы</label>
                          <input type="text" id="ticket-subtickets-realeffort" class="form-control" disabled value="<?=number_format($subtickets_total, 1, ',', ' ')?>">
                        </div>
                        <div>
                          <label class="control-label" for="ticket-subtickets-realeffort">всего</label>
                          <input type="text" id="ticket-subtickets-realeffort" class="form-control" disabled value="<?=number_format($ticket_total+$subtickets_total, 1, ',', ' ')?>">
                        </div>
                      </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group">
                      <label class="control-label" for="ticket-realeffort">Затраченное время, ч.:</label>
                      <input type="text" id="ticket-realeffort" class="form-control" disabled value="<?=number_format($ticket_total, 1, ',', ' ')?>">
                      <div class="help-block"></div>
                    </div>
                    <?php }
                    } ?>
                  </div>
                  <div class="field-group fullwidth">
                  <?= $form->field($ticket, 'Author')->hiddenInput()->label(false);?>
                  <?= $form->field($ticket, 'CreationTime')->hiddenInput()->label(false);?>
                  <?php
                    if ($ticket->Ticket_ID) {
                      ?>
                    <div class="form-group ticket-message-text">
                      <label class="control-label" for="messages-text">Содержание запроса:</label>
                      <div><?=$ticketbody->Text ?></div>
                    </div>
                  </div>
                  <?php if ($ticket->ticketResolution) { ?>
                  <div class="field-group"></div>
                  <div class="field-group ticket-resolution">
                    <p class="field-list" style="width:100%"><b>Результат выполнения:</b></p>
                    <dl class="field-list">
                      <dt>Проблема:</dt>
                      <dd><?=Html::encode("{$ticket->ticketResolution->Problem}") ?></dd>
                      <dt>Предпринятые действия:</dt>
                      <dd><?=Html::encode("{$ticket->ticketResolution->Actions}") ?></dd>
                      <dt>Результат:</dt>
                      <dd><?=Html::encode("{$ticket->ticketResolution->Result}") ?></dd>
                      <dt>Выполнил:</dt>
                      <dd><?=Html::encode("{$ticket->ticketResolution->author->name}") ?></dd>
                    </dl>
                  </div>
                  <?php } ?>

                  <div class="field-group fullwidth">
                    <?= $form->field($newmsg, 'Text')->widget(Widget::className(), [
                      'settings' => [
                          'lang' => 'ru',
                          'minHeight' => 200,
                          'formatting' => ['p', 'blockquote'],
                          'buttons' => ['formatting', 'bold', 'italic'],
                      ]
                  ])->label('Новое сообщение:');?>
                  </div>
                  <div class="form-group attachment-group">
                    <div class="file js-file"><input type="file" name="MessageFile1[][Path]"><input type="text" name="MessageNote1[]" class="form-control" placeholder="Описание файла"><button type="button" class="remove js-remove disabled" title="Убрать файл">✕</button></div>
                    <p><button id="addmorefiles" type="button">Добавить еще файл</button></p>
                  </div>
                  <div>
                    <?= $form->field($newmsg, 'RealEffort')->textInput(['placeholder' => 'Например, 1.5'])->label('Затраченное время, ч.:') ?>
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
                    <div class="file js-file"><input type="file" name="MessageFile1[][Path]"><input type="text" name="MessageNote1[]" class="form-control" placeholder="Описание файла"><button type="button" class="remove js-remove disabled" title="Убрать файл">✕</button></div>
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
                      </div>
<?php if ($ticket->Ticket_ID) { ?>
                <div class="resolution-popup">
                <?php
Modal::begin([
    'id' => 'resolutionModal',
    'header' => '<h2>Отчет о выполненных работах</h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
]);
?>
                  <?= $form->field($resolution, 'Problem')->textarea(['rows' => 5])->label('Проблема:') ?>
                  <?= $form->field($resolution, 'Actions')->textarea(['rows' => 5])->label('Предпринятые действия:') ?>
                  <?= $form->field($resolution, 'Result')->textarea(['rows' => 5])->label('Результат:') ?>
<?php
Modal::end();
                ?>
                </div>
<?php } ?>
                <?php ActiveForm::end(); ?>

            </div>
            <div class="row">
<?php
  if ($ticket->Ticket_ID) {
?>

                <div class="col-lg-12 ticket-subitem-block">

                  <?php
                  $subs = count($subtickets);
                  if ($subs > 0) { ?>
                  <h4><?=plural($subs, ['доступный подзапрос','доступных подзапроса','доступных подзапросов']); ?></h4>

                  <table id="subtickets" class="table table-striped table-bordered tablesorter">
                    <thead>
                      <tr>
                        <th><a class="tablesort">ID</a></th>
                        <th><a class="tablesort">Тема</a></th>
                        <th><a class="tablesort">Статус</a></th>
                        <th style="width:18%"><a class="tablesort">Исполнитель</a></th>
                        <th style="width:18%"><a class="tablesort">Затрачено времени, ч</a></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php foreach ($subtickets as $subticket): ?>
                      <tr>
                        <td><?=$subticket->Ticket_ID ?></td>
                        <td>
                          <a href="<?=Html::encode(Url::toRoute(['site/view', 'id' => $subticket->Ticket_ID])) ?>"><?=Html::encode("{$subticket->Subject}") ?></a>
                        </td>
                        <td><?=$subticket->status->Name ?></td>
                        <td><?=$subticket->assignedTo->name ?></td>
                        <td><?=number_format($subticket->totalEffort, 1, ',', ' ')?></td>
                      </tr>
                  <?php endforeach ?>
                    </tbody>
                  </table>
                  <?php } else { ?>
                  <h4>Доступных подзапросов нет</h4>
                  <?php } ?>

                </div>
                <div class="col-lg-12">

                <?php
                $n0 = count($attachments);
                $n1 = count($attachments1);
                $total_files = $n0 + $n1;
                ?>

                <ul class="nav nav-tabs">
                  <li class="active"><a href="#protocol" data-toggle="tab">Протокол запроса</a></li>
                  <li><a href="#files" data-toggle="tab">Прикрепленные файлы (<?=$total_files ?> шт.)</a></li>
                </ul>

                <div class="tab-content ticket-tabs">
                  <div class="tab-pane active protocol" id="protocol">
                  <?php
                if (count($messages) > 0) {
                  $messages = array_reverse($messages);
                  array_pop($messages);
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
                        <div class="file<?=($attachment->file_status != '0')?' removed-file':''?>" id="file<?=$attachment->file_id?>"><?= $filelink ?> <span title="<?=$attachment->file_note?>">(<?=$shorttext?>)</span></div>
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
                }
                else {
                  ?><p>Протокол запроса пока пуст.</p><?php
                }
                  ?>
                  </div>
                  <div class="tab-pane files" id="files">
                  <?php
                  ?>
                  <table id="attachments" class="table table-striped table-bordered tablesorter">
                    <thead>
                      <tr>
                        <th><a class="tablesort">Имя файла</a></th>
                        <th><a class="tablesort">Примечание</a></th>
                        <th><a class="tablesort">Кто добавил</a></th>
                        <th><a class="tablesort">Дата добавления</a></th>
                        <?php if(!$isReadOnly) { ?><th style="width: 1px;"></th><?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                  if ($total_files) {
                    foreach ($attachments1 as $attachment) {
                      if ($attachment->file_status != '0') continue;
                      $filelink = Html::a($attachment->file_filename, Url::toRoute(['site/file', 'file_id' => $attachment->file_id]), ['target'=>'_blank']);
                      $shorttext = shorten_text($attachment->file_note, 40);
                      if (trim($shorttext) != trim($attachment->file_note)) $shorttext .= '...';
                  ?>
                      <tr>
                        <td><span class="file"><?= $filelink ?></span></td>
                        <td title="<?=$attachment->file_note ?>"><?=$shorttext ?></td>
                        <td><?= $attachment->message->user->name; ?></td>
                        <td><?= $attachment->message->DateTime ?></td>
                        <?php if(!$isReadOnly) { ?><td><button type="button" class="remove js-deletefile" data-id="<?=$attachment->file_id?>" title="Убрать файл в архив">✕</a></td><?php } ?>
                      </tr>
                  <?php
                    } ?>
                  <?php
                    foreach ($attachments as $attachment) {
                      $path_parts = explode('/', $attachment->Path);
                      if (count($path_parts) > 1) {
                        $filelink = Html::a($path_parts[1], '@web/uploads/attachments/'.$attachment->Path, ['target'=>'_blank']);
                      }
                      else {
                        $filelink = Html::a($attachment->Path, '@web/uploads/attachments/'.$attachment->Path, ['target'=>'_blank']);
                      }
                    ?>
                    <tr>
                        <td><span class="file"><?= $filelink ?></span></td>
                        <td>—</td>
                        <td><?= $attachment->message->user->name; ?></td>
                        <td><?= $attachment->message->DateTime ?></td>
                        <td></td>
                      </tr>
                  <?php
                    }
                  }
                  else {
                    ?>
                    <tr>
                      <td colspan="5" style="text-align:center">Прикрепленных файлов нет</td>
                    </tr>
                    <?php
                  }?>
                    </tbody>
                  </table>
                  </div>
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
#modalConfirm #modal-header { font-size: 20px; }
.modal-backdrop + .modal-backdrop { display: none !important; }
");

Modal::begin([
    'id' => 'rulesModal',
    'header' => '<h2 id="modal-header"></h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>'
]);
Modal::end();

  $this->registerJsFile('@web/js/jquery.tablesorter.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
  $this->registerJs("

$('#add_time').click(function() {
  $('#clone1, #clone2').show();
});

$('[name^=year]').click(function() {

   var num_year=$(this).attr('data-nuyk');


  // alert($('#year-'+num_year+'').val());
   if($('#year-'+num_year+'').val()==1){

   $('#year-'+num_year+'').val(0);
   $(this).css('color','#333');
   }
    else{

   $('#year-'+num_year+'').val(1);
   $(this).css('color','green');
   $(this).css('font_size','18px');
   }



});




$('[name^=month]').click(function() {

   var num_munth=$(this).attr('data-numk');


  // alert($('#month-'+num_munth+'').val());
   if($('#month-'+num_munth+'').val()==1){

   $('#month-'+num_munth+'').val(0);
   $(this).css('color','#333');
   }
    else{

   $('#month-'+num_munth+'').val(1);
   $(this).css('color','green');
   }



});


$('[name^=days_of_week]').click(function() {

   var num_days_of_week=$(this).attr('data-nuwk');


  // alert($('#month-'+num_munth+'').val());
   if($('#days_of_week-'+num_days_of_week+'').val()==1){

   $('#days_of_week-'+num_days_of_week+'').val(0);
   $(this).css('color','#333');
   }
    else{

   $('#days_of_week-'+num_days_of_week+'').val(1);
   $(this).css('color','green');
   }



});


$('[name^=dates]').click(function() {

   var num_dates=$(this).attr('data-nudk');


  // alert($('#dates-'+num_dates+'').val());
   if($('#dates-'+num_dates+'').val()==1){

   $('#dates-'+num_dates+'').val(0);
   $(this).css('color','#333');
   }
    else{

   $('#dates-'+num_dates+'').val(1);
   $(this).css('color','green');
   }



});

$('[name^=timeslots]').click(function() {

   var num_timeslots=$(this).attr('data-nutk');


  // alert($('#timeslots-'+num_timeslots+'').val());
   if($('#timeslots-'+num_timeslots+'').val()==1){

   $('#timeslots-'+num_timeslots+'').val(0);
   $(this).css('color','#333');
   }
    else{

   $('#timeslots-'+num_timeslots+'').val(1);
   $(this).css('color','green');
   }



});


var statusReady = ".$ticket->statusReady().";

var currentAssignedTo, currentInform, currentInformOnce;
$(function() {
  currentAssignedTo = $('#ticket-assignedto').val();
  currentInform = $('#w7').val();
  currentInformOnce = $('#w8').val();
});

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
    $('#w8').empty().select2({language: 'ru'});
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
    $('#w7, #w8').empty().select2({language: 'ru'});
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
    $('#ticket-assignedto').html(data).prop('disabled', false).val(currentAssignedTo);
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
  $.ajax('". Url::toRoute(['site/viewerlist', 'Ticket_ID' => $ticket->Ticket_ID, 'Module_ID' => '']). "' + id)
  .done(function(data) {
    $('#w7, #w8').html(data);
    $('#w7').val(currentInform).select2({language: 'ru'});
    $('#w8').val(currentInformOnce).select2({language: 'ru'});
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
$('.js-enable_projprod').on('click', function(event) {
  if ($('#ticket-module_id').attr('disabled')) {
    $('#ticket-subject, #ticket-module_id, #ticket-product_id, #ticket-project_id, #ticket-type_id, #ticket-category_id, #ticket-starttime, #ticket-esteffort').removeAttr('disabled');
    updateProjectProduct($('#ticket-module_id'));
  }
  else {
    $('#ticket-subject, #ticket-module_id, #ticket-product_id, #ticket-project_id, #ticket-type_id, #ticket-category_id, #ticket-starttime, #ticket-esteffort').attr('disabled', true);
  }
});
updateProjectProduct($('#ticket-module_id'));

$('body').on('change', '#ticket-assignedto', function(event) { currentAssignedTo = $(this).val(); });
$('body').on('change', '#w7', function(event) { currentInform = $(this).val(); });
$('body').on('change', '#w8', function(event) { currentInformOnce = $(this).val(); });

var filefield = $('.js-file').clone();
$('#addmorefiles').on('click', function() {
  $(this).parent().before(filefield.clone());
  $('.js-remove').removeClass('disabled');
});
$('form').on('click', '.js-remove', function() {
  if ($('form .js-file').length > 1) $(this).parent().remove();
  if ($('form .js-file').length < 2) $('.remove').addClass('disabled');
});

$('.js-deletefile').on('click', function() {
  var el = $(this), id = el.data('id');
  if (!confirm('Вы уверены?')) {
    el.blur();
    return;
  }
  $('body').css('cursor','wait');
  $.post('". Url::toRoute(['site/deletefile']). "', { file_id: id, _csrf: '".Yii::$app->request->getCsrfToken()."' })
  .done(function(data) {
    if(data == 'ok') {
      $(this).off('click');
      el.closest('tr').remove();
      $('#file'+id).addClass('removed-file');
    }
    else {
      alert('Извините, произошла ошибка. Попробуйте обновить страницу.')
    }
  })
  .fail(function() {
    console.log('error with ' + id);
  })
  .always(function() {
    $('body').css('cursor','');
  });
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

$('#ticket-status_id').on('change', function(event) {
  if ($(this).val() == statusReady) {
    $('#ticket-progress').val(90);
    $('#resolutionModal').modal('show');
    $('#resolutionModal').on('shown.bs.modal', function() { $('#ticketresolution-problem').focus(); });
  }
});

$('#ticket-period').on('click', function(event) {
  if (this.checked) {
    $('#periodicModal').modal('show');
    //$('#periodicModal').on('shown.bs.modal', function() { $('#ticketresolution-problem').focus(); });
  }
});
$('.js-show-periodic').on('click', function(event) {
  $('#periodicModal').modal('show');
  //$('#periodicModal').on('shown.bs.modal', function() { $('#ticketresolution-problem').focus(); });
});

$('#w1').on('submit', function(event) {
  if ($('#ticket-status_id').val() == statusReady) {
    if ($.trim($('#ticketresolution-problem').val()) == '' && $.trim($('#ticketresolution-problem').val()) == '' && $.trim($('#ticketresolution-result').val()) == '') {
      $('#resolutionModal').modal('show');
      $('#resolutionModal').on('shown.bs.modal', function() { $('#ticketresolution-problem').focus(); });
    }
  }
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

function updateFav(elem) {
  var form = $(elem), data = form.serialize();

  $('body').css('cursor','wait');

  $.post(form.attr('action'), data, null, 'json')
    .done(function(result) {
      if (result.result == 1) {
        $('#favoriteTicket')[0].checked = (result.op == 'create');
      }
    })
    .always(function() {
      $('body').css('cursor','');
    });
}

$(document).on('click', '#favoriteTicket', function(event) {
  event.preventDefault();
  return updateFav(this.form);
});
$(function() {
  $('#subtickets, #attachments').tablesorter();
});

$('.js-check-periodic').on('click', function() {
  $('#ticket-period').prop('checked', true);
});

var defTime = '".date('H:i', strtotime('+5 minutes'))."';
var initialTimes = [];
var timefield = $('.js-time').first().clone();
$('.timepicker-field').each(function(i,el){initialTimes.push(el.value)});

$('#add_time').on('click', function() {
  $('.js-time-container').append(timefield.clone());
  var input = $('.js-time').last().find('input').val(defTime);
  input.timepicker({showSeconds: false, minuteStep: 1, showMeridian: false });
  $('.js-remove-time').removeClass('disabled');
});
$('form').on('click', '.js-remove-time', function() {
  if ($('form .js-time').length > 1) $(this).closest('.js-time').remove();
  if ($('form .js-time').length < 2) $('.remove').addClass('disabled');
});

$('.js-close-periodic').on('click', function(e) {
  $('#periodicModal .select2-hidden-accessible option').each(function(){
    this.selected = this.defaultSelected;
  });
  $('#periodicModal select').trigger('change');
  $('#periodicModal .select2-container').attr('style', 'width:100%');
  $('#month-check')[0].checked = $('#month-check')[0].defaultChecked;
  $('.js-time').remove();
  for (var i = 0, initialTime; initialTime = initialTimes[i]; i++) {
    $('.js-time-container').append(timefield.clone());
    var input = $('.js-time').last().find('input').val(initialTime);
    input.timepicker({showSeconds: false, minuteStep: 1, showMeridian: false });
  }
  if ($('form .js-time').length < 2) $('.remove').addClass('disabled');
});

setTimeout(function() {
  $('.field-message-inform .select2-search:first-of-type .select2-search__field').attr('style','width: '+$('#messages-realeffort').width() + 'px;');
  $('#periodicModal li:only-child .select2-search__field').attr('style','width: 135px;');
}, 10);
", $this::POS_READY, 'ajax');
?>
