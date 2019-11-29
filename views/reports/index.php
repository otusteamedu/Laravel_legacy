<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */

$this->context->layout = 'index-main';

$this->title = 'Отчеты';

//echo '<pre>'; var_dump($tickets); echo '</pre>';

?>

  <div class="row">
    <div class="col-md-12">
    <h1><?=$this->title ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <p><a href="<?=Html::encode(Url::toRoute(['reports/breakdown'])) ?>">Отчет о затраченном времени</a></p>
      <p><a href="<?=Html::encode(Url::toRoute(['reports/my'])) ?>">Отчет о моем затраченном времени</a></p>
      <p><a href="<?=Html::encode(Url::toRoute(['reports/project'])) ?>">Сводка задач по проекту</a></p>
    </div>
  </div>
</div>