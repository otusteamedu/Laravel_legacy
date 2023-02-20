<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

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
        
<h1 style='color:#0055A7'>Панель Администратора</h1>
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
                  ['label' => 'Главная', 'url' => ['/site/hello']],
                  ['label' => 'Пользователи', 'url' => ['/users']],
                  ['label' => 'Роли', 'url' => ['/roles']],
      
     
                  ['label' => 'Компании', 'url' => ['/companies/companiesdepartments']],
                //  ['label' => 'Отделы', 'url' => ['/departments']],
    

                  ['label' => 'Проекты', 'url' => ['/projects/projectsproducts']],
                //  ['label' => 'Продукты', 'url' => ['/products']],
                  //['label' => 'Подсистемы', 'url' => ['/modules']],
                  ['label' => 'Рассылка', 'url' => ['/onemessage']],
                  ['label' => 'SLA', 'url' => ['/sla']],
               
                  //   ['label' => 'Категории', 'url' => ['/categories']],
             
                  ['label' => 'Выход',
                          'url' => ['/site/logout'],
                          'linkOptions' => ['data-method' => 'post']],
                ],
                  ];
              if (Yii::$app->user && Yii::$app->user->identity) {
                if (Yii::$app->user->identity->username=='admin') {
                 
                }
              }

              echo Nav::widget($w1);
              
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

   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
