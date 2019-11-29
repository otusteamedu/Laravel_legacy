<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = "Найстрока периода";

?>
<div style='width:500px;'>
<div class="projects-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="form-group field-message-inform">
                      <label class="control-label" for="message-inform">Годы:</label>
                      
                      <?= Select2::widget([
                          'name' => 'inform_once',
                          'language' => 'ru',
                          'attribute' => 'years',
                          'data' => ArrayHelper::map($array_of_years, 'id', 'data'),
                          'theme' => Select2::THEME_DEFAULT,
                          'options' => [
                              'placeholder' => 'Введите имя получателя или выберите из списка',
                              'multiple' => true,
                          ],
                          ]);
                      ?>
                    </div>
   
   

</div>
    </div>
<?php $this->registerCss("td {padding:5px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 11px;} "
        . "");