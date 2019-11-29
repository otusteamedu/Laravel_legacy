<?php
/* @var $this yii\web\View */
$this->title = 'Wiki';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>
        <div class="row">
          <div class="col-md-2">
                <div class="fixedmenu">
                    <p><b>О компании</b></p>
                    <p><a href="<?=Url::toRoute(['site/wikitrebov']) ?>">Общие требования по работе с запросами</a></p>
                    <p><a href="<?=Url::toRoute(['site/wikiregistration']) ?>">Руководство пользователя</a></p>
<?php if ($internal_user) { ?>
                    <p><a href="<?=Url::toRoute(['site/wikispravochnik']) ?>">Справочник Типовых запросов</a></p>
<?php } ?>
                </div>
          </div>

                 <div class="col-md-6">

<h1>О компании</h1>
<p>ООО «НЬЮЛЭНД» работает в сфере телекоммуникаций с 1996 года и является одной из первых телекоммуникационных компаний в Республике Беларусь.</p>
<p>Мы созданы и работаем для того, чтобы предоставлять в области телекоммуникаций товары и услуги новейших технологий высокого качества с полным сервисом, обеспечивая тем самым реальную поддержку деловой активности и хорошее настроение наших клиентов. Цель компании – действовать оперативно и гибко, стараясь предвосхищать потребности завтрашнего дня и добиваться высочайшего качества предоставляемых услуг.</p>
<p>Наша компания:</p>
<ul>
<li>занимается реализацией <a href="http://someproject.by/ru/company/information">телекоммуникационных проектов</a>,</li>
<li>продает и обслуживает <a href="http://someproject.by/ru/company/gateways">GSM-шлюзы</a>, </li>
<li>осуществляет <a href="http://someproject.by/ru/company/cooperation">продажу</a> мобильной техники оптом,</li>
<li>проводит <a href="http://someproject.by/ru/company/inspection">экспертизу мобильных устройств</a>,</li>
<li>оказывает услуги удаленного <a href="http://someproject.by/ru/company/call_center">call-центра</a>,</li>
<li>оказывает услуги по <?php echo  Html::a('техническому сопровождению', '@web/uploads/wiki/Техническое сопровождение.htm', ['id'=>'techsupportlink']);?>.</li>
</ul>

<div id="techsupport" style="display:none; overflow: hidden;"></div>

              </div>
        </div>
<?php
  $this->registerJs("
  $('#techsupportlink').on('click', function(event) {
    if (typeof this.clicked != 'undefined') {
      $('#techsupport').slideToggle();
      return false;
    }
    this.clicked = true;
    $('body').css('cursor','wait');
    $.ajax(this.href)
    .done(function(data) {
      $('#techsupport').html(data).slideDown();
    })
    .fail(function() {
      console.log('error with ' + id);
    })
    .always(function() {
      $('body').css('cursor','');
    });
    return false;
  });
  ", $this::POS_READY, 'ajax');
?>