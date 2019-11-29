<?php
/* @var $this yii\web\View */
$this->title = 'Система ведения абонентских запросов';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

?>
<div class="site-index">

  <div class="body-content">

    <div class="row">
      <div class="col-md-12">
        <?php if ($root_ticket): ?>
         <a href="<?=Url::toRoute(['site/index'])?>">Назад к списку АЗ</a> » <a href="<?=Url::toRoute(['site/view', 'id' => $root_ticket->Ticket_ID]) ?>"><b>#<?=$root_ticket->Ticket_ID ?></b>: <?=Html::encode("{$root_ticket->Subject}") ?></a>
        <?php endif ?>
      </div>
    </div>
    <?php $form = ActiveForm::begin([
              'method' => 'get',
              'action' => Url::toRoute(['site/index']),
              'enableClientValidation'=>false,
    ]);
    ?>
    <div class="row">
      <div class="col-md-12">
         <h2>Поиск запроса</h2>
      </div>
      <div class="col-lg-1 col-sm-4 ticket-filter">
        <?= $form->field($filter, 'Ticket_ID')->textInput()->label('ID запроса') ?>
      </div>
      <div class="col-lg-3 col-sm-8 ticket-filter">
         <?= $form->field($filter, 'Subject')->textInput(['maxlength' => true])->label('Тема запроса') ?>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 ticket-filter">
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
      <div class="col-lg-3 col-md-4 col-sm-6 ticket-filter">
        <label class="control-label">Дата окончания (с — по):</label>
        <div class="form-group row mini">
          <div class="col-md-6 col-xs-6">
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
            <div class="col-md-6 col-xs-6">
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
      <div class="col-lg-2 col-sm-4 ticket-filter">
        <hr>
        <span class="ext-search-expander js-ext-search-expander">Расширенный поиск</span>
      </div>
    </div>
    <div class="row ext-search">
      <div class="col-md-8 ticket-filter ticket-filter-ext">
         <?= $form->field($message, 'Text')->textInput(['maxlength' => true])->label('Содержание запроса:') ?>
      </div><div class="col-sm-4 ticket-filter ticket-filter-ext">
        <div class="form-group">
        <label class="control-label" for="myTickets" style="width: auto;">C моим участием:</label>
        <?= Html::checkbox('mytickets', $myTickets, ['id' => 'myTickets', 'style' => 'align-self:baseline;margin:.5em 2em 0 1em']); ?>
        <label class="control-label" for="favoriteTickets" style="width: auto;">Избранные:</label>
        <?= Html::checkbox('favorite', $favoriteTickets, ['id' => 'favoriteTickets', 'style' => 'align-self:baseline;margin:.5em 0 0 1em']); ?>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 ticket-filter ticket-filter-ext" style="clear:left">
        <div class="form-group field-ticket-project_id">
          <label class="control-label" for="ticket-project_id">Проект:</label>
          <select id="ticket-project_id" class="form-control" name="Ticket[Project_ID]">
            <option value="">—</option>
          <?php foreach ($projects as $project): ?>
            <option value="<?=$project->Project_ID ?>"<?php if ($project->Project_ID == $currentProject) echo ' selected'; ?>><?=Html::encode("{$project->Name}") ?></option>
          <?php endforeach ?>
          </select>
          <div class="help-block"></div>
        </div>
        <div class="form-group field-ticket-product_id">
          <label class="control-label" for="ticket-product_id">Продукт/Набор услуг:</label>
          <select id="ticket-product_id" class="form-control" name="Ticket[Product_ID]">
            <option value="">—</option>
          <?php foreach ($products as $product): ?>
            <option value="<?=$product->Product_ID ?>" data-up="<?=$product->Project_ID ?>"<?php if ($product->Product_ID == $currentProduct) echo ' selected'; ?>><?=Html::encode("{$product->Name}") ?></option>
          <?php endforeach ?>
          </select>
          <div class="help-block"></div>
        </div>
        <div class="form-group field-ticket-module_id">
          <label class="control-label" for="ticket-module_id">Подсистема/Услуга:</label>
          <select id="ticket-module_id" class="form-control" name="Ticket[Module_ID]">
            <option value="">—</option>
          <?php foreach ($modules as $module): ?>
            <option value="<?=$module->Module_ID ?>" data-up="<?=$module->Product_ID ?>"<?php if ($module->Module_ID == $filter->Module_ID) echo ' selected'; ?>><?=Html::encode("{$module->Name}") ?></option>
          <?php endforeach ?>
          </select>
          <div class="help-block"></div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 ticket-filter ticket-filter-ext">
        <?= $form->field($filter, 'Author')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($authors, 'user_id', 'name' ),
    'options' => [
        'placeholder' => 'Выберите авторов',
        'multiple' => true,
    ],
    'theme' => Select2::THEME_DEFAULT,
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Автор:');
?>
        <?= $form->field($filter, 'AssignedTo')->widget(Select2::classname(), [
    'data' => ArrayHelper::map($editors, 'user_id', 'name' ),
    'options' => [
        'placeholder' => 'Выберите исполнителей',
        'multiple' => true,
    ],
    'theme' => Select2::THEME_DEFAULT,
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Исполнитель:');
?>
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
      <div class="col-md-4 col-sm-6 ticket-filter ticket-filter-ext">
        <?= $form->field($filter, 'Type_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Type::find()->all(), 'Type_ID', 'Name' ),
    'options' => [
        'placeholder' => 'Выберите типы',
        'multiple' => true,
    ],
    'theme' => Select2::THEME_DEFAULT,
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Тип:');
?>
        <?= $form->field($filter, 'Category_ID')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Categories::find()->all(), 'Category_ID', 'Name' ),
    'options' => [
        'placeholder' => 'Выберите категории',
        'multiple' => true,
    ],
    'theme' => Select2::THEME_DEFAULT,
    'language' => 'ru',
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Категория:');
?>
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
])->label('Критичность:');
?>
      </div>
    </div>
    <div class="row filter-block">
      <div class="col-md-7 col-sm-12 ticket-filter ticket-filter-ext">
        <div class="form-group">
        <label class="control-label" for="w5">Сортировать сначала:</label>
                      <?php
        $sortItems = ['0'=>'Без сортировки', 'Status'=>'По статусу', 'Priority'=>'По критичности', 'Author'=>'По автору', 'Assignee'=>'По исполнителю', 'Type'=>'По типу', 'Category'=>'По категории', 'StartDate'=>'По дате создания', 'ChangedDate'=>'По дате последнего изменения', ];
        echo Select2::widget([
    'name' => 'SortBy[0]',
    'language' => 'ru',
    'value' => isset($sortSettings[0]) ? $sortSettings[0] : '',
    'attribute' => 'User_ID',
    'data' => $sortItems,
    'theme' => Select2::THEME_DEFAULT,
]);
    ?>
        <label class="control-label" for="w6" style="width: auto;"> затем: </label>
    <?php
        echo Select2::widget([
    'name' => 'SortBy[1]',
    'language' => 'ru',
    'value' => isset($sortSettings[1]) ? $sortSettings[1] : '',
    'attribute' => 'User_ID',
    'data' => $sortItems,
    'theme' => Select2::THEME_DEFAULT,
]);
    ?>
        <label class="control-label" for="w7" style="width: auto;"> и наконец: </label>
    <?php
        echo Select2::widget([
    'name' => 'SortBy[2]',
    'language' => 'ru',
    'value' => isset($sortSettings[2]) ? $sortSettings[2] : '',
    'attribute' => 'User_ID',
    'data' => $sortItems,
    'theme' => Select2::THEME_DEFAULT,
]);
?>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 ticket-filter ticket-filter-ext">
        <div class="form-group reference-width">
        <label class="control-label" for="hideSub">Скрыть подзапросы:</label>
        <?= Html::checkbox('hideSubtickets', $hideSubtickets, ['id' => 'hideSub', 'style' => 'align-self:baseline;margin-top:.5em']); ?>
        </div>
      </div>
      <div class="col-md-1 col-sm-6">
        <div class="form-group pull-right"><?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?></div>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

    <?php Pjax::begin(); ?>
    <div class="row">
      <div class="col-sm-12">
        <?php
        if ($canCreate) { ?>
        <div class="pull-right new-ticket-button">
          <a class="btn btn-success" href="<?=Url::toRoute(['site/create']) ?>">Новый запрос</a>
        </div>
        <?php
        }
        ?>

        <?php if ($root_ticket) { ?>
         <h2>Список подзапросов <a href="<?=Url::toRoute(['site/view', 'id' => $root_ticket->Ticket_ID]) ?>">#<?=$root_ticket->Ticket_ID ?>: <?=Html::encode("{$root_ticket->Subject}") ?></a></h2>
        <?php } else { ?>
          <h2>Список абонентских запросов</h2>
        <?php } ?>

        <div class="pull-left"><?= LinkPager::widget(['pagination' => $pages]); ?></div>

      </div>
    </div>

    <div class="row">
      <div class="col-sm-12"><?php

      foreach ($tickets as $ticket):
        ?>
        <div class="ticket" id="ticket<?=$ticket->Ticket_ID ?>">
          <div class="ticket-main">
            <div class="ticket-title"><a href="<?=Html::encode(Url::toRoute(['site/view', 'id' => $ticket->Ticket_ID])) ?>">#<?=$ticket->Ticket_ID ?> <?=Html::encode("{$ticket->Subject}") ?></a></div>
            <div class="ticket-date">
              Создан <?=date('d.m.Y в H:i', strtotime($ticket->CreationTime)) ?> пользователем <a title="Автор: <?=Html::encode("{$ticket->author->name}") ?>" href="<?=Html::encode(Url::toRoute(['profile/alien', 'id' => $ticket->author->id])) ?>" ><?=Html::encode("{$ticket->author->name}") ?></a>,
              <?=$ticket->EstTime ? ' планируется завершить ' . date('d.m.Y в H:i', strtotime($ticket->EstTime)) : 'дата завершения не определена' ?>
            </div>
            <div class="ticket-project" title="Проект: <?=Html::encode("{$ticket->module->product->project->Name}") ?>"><div class="ticket-innerwrap"><?=Html::encode("{$ticket->module->product->project->Name}") ?></div></div>
            <div class="ticket-product" title="Продукт/Набор услуг: <?=Html::encode("{$ticket->module->product->Name}") ?>"><div class="ticket-innerwrap"><?=Html::encode("{$ticket->module->product->Name}") ?></div></div>
            <div class="ticket-module" title="Подсистема/Услуга: <?=Html::encode("{$ticket->module->Name}") ?>"><div class="ticket-innerwrap"><?=Html::encode("{$ticket->module->Name}") ?></div></div>
          </div>
          <div class="ticket-meta">
            <div class="ticket-item">
              <a title="Исполнитель: <?=Html::encode("{$ticket->assignedTo->name}") ?>" href="<?=Html::encode(Url::toRoute(['profile/alien', 'id' => $ticket->assignedTo->id])) ?>"><?=Html::encode("{$ticket->assignedTo->name}") ?></a>
            </div>

            <div class="ticket-item" title="Тип: <?=Html::encode("{$ticket->type->Name}") ?>"><div class="ticket-innerwrap"><?=Html::encode("{$ticket->type->Name}") ?></div></div>
            <div class="ticket-item mark_pr<?=$ticket->Priority_ID ?>" title="Критичность: <?=Html::encode("{$ticket->priority->Name}") ?>"><div class="ticket-innerwrap"><?=Html::encode("{$ticket->priority->Name}") ?></div></div>
            <div class="ticket-item mark<?=$ticket->Status_ID ?>" title="Статус: <?=Html::encode("{$ticket->status->Name}") ?>"><div class="ticket-innerwrap"><?=Html::encode("{$ticket->status->Name}") ?></div></div>
            <div class="ticket-item">
            <?php if (($subs = count($ticket->tickets)) > 0) {
            $plural=($subs%10==1 && $subs%100!=11 ? 0 : ($subs%10>=2 && $subs%10<=4 && ($subs%100<10 || $subs%100>=20) ? 1 : 2));
            $forms = ['подзапрос','подзапроса','подзапросов'];
            echo '<a href="' . Html::encode(Url::toRoute(['site/index', 'Ticket[DependsOn]' => $ticket->Ticket_ID])).'" class="ticket-subitems js-subitems">' . $subs . ' ' . $forms[$plural] . '</a>';
          }
          else {
            echo 'Нет подзапросов';
          }?>
            </div>
          </div>
        </div>

<?php
      endforeach;

      echo LinkPager::widget(['pagination' => $pages,]);
 ?>

        </div>
      </div>
    <?php Pjax::end(); ?>
  </div>
</div>
<?php
  $this->registerJs("

  $('body').on('change', '#ticket-project_id', function(event) {
    if ($('#ticket-module_id')) $('#ticket-module_id').empty().prop('disabled', true);
    if ($('#ticket-product_id')) $('#ticket-product_id').empty().prop('disabled', true);
    $('body').css('cursor','wait');
    var obj = this, id = this.value;
    var jqxhr = $.ajax('". Url::toRoute(['site/productlist', 'Project_ID' => '']). "' + id)
    .done(function(data) {
      $('#ticket-product_id').html(data).prop('disabled', false);
      $('#ticket-module_id').html('<option value=\"\">Сначала выберите продукт/набор услуг</option>').prop('disabled', true);
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
    $('body').css('cursor','wait');
    var obj = this, id = this.value;
    var jqxhr = $.ajax('". Url::toRoute(['site/modulelist', 'Product_ID' => '']). "' + id)
    .done(function(data) {
      $('#ticket-module_id').html(data).prop('disabled', false);
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
  ".
  ($filterExtended ? "$('.ext-search').show();" : '').
  "
  $('.js-ext-search-expander').on('click', function() {
    $('.ext-search').slideToggle();
  });

  setTimeout(function() {
    $('.select2-search:first-of-type .select2-search__field').attr('style','width: calc('+$('.reference-width').width() + 'px - 12em)');
  }, 10);
", $this::POS_READY, 'ajax');
?>
