<?php
/* @var $this yii\web\View */
$this->title = 'Wiki';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

?>

<?php $this->beginBody() ?>
    <div class="wrap">

        <header class="container">
          <div class="row">
            <div class="col-lg-3 logo pull-right">
            <a href="http://someproject.by/"><img src="http://someproject.by/images/logo.gif" /></a>
            </div>
            <div>
              <nav class="topnav" role="navigation">
                <div>
                  <div class="">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                  </div>

                  <div class="collapse navbar-collapse pull-left" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="<?=Url::toRoute(['site/wiki']) ?>" >Wiki</a></li>
                      <li><a href="<?=Url::toRoute(['site/index']) ?>">Система заявок</a></li>
                    </ul>
                  </div>
                  <div class="pull-right">
                    <?=Nav::widget([
                  'options' => ['class' => 'nav navbar-nav'],
                   'items' => Yii::$app->user->isGuest
                       ? [
                          ['label' => 'Login', 'url' => ['/site/login']]
                       ]
                       : [
                          ['label' => Yii::$app->user->identity->username,
                           'url' => ['profile/view', 'id' => Yii::$app->user->identity->id]],
                          ['label' => 'Выход',
                           'url' => ['/site/logout'],
                           'linkOptions' => ['data-method' => 'post']],
                          ]
                      ]);?>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>
            
          </div>
        </header>
        
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
             <div class="row">
         <div class="col-md-6" style="width:24%">
                <div style='position:fixed;'>
                      <p><a href="<?=Url::toRoute(['site/wiki']) ?>">О компании</a></p>
                    <p><a href="<?=Url::toRoute(['site/wikiworkportal']) ?>">Общие требования по работе с запросами</a></p>
                    <p><a href="<?=Url::toRoute(['site/wikiregistration']) ?>">Руководство пользователя</a></p>
                    <p><a href="<?=Url::toRoute(['site/wikipravilotypes']) ?>">Справочник Типовых запросов</a></p>
                </div>
        </div>
                 
                 <div class="col-md-6" style="width:74%">





<div class=WordSection1>
<h3 style='text-align:justify;'>Процесс работы с запросом</h3>

<p>1. Внести всю необходимую информацию, выбрать исполнителя и нажать кнопку «Создать»</p>
<p>2. Исполнителю на e-mail придет письмо с информацией о создании нового запроса.</p>
<p>3. Исполнитель делает статус запроса «Взят в работу» и добавляет комментарий о целях и планах работы над запросом.</p>
<p>4. По ходу работы Исполнитель выставляет процент выполнения и добавляет комментарии о текущем состоянии запроса.</p>
<p>5. Когда работа будет выполнена, Исполнитель ставит процент выполнения, добавляет описание решения, по необходимости добавляет файл и выбирает Исполнителя для проверки его работы.</p>
<p>6. Работа проверяется, и если по запросу нет вопросов, то Исполнитель ставит статус запроса «Закрыт» и процент выполнения 100, и добавляет комментарий о проверке выполнения. Если запрос выполнен не полностью или некорректно, то Исполнитель добавляет комментарий с замечаниями и выбирает Исполнителя для дальнейшей работы.</p>
<p><img src="uploads/wiki/algoritm.png"></p>



</div>


</div>
        </div>
        </div>
       
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; someproject <?= date('Y') ?></p>
            <p class="pull-right"></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>