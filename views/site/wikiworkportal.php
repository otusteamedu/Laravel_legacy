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

<h3 style='text-align:justify'>Работа с порталом someproject</h3>
<p>1. Запрос за авторизацию. Руководитель отдела компании заполняет шаблон для авторизации пользователя, прикрепляет фотографию пользователя и направляет письмо администратору.</p>
<p>2. Администратор заводит нового пользователя, распределяет роли на доступ к подсистемам.</p>
<p>3. Пользователю приходит письмо с его логином и паролем.</p>
<p>4. Пользователь проходит авторизацию.</p>
<p><img src="uploads/wiki/2.png"></p>
<p style='text-align:center'>Процесс регистрации пользователя</p>
<p>5. Загружается страница приветствия, где можно перейти на личный профиль, к списку всех запросов, к списку своих и к списку, где пользователь является исполнителем..</p>
<p>6. Профиль пользователя содержит информацию о пользователе, историю перехода по должностям и список доступных подсистем. </p>
<p>7. Можно просмотреть профиль другого пользователя, где будут содержаться данные о пользователе.</p>
<p>8. На главной странице можно просматривать все запросы, можно сделать поиск по заданным критериям.</p>
<p><img src="uploads/wiki/3.png"></p>
<p style='text-align:center'>Работа с запросами</p>
<p>9. Запрос можно редактировать, добавлять сообщения, прикреплять файлы, создавать подзапросы. </p>
<p>10. Можно создавать запросы, вносить все необходимые атрибуты, назначать исполнителя и работать по этому запросу.</p>
<p>11. Можно создавать подзапрос.</p>
<p><img src="uploads/wiki/4.png"></p>
<p style='text-align:center'>Процесс создания запроса</p>
<p>Классификация статусов абонентских запросов.</p>
<table border='1'>
    <tr><td>Открыт</td><td>Абонентский запрос открыт, но по нему еще не начались работы.</td></tr>
    <tr><td>Взят в работу</td><td>Запрос находится в работе</td></tr>
    <tr><td>Перенаправлен</td><td>При работе с запросом, было выявлено, что проблема определена не верно и перенаправлен на другое ответственное лицо.</td></tr>
    <tr><td>На проверке</td><td>После доработки или исправления, происходит проверка, для дальнейшей передачи Клиенту.</td></tr>
    <tr><td>Закрыт</td><td>Работы по запросу завершены, вопросов не осталось, запрос можно закрывать.</td></tr>
    <tr><td>Возобновлен</td><td>По истечению какого-то времени, по запросу опять возникли вопросы, чтобы не открывать заново, его можно возобновить.</td></tr>
    <tr><td>Заблокирован</td><td>При некорректном составлении запроса, или при дублировании абонентского запроса, он будет заблокирован. </td></tr>
    <tr><td>Приостановлен</td><td>При работе с системой возникают периодически вопросы, то их можно рассматривать с типом приостановлен. Или работы нужны, но в более поздние сроки.</td></tr> 
</table>



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