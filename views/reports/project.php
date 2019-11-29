<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */

$this->context->layout = 'index-main';

$this->title = 'Сводка задач по проекту';

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
          'action' => Url::toRoute(['reports/project']),
          'enableClientValidation'=>false,
  ]);
  ?>
  <div class="row" style="padding-bottom: 1em;">
    <div class="col-sm-8 col-md-6">
      <label class="control-label" for="project_id">Проект:</label>
      <select id="project_id" class="form-control" name="Project_ID">
        <option value="">—</option>
      <?php foreach ($projects as $project): ?>
        <option value="<?=$project->Project_ID ?>"<?php if ($project->Project_ID == $currentProject) echo ' selected'; ?>><?=Html::encode("{$project->Name}") ?></option>
      <?php endforeach ?>
      </select>
    </div>
    <div class="col-sm-4">
      <label class="control-label">&nbsp;</label><br>
      <div class="form-group">
        <?= Html::submitButton('Сформировать', ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-default" href="<?=Html::encode(Url::toRoute([ 'reports/excel2', 'Project_ID'=>$currentProject,
                                                                        'creationdate0'=>$creationdate0, 'creationdate0'=>$creationdate0,
                                                                        'startdate0'=>$startdate0, 'startdate1'=>$startdate1,
                                                                        'estdate0'=>$estdate0, 'estdate1'=>$estdate1,
                                                                        ]))?>">В Excel</a>
      </div>
    </div>

    <div class="col-md-4 col-sm-6">
      <label class="control-label">Дата создания (с — по):</label>
      <div class="form-group row">
        <div class="col-md-6 col-xs-6">
        <?php
        echo DatePicker::widget([
            'name' => 'creationdate0',
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
            'name' => 'creationdate1',
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
    <div class="col-md-4 col-sm-6">
      <label class="control-label">Дата начала (с — по):</label>
      <div class="form-group row">
        <div class="col-md-6 col-xs-6">
        <?php
        echo DatePicker::widget([
            'name' => 'startdate0',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => $startdate0,
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
            'name' => 'startdate1',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => $startdate1,
            'language' => 'ru',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
?></div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6">
      <label class="control-label">Дата окончания (с — по):</label>
      <div class="form-group row">
        <div class="col-md-6 col-xs-6">
        <?php
        echo DatePicker::widget([
            'name' => 'estdate0',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => $estdate0,
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
            'name' => 'estdate1',
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
  </div>
  <?php ActiveForm::end(); ?>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped table-bordered tablesorter">
        <thead>
          <tr>
            <th><a class="tablesort">ID запроса</a></th>
            <th><a class="tablesort">Про&shy;дукт</a></th>
            <th><a class="tablesort">Под&shy;сис&shy;тема</a></th>
            <th style="width: 25%"><a class="tablesort">Тема запроса</a></th>
            <th><a class="tablesort">Испол&shy;нитель</a></th>
            <th><a class="tablesort">Дата начала</a></th>
            <th><a class="tablesort">Дата завер&shy;шения</a></th>
            <th><a class="tablesort">Текущее со&shy;сто&shy;яние</a></th>
            <th><a class="tablesort">Статус</a></th>
            <th><a class="tablesort">Кри&shy;тич&shy;ность</a></th>
            <th><a class="tablesort">Трудо&shy;ём&shy;кость</a></th>
            <th><a class="tablesort">Затра&shy;чен&shy;ное</a></th>
            <th><a class="tablesort">Дельта вре&shy;мени</a></th>
          </tr>
        </thead>
        <tbody>
<?php
  if (count($tickets) > 0) {
    foreach ($tickets as $ticket) { ?>
          <tr>
            <td><a href="<?=Html::encode(Url::toRoute(['site/'.$ticket->Ticket_ID]))?>"><?=$ticket->Ticket_ID?></a></td>            
            <td><?=$ticket->module->product->Name?></td>           
            <td><?=$ticket->module->Name?></td>
            <td><a href="<?=Html::encode(Url::toRoute(['site/'.$ticket->Ticket_ID]))?>"><?=$ticket->Subject?></a></td>
            <td><?=$ticket->assignedTo->name?></td>
            <td><?=substr($ticket->StartTime, 2, 8)?></td>
            <td><?=substr($ticket->EstTime, 2, 8)?></td>
            <td></td>
            <td><?=$ticket->status->Name?></td>
            <td><?=$ticket->priority->Name?></td>
            <td><?=number_format($ticket->EstEffort, 1, ',', ' ')?></td>
            <td><?=number_format($ticket->totalEffort, 1, ',', ' ')?></td>
            <td><?=number_format($ticket->totalEffort - $ticket->EstEffort, 1, ',', ' ')?></td>
          </tr>
<?php
    }
?>    
        </tbody>
        <tfoot>
          <tr>
            <td colspan="12"><b>Итого</b></td>
            <td><?=$sum?></td>
          </tr>
        </tfoot>
<?php
  }
  else {
    ?>
          <tr><td colspan="13" style="text-align:center">Нет данных</td></tr>
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