<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */

$this->context->layout = 'index-main';

$this->title = 'Отчет о затраченном времени';

//echo '<pre>'; var_dump($tickets); echo '</pre>';

?>

  <div class="row">
      <div class="col-lg-12">
        <a href="<?=Html::encode(Url::toRoute(['reports/']))?>">Назад к списку отчетов</a>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">
    <h1><?=$this->title ?></h1>
    </div>
  </div>
  <?php $form = ActiveForm::begin([
          'method' => 'get',
          'action' => Url::toRoute(['reports/others']),
          'enableClientValidation'=>false,
  ]);
  ?>
  <div class="row" style="padding-bottom: 1em;">
    <div class="col-sm-8 col-md-4">
        <label class="control-label" for="users">Выбрать пользователей:</label>
        <?= Select2::widget([
    'name' => 'users',
    'language' => 'ru',
    'value' => $selected_users,
    'attribute' => 'User_ID',
    'data' => ArrayHelper::map($users, 'user_id', 'name'),
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => 'Введите имя получателя или выберите из списка',
        'multiple' => true
    ],
]);
        ?>
    </div>
    <div class="col-sm-8 col-md-5" style="padding: 0 20px">
        <label class="control-label">Период:</label>
        <?php
        $layout3 = <<< HTML
    <span class="input-group-addon">с </span>
    {input1}
    <span class="input-group-addon"> по </span>
    {input2}
    <span class="input-group-addon kv-date-remove">
        <i class="glyphicon glyphicon-remove"></i>
    </span>
HTML;
        echo DatePicker::widget([
          'type' => DatePicker::TYPE_RANGE,
          'name' => 'from',
          'value' => $from,
          'name2' => 'to',
          'value2' => $to,
          'separator' => '',
          'layout' => $layout3,
          'pluginOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
          ]
      ]);
        ?>
    </div>
    <div class="col-md-3 col-sm-4">
      <label class="control-label">&nbsp;</label><br>
      <div class="form-group">
        <?= Html::submitButton('Сформировать', ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-default" href="<?=Html::encode(Url::toRoute(['reports/excel', 'users'=>$selected_users, 'from'=>$from, 'to'=>$to]))?>">В Excel</a>
      </div>
      <?php

      ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped table-bordered tablesorter">
        <thead>
          <tr>
            <th><a class="tablesort">ID запроса</a></th>
            <th style="width: 25%"><a class="tablesort">Тема запроса</a></th>
            <th><a class="tablesort">Проект</a></th>
            <th><a class="tablesort">Автор</a></th>
            <th><a class="tablesort">Статус</a></th>
            <th><a class="tablesort">Критичность</a></th>
            <th><a class="tablesort">Затраченное время</a></th>
          </tr>
        </thead>
        <tbody>
<?php
  if (count($tickets) > 0) {
    foreach ($tickets as $ticket) { ?>
          <tr>
            <td><a href="<?=Html::encode(Url::toRoute(['site/'.$ticket->Ticket_ID]))?>"><?=$ticket->Ticket_ID?></a></td>
            <td><a href="<?=Html::encode(Url::toRoute(['site/'.$ticket->Ticket_ID]))?>"><?=$ticket->Subject?></a></td>
            <td><?=$ticket->module->product->project->Name?></td>
            <td><?=$ticket->author->name?></td>
            <td><?=$ticket->status->Name?></td>
            <td><?=$ticket->priority->Name?></td>
            <td><?=number_format($ticket->totalEffort, 1, ',', ' ')?></td>
          </tr>
<?php
    }
?>    
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6"><b>Итого</b></td>
            <td><?=$sum?></td>
          </tr>
        </tfoot>
<?php
  }
  else {
    ?>
          <tr><td colspan="7" style="text-align:center">Нет данных</td></tr>
        </tbody>
    <?php
  }
?>    
      </table>
    </div>
  </div>
</div>
<?php
$this->registerCss("
.table > thead > tr > th { vertical-align: top; }
th.header:not(#magic) { padding-right: 1em; }
.headerSortUp:after, .headerSortDown:after { display: inline-block; margin-right: -100%; }
");
$this->registerJsFile('@web/js/jquery.tablesorter.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("
$(function() {
  $('.tablesorter').tablesorter();
});");