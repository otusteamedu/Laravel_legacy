<?php

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

$this->context->layout = 'index-main';

$this->title = 'Добро пожаловать на сайт support.someproject.by!';

?>

<div class="row">
  <div class="col-md-9">
  <h1><?=$this->title ?></h1>
  <p>Сайт предназначен для принятия и ведения запросов от компаний, сотрудничающих с ООО «Ньюлэнд». Для работы с запросами воспользуйтесь фильтром:</p>
  
  <div class="row extra-spacing">
    <div class="col-md-12">
      <a href="<?=Html::encode(Url::toRoute(['site/index'])) ?>">Все активные запросы (<?=$overall?>)</a>
    </div>
  </div>
  <div class="row extra-spacing">
    <div class="col-md-3">
      <b><a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[Author]' => $user->user_id])) ?>">Я — автор (<?=$my?>)</a>:</b>
    </div>
    <div class="col-md-3">
      из них: <a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[Author]' => $user->user_id, 'Ticket[Status_ID]' => 1])) ?>">Открытые (<?=$my_open?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[Author]' => $user->user_id, 'Ticket[Status_ID]' => 2])) ?>">Взяты в работу (<?=$my_on?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[Author]' => $user->user_id, 'Ticket[Priority_ID]' => [3,4]])) ?>">Критичные (<?=$my_critical?>)</a>
    </div>
  </div>
  <div class="row extra-spacing">
    <div class="col-md-3">
      <b><a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[AssignedTo]' => $user->user_id])) ?>">Я — исполнитель (<?=$forme?>)</a>:</b>
    </div>
    <div class="col-md-3">
       из них: <a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[AssignedTo]' => $user->user_id, 'Ticket[Status_ID]' => 1])) ?>">Открытые (<?=$forme_open?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[AssignedTo]' => $user->user_id, 'Ticket[Status_ID]' => 2])) ?>">Взяты в работу (<?=$forme_on?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'Ticket[AssignedTo]' => $user->user_id, 'Ticket[Priority_ID]' => [3,4]])) ?>">Критичные (<?=$forme_critical?>)</a>
    </div>
  </div>
  <div class="row extra-spacing">
    <div class="col-md-3">
      <b><a href="<?=Html::encode(Url::toRoute(['site/index', 'mytickets' => 1])) ?>">C моим участием (<?=$withme?>)</a>:</b>
    </div>
    <div class="col-md-3">
       из них: <a href="<?=Html::encode(Url::toRoute(['site/index', 'mytickets' => 1, 'Ticket[Status_ID]' => 1])) ?>">Открытые (<?=$withme_open?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'mytickets' => 1, 'Ticket[Status_ID]' => 2])) ?>">Взяты в работу (<?=$withme_on?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'mytickets' => 1, 'Ticket[Priority_ID]' => [3,4]])) ?>">Критичные (<?=$withme_critical?>)</a>
    </div>
  </div>
  <div class="row extra-spacing">
    <div class="col-md-3">
      <b><a href="<?=Html::encode(Url::toRoute(['site/index', 'favorite' => 1])) ?>">Избранные (<?=$favorite?>)</a>:</b>
    </div>
    <div class="col-md-3">
       из них: <a href="<?=Html::encode(Url::toRoute(['site/index', 'favorite' => 1, 'Ticket[Status_ID]' => 1])) ?>">Открытые (<?=$favorite_open?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'favorite' => 1, 'Ticket[Status_ID]' => 2])) ?>">Взяты в работу (<?=$favorite_on?>)</a>
    </div>
    <div class="col-md-3">
      <a href="<?=Html::encode(Url::toRoute(['site/index', 'favorite' => 1, 'Ticket[Priority_ID]' => [3,4]])) ?>">Критичные (<?=$favorite_critical?>)</a>
    </div>
  </div>
  <div class="row extra-spacing">
     <div class="col-md-12 extra-spacing">
<?php

echo Highcharts::widget([
   'options'=>[
        "chart"=>[
            "plotBackgroundColor"=>null,
            "plotBorderWidth"=>null,
            "plotShadow"=>false,
            "type"=>"pie",
            "animation"=>["duration"=>300, "easing"=>"swing"],
        ],
        "title"=>[
            "text"=>"Статистика запросов"
        ],
        "tooltip"=>[
            "pointFormat"=>"{series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)"
        ],
        "plotOptions"=>[
            "pie"=>[
                "allowPointSelect"=>true,
                "cursor"=>"pointer",
                "dataLabels"=>[
                    "enabled"=>true,
                    "format"=>"<b>{point.name}</b>: {point.y}",
                    "style"=>[
                        "color"=>"black"
                    ]
                ]
            ]
        ],
        "series"=>[[
            "name"=>"запросы",
            "colorByPoint"=>true,
            "data"=>$data,
            "animation"=>["duration"=>400, "easing"=>"swing"],
        ]]
    ]
]);

?>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <h2>Новости компании</h2>
    <p>На сегодня новостей нет.</p>
	<!--
    <p><i>02.02.2016.</i> Портал support.someproject.by опять обновился. На веб-портал были внесены следующие изменения:
<p>1. Появилась возможность сортировать подзапросы по любому из доступных полей.</p>
<p>2. Изменилась сортировка запросов. Запросы со статусом «Выполнено» (после проверки выполнения их нужно закрывать) будут расположены после запросов со статусом «Взят в работу».</p>
<p>3. На странице просмотра запроса добавлено поле «Планируемая дата выполнения».</p>
<p>4. На странице просмотра запроса, в разделе «Результат выполнения», добавлено поле с ФИО исполнителя данного запроса.</p>
 Если у вас возникли проблемы с отображением портала, попробуйте обновить страницу с помощью Ctrl+F5.</p>
	-->
  </div>
</div>

<?php

$this->registerCss("
.users-view-panel { display: flex; width: 100%; }
.users-view-item { margin-left: 40px; flex: 1 1 auto; }
.img-group { width: 200px; height: 200px; position: relative; margin-bottom: 1em; }
.img-group-avatar { position: absolute; max-width: 200px; max-height: 200px; top: 0; right: 0; bottom: 0; left: 0; margin: auto; }
.module-title span { vertical-align: middle; text-align: center; min-width: 5em; padding: 0 .5em; }
.project-table { display: table; width: 100%; border-collapse: collapse; border: 1px solid #ddd; border-width: 0 1px 1px; position: relative; }
.project-table::before { content: ''; position: absolute; top: 0; right: 0; bottom: 0; left: 0; border: 1px solid #ddd; z-index: -1; }
:-webkit-any(u), .project-table::before { right: -1px; bottom: -1px; }
.module-group { display: table-row-group; }
.project-row, .product-row { display: table-row-group; font-weight: bold; white-space: nowrap; cursor: pointer; }
.project-row { font-size: 1.1em; }
.project-row span, .product-row span { display: inline-block; white-space: normal; vertical-align: top; padding: .5em 0 .2em; }
.project-row::before { padding-left: 10px; }
.product-row::before { padding-left: 25px; }
.project-row::before, .product-row::before { display: inline-block; content: '▼'; padding-right: .5em; vertical-align: top; padding-top: .5em; }
.group-closed::before { content: '►'; padding-right: .5em; }
.module-row { display: table-row; }
.module-row:nth-of-type(odd) { background: #f9f9f9; }
.module-row span { display: table-cell; border: 1px solid #ddd; }
.module-name { padding-left: 40px; }
.module-right { font-weight: bold; text-align: center; }
");
$this->registerJs("
  $('.product-row, .module-group').hide();
  //$('.project-row span, .product-row span').width('calc(80% + ' + ($('.project-table').width() - $('.module-name').width()) + 'px)');
  $('.product-row').click(function(e) {
    $(this).next().toggle();
    $(this).toggleClass('group-closed');
  });
  $('.project-row').addClass('group-closed').click(function(e) {
    var gr = $(this).attr('data-toggle');
    $(this).toggleClass('group-closed');
    $(this).hasClass('group-closed') ? $('.'+gr).hide() : $('.'+gr).show();

  });
  ", $this::POS_READY, 'tree');
?>