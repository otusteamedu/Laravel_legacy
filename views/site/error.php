<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

if ($exception->statusCode == '404') {
  $this->title = 'Страница не найдена (ошибка 404)';
  AppAsset::register($this);
  
  $this->context->layout = 'index-main';
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:200px;">
                    <p>Возможно, вы перешли по устаревшей ссылке или ошиблись при вводе.</p>
                    <p>Попробуйте еще раз поискать нужную информацию в <a href="<?=Url::toRoute(['site/index']) ?>">системе заявок</a> или <a href="<?=Url::toRoute(['site/wiki']) ?>" >Wiki</a>.</p>
                </div>
            </div>
<?php
}
elseif ($exception->statusCode == '403') {
  $this->title = 'Извините, у вас нет доступа (ошибка 403)';
  AppAsset::register($this);
  
  $this->context->layout = 'index-main';
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:200px;">
                    <p>Вам не хватает прав доступа для просмотра этой страницы. Возможно, вы перешли по устаревшей ссылке или ошиблись при вводе.</p>
                    <p>Попробуйте поискать нужную информацию в <a href="<?=Url::toRoute(['site/index']) ?>">системе заявок</a> или <a href="<?=Url::toRoute(['site/wiki']) ?>" >Wiki</a>, либо обратитесь в службу поддержки.</p> 
                </div>
            </div>
<?php
}
else {
  
$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
<?php
}
?>
