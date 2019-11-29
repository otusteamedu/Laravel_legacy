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
        
        <div class="container" style="font-size:24px;">
      У вас нет прав для работы в системе заявок. Обратитесь к администратору.
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