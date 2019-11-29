<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

$report_viewers = [134, 149, 1249, 156];

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>


<?php $this->beginBody() ?>
    <div class="wrap">

        <header class="container">
          <div class="row">
            <div class="col-lg-3 logo pull-right">
            <a href="http://someproject.by/"><img src="http://someproject.by/images/logo.gif" alt="someproject" /></a>
            </div>
            <div>
                  <?php
            NavBar::begin([
                'options' => ['class' => 'topnav'],
                'innerContainerOptions' => ['class'=>''],
            ]);
            if (Yii::$app->user->isGuest) {
              echo Nav::widget([
                  'options' => ['class' => 'nav navbar-nav navbar-right'],
                  'items' => [
                        ['label' => 'Login', 'url' => ['/site/login']]
                     ]
                   ]);
            }
            else {
              $w1 = [
                  'options' => ['class' => 'nav navbar-nav'],
                  'items' => [
                      ['label' => 'Главная', 'url' => ['site/hello']],
                      ['label' => 'Система заявок', 'url' => ['site/index']],
                      ['label' => 'Wiki', 'url' => ['site/wiki']],
                  ]
                  ];
              if (Yii::$app->user && Yii::$app->user->identity) {
                if (Yii::$app->user->identity->username=='admin') {
                  $w1['items'][] = ['label' => 'Панель администратора', 'url' => ['site/admin']];
                }
                if (in_array(Yii::$app->user->identity->user_id, $report_viewers)) {
                  $w1['items'][] = ['label' => 'Отчеты', 'url' => ['reports/']];
                }
              }

              echo Nav::widget($w1);
              echo Nav::widget([
                  'options' => ['class' => 'nav navbar-nav navbar-right'],
                  'items' => [
                      ['label' => Yii::$app->user->identity->username,
                       'url' => ['profile/view', 'id' => Yii::$app->user->identity->id]],
                      ['label' => 'Выход',
                       'url' => ['/site/logout'],
                       'linkOptions' => ['data-method' => 'post']],
                      ]
                  ]);
            }
            NavBar::end();
            ?>

            </div>

          </div>
        </header>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; someproject <?= date('Y') ?></p>
            <p class="pull-right">Версия <?= Yii::$app->params['version']  ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
