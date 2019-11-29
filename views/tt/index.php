<?php
/* @var $this yii\web\View */
$this->title = 'Система ведения абонентских запросов';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

?>
    <?php $form = ActiveForm::begin([
              'method' => 'get',
              'action' => Url::toRoute(['tt/index']),
              'enableClientValidation'=>false,
    ]);
    ?>
    <div class="row">
      <div class="col-md-12">
         <h2>Поиск запроса</h2>
      </div>
      <div class="col-lg-8 col-sm-7 col-xs-12 ticket-filter ticket-filter-ext">
         <?= $form->field($message, 'Text')->textInput(['maxlength' => true])->label('Содержание запроса:') ?>
      </div>
      <div class="col-lg-2 col-sm-3 col-xs-8 ticket-filter">
        <span class="ext-search-expander js-ext-search-expander">Расширенный поиск</span>
      </div>
      <div class="col-sm-2 col-xs-4">
        <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary center-block', 'style' => 'width: 100%']) ?></div>
      </div>
    </div>
    <div class="row ext-search">
      <div class="col-sm-4 ticket-filter">
        <?= $form->field($filter, 'Ticket_ID')->textInput()->label('ID запроса') ?>
      </div>
      <div class="col-sm-4 ticket-filter">
        <label class="control-label">Дата создания (с — по):</label>
        <div class="form-group row mini">
          <div class="col-md-6 col-xs-6">
          <?php
          echo DatePicker::widget([
              'name' => 'Ticket[creationdate0]',
              'type' => DatePicker::TYPE_COMPONENT_APPEND,
              'value' => $creationdate0,
              'language' => 'ru',
              'pluginOptions' => [
                  'autoclose'=>true,
                  'format' => 'yyyy-mm-dd'
              ]
          ]);
          ?></div>
            <div class="col-md-6 col-xs-6">
            <?php
          echo DatePicker::widget([
              'name' => 'Ticket[creationdate1]',
              'type' => DatePicker::TYPE_COMPONENT_APPEND,
              'value' => $creationdate1,
              'language' => 'ru',
              'pluginOptions' => [
                  'autoclose'=>true,
                  'format' => 'yyyy-mm-dd'
              ]
          ]);
  ?></div>
        </div>
      </div>
      <div class="col-sm-4 ticket-filter">
        <label class="control-label">Дата окончания (с — по):</label>
        <div class="form-group row mini">
          <div class="col-xs-6">
          <?php
          echo DatePicker::widget([
              'name' => 'Ticket[estdate0]',
              'type' => DatePicker::TYPE_COMPONENT_APPEND,
              'value' => $estdate0,
              'language' => 'ru',
              'pluginOptions' => [
                  'autoclose'=>true,
                  'format' => 'yyyy-mm-dd'
              ]
          ]);
          ?></div>
            <div class="col-xs-6">
            <?php
          echo DatePicker::widget([
              'name' => 'Ticket[estdate1]',
              'type' => DatePicker::TYPE_COMPONENT_APPEND,
              'value' => $estdate1,
              'language' => 'ru',
              'pluginOptions' => [
                  'autoclose'=>true,
                  'format' => 'yyyy-mm-dd'
              ]
          ]);
  ?></div>
        </div>
      </div>
      
      <div class="col-sm-4 ticket-filter">
        <div class="form-group field-ticket-product_id">
          <label class="control-label" for="ticket-product_id">Причина обращения:</label>
          <select id="ticket-module_id" class="form-control" name="Ticket[Module_ID]">
            <option value="">—</option>
          <?php foreach ($modules as $module): ?>
            <option value="<?=$module->Module_ID ?>" data-up="<?=$module->Product_ID ?>"<?php if ($module->Module_ID == $filter->Module_ID) echo ' selected'; ?>><?=Html::encode("{$module->product->Name}") ?></option>
          <?php endforeach ?>
          </select>
          <div class="help-block"></div>
        </div>
      </div>
      <div class="col-sm-4 ticket-filter">
        <?= $form->field($filter, 'Status_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Status::find()->all(), 'Status_ID', 'Name' ),
    'options' => [
        'placeholder' => 'Выберите статусы',
        'multiple' => true,
    ],
    'theme' => Select2::THEME_DEFAULT,
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Статус:');
?>
      </div>
      <div class="col-sm-4 ticket-filter">
        <?= $form->field($filter, 'Priority_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Priority::find()->all(), 'Priority_ID', 'Name' ),
    'options' => [
        'placeholder' => 'Выберите критичности',
        'multiple' => true,
    ],
    'theme' => Select2::THEME_DEFAULT,
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Приоритет:');
?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
    <hr>
    <div class="row">
      <div class="col-sm-12">
        <?php
        if ($canCreate) { ?>
        <div>
          <a class="btn btn-success pull-right" href="<?=Url::toRoute(['tt/create']) ?>"><span class="h1">Новая заявка</span></a>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">

        <h2 class=center-block"><?php
          if ($filterEmpty) {
            ?>Мои заявки</p><?php
          }
          else {
            ?>Найденные заявки</p><?php
          }
        ?></h2>

        <div class="pull-left"><?= LinkPager::widget(['pagination' => $pages]); ?></div>

      </div>
    </div>

    <div class="row">
      <div class="col-sm-12"><?php
    
    if (count($tickets) < 1) {
      if ($filterEmpty) {
        ?><p>Вы еще не создавали заявок.</p><?php
      }
      else {
        ?><p>По вашему запросу заявок не найдено.</p><?php
      }
    }
    else {
      ?>
        <table id="requests" class="table table-striped table-bordered tablesorter">
          <thead>
            <tr>
              <th class="header"><a class="tablesort">№ заявки</a></th>
              <th class="header"><a class="tablesort">Дата создания</a></a> 
              <th class="header"><a class="tablesort">Причина обращения</a></th>
              <th class="header"><a class="tablesort">Приоритет</a></th>
              <th class="header"><a class="tablesort">Статус</a></th>
              <th class="header"><a class="tablesort">Содержание</a></th>
            </tr>
          </thead>
          <tbody><?php
      foreach ($tickets as $ticket):
        ?>
          <tr>
            <td><a href="<?=Html::encode(Url::toRoute(['tt/view', 'id' => $ticket->Ticket_ID])) ?>"><?=$ticket->Ticket_ID ?></a></td>
            <td><a href="<?=Html::encode(Url::toRoute(['tt/view', 'id' => $ticket->Ticket_ID])) ?>"><?=date('d.m.Y в H:i', strtotime($ticket->CreationTime)) ?></a></td>
            <td><a href="<?=Html::encode(Url::toRoute(['tt/view', 'id' => $ticket->Ticket_ID])) ?>"><?=$ticket->module->product->Name ?></a></td>
            <td class="mark_pr<?=$ticket->Priority_ID ?>"><a href="<?=Html::encode(Url::toRoute(['tt/view', 'id' => $ticket->Ticket_ID])) ?>"><?=Html::encode("{$ticket->priority->Name}") ?></a></td>
            <td class="mark<?=$ticket->Status_ID ?>"><a href="<?=Html::encode(Url::toRoute(['tt/view', 'id' => $ticket->Ticket_ID])) ?>"><?=Html::encode("{$ticket->status->Name}") ?></a></td>
            <td><a href="<?=Html::encode(Url::toRoute(['tt/view', 'id' => $ticket->Ticket_ID])) ?>"><?=\yii\helpers\StringHelper::truncate(strip_tags("{$ticket->messages[0]->Text}"), 30, '...') ?></a></td>
          </tr>
<?php
      endforeach;
      ?></tbody>
        </table><?php
    }

    echo LinkPager::widget(['pagination' => $pages,]);
 ?>

        </div>
      </div>
<?php
$this->registerCss('
#requests > tbody a {
  display: block;
}
#requests > tbody > tr:hover a {
  text-decoration: underline;
}
#requests [class^=mark] > a {
  color: inherit;
}

');
$this->registerJsFile('@web/js/jquery.tablesorter.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("
$(function() {
  $('#requests').tablesorter();
});
".
($filterExtended ? "$('.ext-search').show();" : '').
"
$('.js-ext-search-expander').on('click', function() {
  $('.ext-search').slideToggle();
});

setTimeout(function() {
  $('.select2-search:first-of-type .select2-search__field').attr('style','width: calc('+$('.select2-selection').width() + 'px - 1em)');
}, 10);
");