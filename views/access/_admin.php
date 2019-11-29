<?php
use yii\helpers\Html;
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
        <?php
            NavBar::begin([
                'brandLabel' => 'Панель администратора',
                'brandUrl' => ['/users'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Пользователи', 'url' => ['/users']],
                  ['label' => 'Роли', 'url' => ['/roles']],
                      ['label' => 'Доступы', 'url' => ['/access']],
        ['label' => '||',],
                    ['label' => 'Компании', 'url' => ['/companies']],
                    ['label' => 'Отделы', 'url' => ['/departments']],
                     ['label' => '||',],
                    ['label' => 'Модули', 'url' => ['/modules']],
                    ['label' => 'Продукты', 'url' => ['/products']],
                     ['label' => 'Проекты', 'url' => ['/projects']],
                   ['label' => '||',],
                  //   ['label' => 'Категории', 'url' => ['/categories']],
             
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

   

        
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
    </div>

   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
