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



                     <style >
                         .td {text-align: left; vertical-align: top; padding:5px;}
                         .yellow {background-color: ff9900; color: white; vertical-align:middle; min-width:150px;}
                         .center {text-align: center;}
                     </style>

<div class=WordSection1>

    <table border="1">
        <tr>
            <td colspan="7" class='td yellow center'>
               Справочник типовых запросов 
            </td>
        </tr>
        <tr>
            <td class='td yellow center'>&nbsp;</td>
            <td class='td yellow center'>Порядок прохождения</td>
           
            <td class='td yellow center'>Тема</td>
            <td class='td yellow center'>Текст</td>
            <td class='td yellow center'>Тип</td>
            <td class='td yellow center'>Категория</td>
        </tr>
        <tr>
            <td class='td yellow center'>Установка операционной системы на рабочие станции</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Buh-help - Бухгалтерия - если нужна закупка<br>
                5. it-help производит работу над заявкой<br>
                6. Автор принимает работу
            </td>
     
            <td class='td'>Установить ОС на РМ</td>
            <td class='td'>1. ФИО сотрудника , для которого нужно сделать установку ОС<br>
                2. Описание причины
            </td>
            <td class='td'>Установка и настройка</td>
            <td class='td'>Администрирование</td>
        </tr>
          <tr>
            <td class='td yellow center'>Установка прикладного программного обеспечения на рабочие станции</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Buh-help - Бухгалтерия - если нужна закупка<br>
                5. it-help производит работу над заявкой<br>
                6. Автор принимает работу
            </td>
           
            <td class='td'>Установить ППО на РМ</td>
            <td class='td'>1. ФИО сотрудника, для которого нужно сделать установку ППО <br>
                2. Описание причины<br>
                3. Перечень ПО, которое необходимо установить
            </td>
            <td class='td'>Установка и настройка</td>
            <td class='td'>Администрирование</td>
        </tr>
        <tr>
            <td class='td yellow center'>Модернизация персональных компьютеров и ноутбуков</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Buh-help - Бухгалтерия - если нужна закупка<br>
                5. it-help производит работу над заявкой<br>
                6. Автор принимает работу
            </td>
            
            <td class='td'>Модернизация оборудования</td>
            <td>1. ФИО сотрудника, для которого необходимо произвести модернизацию оборудования<br>
                2. Описание причины
            </td>
            <td class='td'>1. Запрос на обслуживание<br>
                2. Ошибка
            </td>
            <td class='td'>Техническое сопровождение</td>
        </tr>
        <tr>
            <td class='td yellow center'>Насткойка и подключение офисной техники</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Автор принимает работу
            </td>
          
            <td class='td'>Настроить и подключить офисную технику</td>
            <td class='td'>1. ФИО сотрудника, для которого необходимо произвести настройку и подключение офисной техники<br>
                2. Описание причины<br>
                3. Название техники, которую нужно настроить и подключить
            </td>
            <td class='td'>Запрос на обслуживание</td>
            <td class='td'>Техническое сопровождение</td>
        </tr>
        <tr>
            <td class='td yellow center'>Замена картриджей в принтерах, их заправка</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Buh-help - Бухгалтерия - если нужна закупка<br>
                5. it-help производит работу над заявкой<br>
                6. Автор принимает работу
            </td>
           
            <td class='td'>Заменить картридж в принтере</td>
            <td class='td'>1. ФИО сотрудника, для которого необходимо произвести замену картриджа</td>
            <td class='td'>Запрос на обслуживание</td>
            <td class='td'>Техническое сопровождение</td>
        </tr>
        <tr>
            <td class='td yellow center'>Заведение учетных записей пользователей</td>
            <td class='td'>1. Специалист по подбору персонала - автор заявки<br>
                2. Руководитель отдела пользователя, которого нужно создать<br>
                3.it-help - it - подразделение<br>
                4. Руководитель отдела пользователя, которого уже создал it-help
            </td>
           
            <td class='td'>Завести новую учетную запись</td>
            <td class='td'>1. ФИО сотрудника, для которого нужно завести новую учетную запись<br>
                2. Описание причины</td>
            <td class='td'>Запрос на обслуживание</td>
            <td class='td'>Техническое сопровождение</td>
        </tr>
          <tr>
            <td class='td yellow center'>Настройка почтовых клиентов</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Информирование Автора о выполнении заявки
            </td>
          
            <td class='td'>Настроить почтового клиента</td>
            <td class='td'>1. ФИО сотрудника, для которого необходимо произвести настройку нового почтового клиента<br>
                2. Описание причины
            </td>
            <td class='td'>Запрос на обслуживание</td>
            <td class='td'>Техническое сопровождение</td>
        </tr>
          <tr>
            <td class='td yellow center'>Ремонт персональных компьютеров и ноутбуков</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Непосредтсвенный руководитель Автора<br>
                3. it-help - it - подразделение <br>
                4. Buh-help - Бухгалтерия - если нужна закупка<br>
                5. it-help производит работу над заявкой<br>
                6. Автор принимает работу
            </td>
          
            <td class='td'>1. Произвести ремонт ПК<br>
                2. Произвести ремонт ноутбука
            </td>
            <td class='td'>1. ФИО сотрудника, для которого нужно произвести ремонт ПК или ноутбука<br>
                2. Описание причины
            </td>
            <td class='td'>Ошибка</td>
            <td class='td'>Техническое сопровождение</td>
        </tr>
          <tr>
            <td class='td yellow center'>Регистрация на отпуск</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Прямые руководители Автора до руководителя уровня отдела включительно<br>
                3. Руководитель компании<br>
                4. Kadri-help - отдел кадров <br>
                5. Buh - help - Бухгалтерия<br>
                6.  Автор закрывает заявку
            </td>
           
            <td class='td'>Предоставлние отпуска</td>
            <td class='td'>Прошу предоставить <вид отпуска> c <дата начала отпуска> по <дата окончания отпуска> в связи/по причине <причина необходимости отпуска>.
                Организация: <название организации, в которой числится сотрудник>
            </td>
            <td class='td'>Запрос на обслуживание</td>
            <td class='td'>Кадры</td>
        </tr>
          <tr>
            <td class='td yellow center'>Регистрация на отгул</td>
            <td class='td'>1. Пользователь создает заявку (Автор)<br>
                2. Прямые руководители Автора до руководителя уровня отдела включительно<br>
                3. Руководитель компании<br>
                4. Kadri-help - отдел кадров <br>
                5. Buh - help - Бухгалтерия<br>
                6.  Автор закрывает заявку
            </td>
           
            <td class='td'>Предоставлние отпуска</td>
            <td class='td'>1. Дата начала отгула<br>
                2. Длительность отгула<br>
                3. Вид отгула<br>
                4. Обоснование
            </td>
            <td class='td'>Запрос на обслуживание</td>
            <td class='td'>Кадры</td>
        </tr>
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