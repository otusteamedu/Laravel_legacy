<?php

namespace app\controllers;

use Yii;

use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Session;
use yii\web\UploadedFile;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use app\models\Users;
use app\models\Ticket;
use app\models\TicketsQuery;
use app\models\TicketWithTime;
use app\models\Priority;
use app\models\Status;
use app\models\Projects;
use app\models\Products;
use app\models\Categories;
use app\models\Type;
use app\models\Modules;
use app\models\Messages;
use app\models\MessageFile;
use app\models\MessageFile1;
use app\models\TicketResolution;
use app\models\UsersRoles;
use app\models\Access;
use app\models\Usernotification;
use app\models\Favorite;
use app\models\Departments;
use app\models\Period;
use app\models\Tasks;



class SiteController extends Controller
{


    public function actionCalendar(){
        return $this->render('calendar', [
            'array_of_years'=>$this->getArray_of_years()

        ]);
    }

    private function getArray_of_years(){
        $array_of_years=[
    ['id' => '2016', 'data' => '2016'],
    ['id' => '2017', 'data' => '2017'],
    ['id' => '2018', 'data' => '2018'],
    ['id' => '2019', 'data' => '2019'],
    ['id' => '2020', 'data' => '2020'],
    ['id' => '2021', 'data' => '2021'],
    ['id' => '2022', 'data' => '2022'],
];
        return  $array_of_years;
    }

     private function getArray_of_months(){
    $array_of_months=[
    ['id' => '1', 'data' => 'ЯНВ'],
    ['id' => '2', 'data' => 'ФЕВ'],
    ['id' => '3', 'data' => 'МРТ'],
    ['id' => '4', 'data' => 'АПР'],
    ['id' => '5', 'data' => 'МАЙ'],
    ['id' => '6', 'data' => 'ИЮН'],
    ['id' => '7', 'data' => 'ИЮЛ'],
    ['id' => '8', 'data' => 'АВГ'],
    ['id' => '9', 'data' => 'СЕН'],
    ['id' => '10', 'data' => 'ОКТ'],
    ['id' => '11', 'data' => 'НОЯ'],
    ['id' => '12', 'data' => 'ДЕК'],
];
        return  $array_of_months;
    }


     private function getArray_days_of_week(){
    $array_days_of_week=[
    ['id' => '1', 'data' => 'ПН'],
    ['id' => '2', 'data' => 'ВТ'],
    ['id' => '3', 'data' => 'СР'],
    ['id' => '4', 'data' => 'ЧТ'],
    ['id' => '5', 'data' => 'ПТ'],
    ['id' => '6', 'data' => 'СБ'],
    ['id' => '7', 'data' => 'ВС'],

];
        return  $array_days_of_week;
    }

     private function getArray_of_dates(){
    $array_of_dates=[
    ['id' => '1', 'data' => '1'],
    ['id' => '2', 'data' => '2'],
    ['id' => '3', 'data' => '3'],
    ['id' => '4', 'data' => '4'],
    ['id' => '5', 'data' => '5'],
    ['id' => '6', 'data' => '6'],
    ['id' => '7', 'data' => '7'],
    ['id' => '8', 'data' => '8'],
    ['id' => '9', 'data' => '9'],
    ['id' => '10', 'data' => '10'],
    ['id' => '11', 'data' => '11'],
    ['id' => '12', 'data' => '12'],
    ['id' => '13', 'data' => '13'],
    ['id' => '14', 'data' => '14'],
    ['id' => '15', 'data' => '15'],
    ['id' => '16', 'data' => '16'],
    ['id' => '17', 'data' => '17'],
    ['id' => '18', 'data' => '18'],
    ['id' => '19', 'data' => '19'],
    ['id' => '20', 'data' => '20'],
    ['id' => '21', 'data' => '21'],
    ['id' => '22', 'data' => '22'],
    ['id' => '23', 'data' => '23'],
    ['id' => '24', 'data' => '24'],
    ['id' => '25', 'data' => '25'],
    ['id' => '26', 'data' => '26'],
    ['id' => '27', 'data' => '27'],
    ['id' => '28', 'data' => '28'],
    ['id' => '29', 'data' => '29'],
    ['id' => '30', 'data' => '30'],
    ['id' => '31', 'data' => '31'],

];
        return  $array_of_dates;
    }

       private function getArray_of_everything(){
    $array_of_everything=[
    ['id' => '1', 'data' => '1'],
    ['id' => '2', 'data' => '2'],
    ['id' => '3', 'data' => '3'],
    ['id' => '4', 'data' => '4'],
    ['id' => '5', 'data' => 'последний'],

];
        return  $array_of_everything;
    }













    public $attachmentBasePath = '@app/web/uploads/attachments1';


    protected function currentUser() {
      $identity = Yii::$app->user->getIdentity();
      if (!$identity)
        return $this->redirect(['site/login']);
      return $identity;
    }

    protected function checkRights($module_id, $user_id) {
      $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->distinct()->asArray()->all();
      $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
      $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Module_ID' => $module_id])->select(['Level_Rights'])->distinct()->asArray()->all();
      return ArrayHelper::getColumn($rights,'Level_Rights');
    }

    protected function listModulesByAccessLevel()
    {
      $identity = $this->currentUser();

      $roles = UsersRoles::find()->where(['user_id' => $identity->user_id])->select(['Role_ID'])->distinct()->asArray()->all();
      $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
      $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->distinct()->asArray()->all();

      $access = [
        'view' => [],
        'create' => [],
        'edit' => [],
      ];
      foreach ($rights as $right) {
        if ($right['Level_Rights'] == 3 || $right['Level_Rights'] == 4) $access['edit'][$right['Module_ID']] = 1;
        if ($right['Level_Rights'] == 2 || $right['Level_Rights'] == 4) $access['create'][$right['Module_ID']] = 1;
        if ($right['Level_Rights'] > 0)                                 $access['view'][$right['Module_ID']] = 1;
      }

      return [
        'view' => array_keys($access['view']),
        'create' => array_keys($access['create']),
        'edit' => array_keys($access['edit']),
      ];
    }

    protected function availableModules($avail_list, $product_id = null) {
      static $modules;

      if (empty($modules)) {
        $query = Modules::find();
        $condition = ['Product_ID' => $product_id, 'Active'=>1];
        $modules = $query->where(['Module_ID' => $avail_list])->andFilterWhere($condition)->all();
      }

      return $modules;
    }

    protected function availableProducts($avail_list, $project_id = null) {
      static $products;

      if (empty($products)) {
        $query = Products::find();
        $condition = ['Project_ID' => $project_id, 'Active'=>1];

        $modules = $this->availableModules($avail_list);
        $productIdArray = array_unique(ArrayHelper::getColumn($modules, 'Product_ID'));

        $products = $query->where(['Product_ID' => $productIdArray])->andFilterWhere($condition)->all();
      }

      return $products;
    }



    private function availableProjects($avail_list) {
      static $projects;

      if (empty($projects)) {
        $query = Projects::find();

        $products = $this->availableProducts($avail_list);
        $projectIdArray = array_unique(ArrayHelper::getColumn($products, 'Project_ID'));

        $projects = $query->where(['Project_ID' => $projectIdArray, 'Active'=>1])->all();
      }

      return $projects;
    }

    protected function allProjects() {
      $query = Projects::find();

     // $products = $this->availableProducts($avail_list);
      //$projectIdArray = ArrayHelper::getColumn($products, 'Project_ID');

      $projects = $query->where(['Active'=>1])->all();
      return $projects;
    }

     protected function allProducts($project_id = null) {
      $query = Products::find();


      $products = $query->where(['Project_ID' => $project_id, 'Active'=>1])->all();

      return $products;
    }


    private function allDepartments($company_id = null) {
      $query = Departments::find();


      $departments = $query->where(['Company_ID' => $company_id])->all();

      return $departments;
    }


    protected function allModules($product_id = null) {
      $query = Modules::find();
      $modules = $query->where(['Product_ID' => $product_id, 'Active'=>1])->all();
      return $modules;
    }

    protected function availableUsers($modules, $access_levels, $filter = [], $onlyActive = false) {
      $roles = Access::find()->where(['Level_Rights' => $access_levels])->andWhere(['Module_ID' => $modules])->select(['Role_ID'])->distinct()->asArray();
      $rolesArray = array_unique(ArrayHelper::getColumn($roles->all(), 'Role_ID'));
      $userRoles = UsersRoles::find()->where(['Role_ID' => $rolesArray])->select(['User_ID'])->distinct()->asArray();
      $usersArray = array_unique(ArrayHelper::getColumn($userRoles->all(), 'User_ID'));
      $usersCriteria = ['user_id' => $usersArray, 'TD' => null];
      if ($onlyActive) $usersCriteria['status'] = 2;
      $users = Users::find()->where($usersCriteria)->andFilterWhere(['not in', 'user_id', $filter])->distinct()->orderBy('name')->all();
      return $users;
    }

    static function sanitizeFilename($st) {
      $replace=array(
        "'"=>"",
        "`"=>"",
        " "=>"_",
        "а"=>"a","А"=>"a",
        "б"=>"b","Б"=>"b",
        "в"=>"v","В"=>"v",
        "г"=>"g","Г"=>"g",
        "д"=>"d","Д"=>"d",
        "е"=>"e","Е"=>"e",
        "ё"=>"yo","Ё"=>"yo",
        "ж"=>"zh","Ж"=>"zh",
        "з"=>"z","З"=>"z",
        "и"=>"i","И"=>"i",
        "й"=>"y","Й"=>"y",
        "к"=>"k","К"=>"k",
        "л"=>"l","Л"=>"l",
        "м"=>"m","М"=>"m",
        "н"=>"n","Н"=>"n",
        "о"=>"o","О"=>"o",
        "п"=>"p","П"=>"p",
        "р"=>"r","Р"=>"r",
        "с"=>"s","С"=>"s",
        "т"=>"t","Т"=>"t",
        "у"=>"u","У"=>"u",
        "ф"=>"f","Ф"=>"f",
        "х"=>"h","Х"=>"h",
        "ц"=>"c","Ц"=>"c",
        "ч"=>"ch","Ч"=>"ch",
        "ш"=>"sh","Ш"=>"sh",
        "щ"=>"sch","Щ"=>"sch",
        "ъ"=>"","Ъ"=>"",
        "ы"=>"y","Ы"=>"y",
        "ь"=>"","Ь"=>"",
        "э"=>"e","Э"=>"e",
        "ю"=>"yu","Ю"=>"yu",
        "я"=>"ya","Я"=>"ya",
        "і"=>"i","І"=>"i",
        "ї"=>"yi","Ї"=>"yi",
        "є"=>"e","Є"=>"e"
      );
      $str = iconv("UTF-8","UTF-8//IGNORE",strtr(trim($st),$replace));
      $str = strtolower($str);
      $str = preg_replace('~[^-.a-z0-9()_]+~u', '', $str);
      return $str;
    }


    protected function buildSorting($sortFields, &$query0) {

      $orderExpr = [];

      foreach ($sortFields as $field) {
        if ($field == 'Status') {
          $statusOrder = [
            1, //Открыт
            7, //Возобновлен
            3, //Перенаправлен
            2, //Взят в работу
            10, // Выполнен
            4, //На проверке
            9, //Приостановлен
            8, //Заблокирован
            6, //Закрыт
          ];
          $orderExpr[$field] = 'CASE `Status_ID` ';
          foreach ($statusOrder as $k => $v) $orderExpr[$field] .= 'WHEN '.$v.' THEN '.$k.' ';
          $orderExpr[$field] .= 'END';
        }

        if ($field == 'Priority') {
          $orderExpr[$field] = '`Priority_ID` DESC';
        }

        if ($field == 'ChangedDate') {
          $orderExpr[$field] = '`FD` DESC';
        }

        if ($field == 'StartDate') {
          $orderExpr[$field] = '`CreationTime` DESC';
        }

        if ($field == 'Type') {
          $typeOrder = [
            6, //Ошибка
            5, //Производительность
            9, //Установка и настройка
            7, //Настройка функциональноcти
            8, //Запрос на изменение
            10, //Запрос на обслуживание
            3, //Консультация
            1, //Документация
            4, //Отзывы
          ];
          $orderExpr[$field] = 'CASE `Type_ID` ';
          foreach ($typeOrder as $k => $v) $orderExpr[$field] .= 'WHEN '.$v.' THEN '.$k.' ';
          $orderExpr[$field] .= 'END';
        }

        if ($field == 'Category') {
          $catOrder = [
            7, //Служебная записка
            8, //Корпоративные вопросы
            1, //Сбор и анализ требований
            2, //Внедрение\Разработка
            3, //Миграция
            4, //Тестирование
            5, //Администрирование
            6, //Техническое сопровождение
          ];
          $orderExpr[$field] = 'CASE `Type_ID` ';
          foreach ($catOrder as $k => $v) $orderExpr[$field] .= 'WHEN '.$v.' THEN '.$k.' ';
          $orderExpr[$field] .= 'END';
        }

        if ($field == 'Author') {
          $orderExpr[$field] = '`a0`.`name`';
        }

        if ($field == 'Assignee') {
          $orderExpr[$field] = '`a1`.`name`';
        }
      }

      $orderExpr = implode(', ', $orderExpr);
      $query0->orderBy($orderExpr);
    }

    static function handleFiles($model) {

      $dir = Yii::getAlias('@app//web/uploads/attachments/').'/'.$model->Message_ID;
      $files = UploadedFile::getInstancesByName('MessageFile');

      $filenames = [];

      if (count($files) > 0) {

        mkdir($dir, 0744);

        // prevent duplicating names
        $already_saved = [];

        foreach($files as $file) {
          $filename = SiteController::sanitizeFilename($file->name);
          if (isset($already_saved[$filename])) {
            $filename = preg_replace('/^(.+?)(\..+)?$/', "$1 (" . ($already_saved[$filename]++) . ")$2", $filename);
          }
          else $already_saved[$filename] = 1;

          $uploaded = $file->saveAs( $dir . '/' . $filename );
          $attachment = new MessageFile();
          $attachment->Message_ID = $model->Message_ID;

          $filenames[] = $attachment->Path = $model->Message_ID.'/'.$filename;

          $attachment->save();
        }

      }

      return $filenames;
    }

    protected function handleFiles1($message, $ticket = null) {

      $dir = Yii::getAlias($this->attachmentBasePath);

      $filedate = strtotime($message->DateTime);
      $dir .= '/' . date('Y', $filedate);
      if (!is_dir($dir)) mkdir($dir, 0744);
      $dir .= '/' . date('m', $filedate);
      if (!is_dir($dir)) mkdir($dir, 0744);

      $files = UploadedFile::getInstancesByName('MessageFile1');

      $post = Yii::$app->request->post();

      $filenames = [];

      if (count($files) > 0) {

        foreach($files as $i => $file) {

          $attachment = new MessageFile1();

          if (!$file->error) {
            $attachment->message_id = $message->Message_ID;
            $attachment->filetype_id = null;
            $attachment->file_filename = $file->name;
            $attachment->file_filesize = $file->size;
            $attachment->file_mime = $file->type;
            $attachment->file_date = $message->DateTime;
            $attachment->file_note = $post['MessageNote1'][$i];
            $attachment->file_status = 0;

            $filenames[] = $file->name;

            if ($attachment->save()) {
              $uploaded = $file->saveAs( $dir . '/' . $attachment->file_id );
            }
            else {
              // TODO: залогировать ошибку аплоада
            }
          }

        }

      }

      return $filenames;
    }

    protected function informSubscribers($ticket, $user, $text, $changes, $files, $emails, $isNew = false, $newSubscribers = [], $removedSubscribers = [], $timeSpent = false) {

      $subject = $actions = '';
      $shortSubj = trim($ticket->Subject);

      $msgUrl = "http://".$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']=='80'?'':':'.$_SERVER['SERVER_PORT']).Url::toRoute(['site/view', 'id' => $ticket->Ticket_ID]);

      if ($isNew) {
        $subject = 'Создана новая задача '.$ticket->Ticket_ID.' ('.$shortSubj.')';
        $actions = "
<p>АВТОР: ".$ticket->author->name."</p>

<p>ИСПОЛНИТЕЛЬ: ".$ticket->assignedTo->name."</p>
    
<p>ТЕКСТ ЗАПРОСА: ".$text."</p>
";
      }
      else {
        $subject = 'Изменение в задаче '.$ticket->Ticket_ID.' ('.$shortSubj.')';

        if (count($changes) > 0) {
          $actions .= "
<p><b>ДЕЙСТВИЕ:</b> Изменены атрибуты запроса.</p>
<p>    ".implode("<br>\n    ", $changes)."</p>
";
        }
        if (count($files) == 1) {
          $actions .= "
<p><b>ДЕЙСТВИЕ:</b> Прикреплен новый файл.</p>
<p>    ".$files[0]."</p>
";
        }
        elseif (count($files) > 1) {
          $actions .= "
<p><b>ДЕЙСТВИЕ:</b> Прикреплены новые файлы.</p>
<p>    ".implode("<br>\n    ", $files)."</p>
";
        }

        if (count($newSubscribers) || count($removedSubscribers)) {
          $actions .= "
<p><b>ДЕЙСТВИЕ:</b> Добавлен/удален новый пользователь для информирования.</p>
<p>";
          if (count($newSubscribers)) {
            $users = Users::find()->where(['user_id' => $newSubscribers, 'TD' => null])->distinct()->orderBy('name')->all();
            $actions .= "    Список добавленных: " . implode(', ', ArrayHelper::getColumn($users, 'name')) . "</p>\n";
          }
          if (count($removedSubscribers)) {
            $users = Users::find()->where(['user_id' => $removedSubscribers, 'TD' => null])->distinct()->orderBy('name')->all();
            $actions .= "    Список удаленных: " . implode(', ', ArrayHelper::getColumn($users, 'name')) . "</p>\n";
          }
        }
        if (!empty($text)) {
          $actions .= "
<p><b>ДЕЙСТВИЕ:</b> Новое сообщение от пользователя ".$user->name."</p>

".$text."
";
        }
        if (!empty($timeSpent)) {
          $actions .= "
<p><b>Затрачено времени:</b> ".$timeSpent." ч.</p>
";
        }
      }

      $message ="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body>
<h2>НОМЕР ЗАДАЧИ: <a href=\"".Url::toRoute(['site/view', 'id' => $ticket->Ticket_ID])."\">".$ticket->Ticket_ID."</a></h2>

<h3>ТЕМА: ".$ticket->Subject."</h3>
".$actions."
<hr>
<p>Просмотреть задачу можно по следующей ссылке: <a href=\"".$msgUrl."\">".$msgUrl."</a></p>

<p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

<p>С уважением,<br>
Администрация сайта support</p>
</body></html>";

      $message = str_replace("\n.", "\n..", $message);
      $message = str_replace("href=\"#", "href=\"".Url::toRoute(['site/view', 'id' => $ticket->Ticket_ID])."#", $message);
      $message = preg_replace("~href=\"(?!http)~", "href=\"http://".$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']=='80'?'':':'.$_SERVER['SERVER_PORT']), $message);

      $email = implode(',', $emails);
      $emails = explode(',',$email);
      $emails = array_map('trim', $emails);
      $emails = array_unique($emails);

      $XML_consumer = Users::find()->where(['name'=>'Alaris_outsource', 'TD'=>null])->one();
      if (!empty($XML_consumer)) {
        $XML_consumer_email = trim($XML_consumer->email);
        if (in_array($XML_consumer_email, $emails)) {
          $this->send_XML_message($XML_consumer_email, $ticket, $subject);
        }
        $emails = array_diff($emails, [$XML_consumer_email]);
      }

      $email = implode(',', $emails);
      @mail($email, '=?UTF-8?B?'.base64_encode($subject).'?=', base64_encode($message), "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: base64\r\n");
    }

    private function send_XML_message($XML_consumer_email, $ticket, $subject) {
      $ticketMessage = Messages::find()->where(['Ticket_ID' => $ticket->Ticket_ID])->orderBy('`DateTime` DESC')->with('user')->one();
      $msg = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<tickets_report>
<tickets>
  <ticket_id>'.$ticket->Ticket_ID.'</ticket_id>
  <author>'.$ticket->Author.'</author>
  <FIO_author>'.htmlspecialchars($ticket->author->name).'</FIO_author>
  <assignedto>'.$ticket->AssignedTo.'</assignedto>
  <FIO_assignedto>'.htmlspecialchars($ticket->assignedTo->name).'</FIO_assignedto>
  <module_id>'.$ticket->Module_ID.'</module_id>
  <module_name>'.htmlspecialchars($ticket->module->Name).'</module_name>
  <category_id>'.$ticket->Category_ID.'</category_id>
  <category_name>'.htmlspecialchars($ticket->category->Name).'</category_name>
  <type_id>'.$ticket->Type_ID.'</type_id>
  <type_name>'.htmlspecialchars($ticket->type->Name).'</type_name>
  <priority_id>'.$ticket->Priority_ID.'</priority_id>
  <priority_name>'.htmlspecialchars($ticket->priority->Name).'</priority_name>
  <status_id>'.$ticket->Status_ID.'</status_id>
  <status_name>'.htmlspecialchars($ticket->status->Name).'</status_name>
  <subject>'.htmlspecialchars($ticket->Subject).'</subject>
  <fd>'.$ticket->FD.'</fd>
</tickets>
<messages>
  <message_id>'.$ticketMessage->Message_ID.'</message_id>
  <ticket_id>'.$ticket->Ticket_ID.'</ticket_id>
  <datetime>'.$ticketMessage->DateTime.'</datetime>
  <user_id>'.$ticketMessage->User_ID.'</user_id>
  <user_FIO>'.$ticketMessage->user->name.'</user_FIO>
  <text>'.htmlspecialchars($ticketMessage->ProtocolItem."\n".$ticketMessage->Text).'</text>
</messages>
</tickets_report>';
      @mail($XML_consumer_email, '=?UTF-8?B?'.base64_encode($subject).'?=', $msg, "MIME-Version: 1.0\r\nContent-type: text/xml; charset=utf-8");
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public $defaultAction = 'hello';

    public function actionIndex()
    {
        $session = new Session;
        $session->open();

        $this->layout = 'index-main';

        $query0 = Ticket::find();
        $query0->where(['Tickets.TD' => null]);

        $user = $this->currentUser();

        $get_values = Yii::$app->request->get();

        $filter = new Ticket;
        $filter->load($get_values);

        $message = new Messages;
        $message->load($get_values);

        $access = $this->listModulesByAccessLevel();

        $filterEmpty = true;
        $filterExtended = false;
        if (!empty($get_values['Ticket'])) {
          foreach ($get_values['Ticket'] as $name => $filter_field) {
            if (!empty($filter_field) || $filter_field === '0') {
              $filterEmpty = false;
              if (!in_array($name, ['Ticket_ID', 'Subject', 'creationdate0', 'creationdate1', 'estdate0', 'estdate1', 'DependsOn'])) $filterExtended = true;
            }
          }
        }
        if (!empty($get_values['Messages']['Text'])) {
          $filterEmpty = false;
          $filterExtended = true;
        }

        if (empty($get_values['SortBy'])) {
          $get_values['SortBy'] = ["Status", "ChangedDate"];
        }

        $myTickets = isset($get_values['mytickets']);
        if ($myTickets) {
          $filterEmpty = false;
          $filterExtended = true;
          $withme = Yii::$app->db->createCommand(
            " SELECT DISTINCT t.Ticket_ID AS id FROM Tickets t
              WHERE t.Ticket_ID IN (SELECT Ticket_ID FROM userNotifications WHERE User_ID = ".$user->user_id.")
              OR t.Ticket_ID IN (SELECT Ticket_ID FROM messages WHERE User_ID = ".$user->user_id.")
              OR t.Author = ".$user->user_id." OR t.AssignedTo = ".$user->user_id)->queryColumn('id');

          $query0->andWhere(['Ticket_ID' => $withme]);
        }

        $favoriteTickets = isset($get_values['favorite']);
        if ($favoriteTickets) {
          $filterEmpty = false;
          $filterExtended = true;

          $favorite_ids = Favorite::find(['Ticket_ID'])->where(['User_ID' => $user->user_id])->asArray()->all();

          $query0->andWhere(['Ticket_ID' => $favorite_ids]);
        }

        $hideSubtickets = isset($get_values['hideSubtickets']);
        if ($hideSubtickets) {
          $query0->andWhere(['DependsOn' => null]);
        }

        if ($filterEmpty) {
          $query0->andWhere(['not in', 'Status_ID', [6,8]]);
        }
        else {
          foreach ($filter->attributes() as $attr) {
            if ($attr == 'Subject') {
              $query0->andFilterWhere(['like', 'Subject', $filter->{$attr}]);
            }
            else {
              $query0->andFilterWhere([$attr => $filter->{$attr}]);
            }
          }
          if (!empty($get_values['Ticket']['creationdate0'])) $query0->andFilterWhere(['>=', 'CreationTime', $get_values['Ticket']['creationdate0'].' 00:00:00']);
          if (!empty($get_values['Ticket']['creationdate1'])) $query0->andFilterWhere(['<=', 'CreationTime', $get_values['Ticket']['creationdate1'].' 23:59:59']);
          if (!empty($get_values['Ticket']['estdate0'])) $query0->andFilterWhere(['>=', 'EstTime', $get_values['Ticket']['estdate0'].' 00:00:00']);
          if (!empty($get_values['Ticket']['estdate1'])) $query0->andFilterWhere(['<=', 'EstTime', $get_values['Ticket']['estdate1'].' 23:59:59']);
          if (!empty($get_values['Ticket']['Product_ID']) && empty($get_values['Ticket']['Module_ID'])) {
            $avail_modules = ArrayHelper::getColumn($this->availableModules($access['view'], $get_values['Ticket']['Product_ID']), 'Module_ID');
            $query0->andFilterWhere(['Module_ID' => $avail_modules]);
          }
          if (!empty($get_values['Ticket']['Project_ID']) && empty($get_values['Ticket']['Product_ID'])) {
            $avail_products = ArrayHelper::getColumn($this->availableProducts($access['view'], $get_values['Ticket']['Project_ID']), 'Product_ID');
            $condition = ['Product_ID' => $avail_products];
            $avail_modules = Modules::find()->where(['Module_ID' => $access['view']])->andFilterWhere($condition)->all();
            $query0->andFilterWhere(['Module_ID' => ArrayHelper::getColumn($avail_modules, 'Module_ID')]);
          }
          if (!empty($get_values['Messages']['Text'])) {
            $relevant_ids = Messages::find()->where(['like', 'Text', $get_values['Messages']['Text']])->select(['Ticket_ID', 'Text'])->asArray()->all();
            $query0->andWhere(['Ticket_ID' => $relevant_ids]);
          }

        }

        $query0->andWhere(['Module_ID' => $access['view']])
               ->innerJoinWith([
                  'author' => function ($q) {
                    $q->from('users a0');
                  }
              ])
              ->innerJoinWith([
                  'assignedTo' => function ($q) {
                    $q->from('users a1');
                  }
              ])
              ->with('priority')->with('type')->with('status')->with('category')->with('tickets')
              ->with('module')->with('module.product')->with('module.product.project')
              ->distinct();

        $pages = new Pagination(['totalCount' => $query0->count()]);

        if (!empty($get_values['SortBy'])) {
          $this->buildSorting($get_values['SortBy'], $query0);
        }

        /* ***************************** */
        //$sqltest = $query0->createCommand()->rawSql;

        $tickets = $query0->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        if ($filter->DependsOn) {
          $query1 = Ticket::find();
          $condition = ['Ticket_ID' => $filter->DependsOn, 'TD' => null];
          $root_ticket = $query1->where($condition)->one();
        }
        else $root_ticket = false;

        $session['indexUrl'] = Url::current();

        $currentProject = empty($get_values['Ticket']['Project_ID']) ? '' : $get_values['Ticket']['Project_ID'];
        $projects = $this->availableProjects($access['view']);

        $currentProduct = empty($get_values['Ticket']['Product_ID']) ? '' : $get_values['Ticket']['Product_ID'];
        $products = $this->availableProducts($access['view'], $currentProject);

        $modules = $this->availableModules($access['view'], $currentProduct);

        $authors = $this->availableUsers($access['view'], [2,4]);
        $editors = $this->availableUsers($access['view'], [3,4]);

        //var_dump($get_values['SortBy']); exit;

        return $this->render('index', [
            'user' => $user,
            'tickets' => $tickets,
            'root_ticket' => $root_ticket,
            'pages' => $pages,
            'filter' => $filter,
            'creationdate0' => isset($get_values['Ticket']['creationdate0']) ? $get_values['Ticket']['creationdate0'] : '',
            'creationdate1' => isset($get_values['Ticket']['creationdate1']) ? $get_values['Ticket']['creationdate1'] : '',
            'estdate0' => isset($get_values['Ticket']['estdate0']) ? $get_values['Ticket']['estdate0'] : '',
            'estdate1' => isset($get_values['Ticket']['estdate1']) ? $get_values['Ticket']['estdate1'] : '',
            'message' => $message,
            'authors' => $authors,
            'editors' => $editors,
            'projects' => $projects,
            'currentProject' => $currentProject,
            'products' => $products,
            'currentProduct' => $currentProduct,
            'modules' => $modules,
            'canCreate' => count($access['create']),
            'filterExtended' => $filterExtended,
            'sortSettings' => $get_values['SortBy'],
            'myTickets' => $myTickets,
            'hideSubtickets' => $hideSubtickets,
            'favoriteTickets' => $favoriteTickets,
        ]);

    }

    public function actionProductlist()
    {
        $this->layout = 'ajaxlist';

        $access = $this->listModulesByAccessLevel();
        $data = $this->availableProducts($access['view'],  Yii::$app->request->get('Project_ID'));

        return $this->render('ajaxlist', [
            'data' => $data,
            'fieldid' => 'Product_ID',
            'parent_fieldid' => 'Project_ID',
            'fieldid_str' => 'product_id',
            'label' => 'Продукт'
        ]);
    }

    public function actionProductlistall()
    {
        $this->layout = 'ajaxlist';



        $access = $this->listModulesByAccessLevel();
        $data = $this->allProducts( Yii::$app->request->get('Project_ID'));

        return $this->render('ajaxlist', [
            'data' => $data,
            'fieldid' => 'Product_ID',
            'parent_fieldid' => 'Project_ID',
            'fieldid_str' => 'product_id',
            'label' => 'Продукт'
        ]);
    }

     public function actionDepartmentslistall()
    {
        $this->layout = 'ajaxlist';

        $data = $this->allDepartments( Yii::$app->request->get('Company_ID'));

        return $this->render('ajaxlist', [
            'data' => $data,
            'fieldid' => 'Department_ID',
            'parent_fieldid' => 'Company_ID',
            'fieldid_str' => 'Deparment_ID',
            'label' => 'Отдел'
        ]);
    }

    public function actionModulelist()
    {
        $this->layout = 'ajaxlist';

        $access = $this->listModulesByAccessLevel();
        $data = $this->availableModules($access['view'], Yii::$app->request->get('Product_ID'));

        return $this->render('ajaxlist', [
            'data' => $data,
            'fieldid' => 'Module_ID',
            'parent_fieldid' => 'Product_ID',
            'fieldid_str' => 'module_id',
            'label' => 'Подсистема',
        ]);
    }

    public function actionModulelistall()
    {
        $this->layout = 'ajaxlist';

        $access = $this->listModulesByAccessLevel();
        $data = $this->availableModules($access['view'], Yii::$app->request->get('Product_ID'));

        return $this->render('ajaxlist', [
            'data' => $data,
            'fieldid' => 'Module_ID',
            'parent_fieldid' => 'Product_ID',
            'fieldid_str' => 'module_id',
            'label' => 'Подсистема',
        ]);
    }

    public function actionEditorlist()
    {
        $this->layout = 'ajaxlist';

        $users = $this->availableUsers([Yii::$app->request->get('Module_ID')], [3,4], [], true);

        return $this->render('ajaxlist_lite', [
            'data' => $users,
            'fieldid' => 'user_id',
        ]);
    }

    public function actionViewerlist()
    {
        $this->layout = 'ajaxlist';

        if ($ticketId = Yii::$app->request->get('Ticket_ID')) {
          $query0 = Usernotification::find();
          $condition0 = ['Ticket_ID' => $ticketId];
          $viewers = ArrayHelper::getColumn($query0->where($condition0)->all(), 'User_ID');
          $query1 = Ticket::find();
          $condition1 = ['Ticket_ID' => $ticketId, 'TD' => null];
          $ticket = $query1->where($condition1)->one();
          $filter = [ $ticket->Author ];
        }
        else {
          $viewers = [];
          $identity = $this->currentUser();
          $filter = [ $identity->user_id ];
        }

        $identity = $this->currentUser();

        $users = $this->availableUsers([Yii::$app->request->get('Module_ID')], [1,2,3,4], $filter, true);

        return $this->render('ajaxlist_multi', [
            'data' => $users,
            'fieldid' => 'user_id',
            'alreadySet' => $viewers,
        ]);
    }

    public function actionDeletefile() {

        if (!Yii::$app->request->isPost) {
          throw new \yii\web\ForbiddenHttpException();
          return;
        }

        $formData = Yii::$app->request->post();
        $file_id = $formData['file_id'];

        if (empty($file_id)) {
          throw new \yii\web\ForbiddenHttpException();
          return;
        }

        $file = MessageFile1::find()->where(['file_id' => $file_id, 'file_status' => '0'])->with('message')->with('message.ticket')->one();

        $identity = $this->currentUser();

        $rights = $this->checkRights($file->message->ticket->Module_ID, $identity->user_id);

        $canEdit = false;

        foreach ($rights as $right) {
          if ($right == 3 || $right == 4) $canEdit = true;
        }

        if (!$canEdit) {
          throw new \yii\web\ForbiddenHttpException();
          return;
        }

        $file->file_status = 1;
        if ($file->save()) {
          echo 'ok';
        }
        else {
          echo 'error';
        }

    }

    public function actionFile($file_id) {
        $file = MessageFile1::find()->where(['file_id' => $file_id])->with('message')->with('message.ticket')->one();

        $identity = $this->currentUser();

        $rights = $this->checkRights($file->message->ticket->Module_ID, $identity->user_id);

        $canView = $canCreate = $canEdit = false;

        foreach ($rights as $right) {
          if ($right == 3 || $right == 4) $canEdit = true;
          if ($right == 2 || $right == 4) $canCreate = true;
          if ($canEdit || $canCreate || $right == 1) $canView = true;
        }

        if (!$canView) {
          throw new \yii\web\ForbiddenHttpException();
          return;
        }

        $filedate = strtotime($file->file_date);

        $path = Yii::getAlias($this->attachmentBasePath).'/' . date('Y', $filedate)
                . '/'.date('m', $filedate);
        if (!is_dir($path)) {
          throw new \yii\web\NotFoundHttpException();
          return;
        }
        if (!is_readable($path.'/'.$file->file_id)) {
          throw new \yii\web\NotFoundHttpException();
          return;
        }

        header("Content-Type: ".$file->file_mime);
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$file->file_filename."\"");
        readfile($path.'/'.$file->file_id);
    }

    public function actionView($id)
    {

        $session = new Session;
        $session->open();
        $backurl = empty($session['indexUrl']) ? Url::toRoute(['site/index']) : $session['indexUrl'];

        $this->layout = 'index-main';

        $query0 = Ticket::find();
        $condition = ['Ticket_ID' => $id, 'TD' => null];
        $ticket = $query0->where($condition)->with('author')->with('assignedTo')->with('dependsOn')->with('module')->one();

        if (!$ticket) {
          throw new \yii\web\NotFoundHttpException();
          return;
        }

        $identity = $this->currentUser();

        $rights = $this->checkRights($ticket->Module_ID, $identity->user_id);

        $canView = $canCreate = $canEdit = false;

        foreach ($rights as $right) {
          if ($right == 3 || $right == 4) $canEdit = true;
          if ($right == 2 || $right == 4) $canCreate = true;
          if ($canEdit || $canCreate || $right == 1) $canView = true;
        }

        if (!$canView) {
          throw new \yii\web\ForbiddenHttpException();
          return;
        }

        $query1 = Messages::find();
        $condition = ['Ticket_ID' => $id];
        $messages = $query1->with('user')->where($condition)->all();

        $ids = [];
        foreach ($messages as $message) {
          $ids[] = $message->Message_ID;
        }

        $query2 = MessageFile::find();
        $condition = ['Message_ID' => $ids];
        $attachments = $query2->with('message')->where($condition)->all();

        $attachmentsByMessage = [];
        foreach ($attachments as $attachment) {
          $attachmentsByMessage[$attachment->Message_ID][] = $attachment;
        }

        $attachments1 = MessageFile1::find()->with('message')->where(['message_id' => $ids])->all();
        $attachments1ByMessage = [];
        foreach ($attachments1 as $attachment) {
          $attachments1ByMessage[$attachment->message_id][] = $attachment;
        }

        $access = $this->listModulesByAccessLevel();

        $condition = ['DependsOn' => $id, 'TD' => null];
        $subtickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      'SUM({{messages}}.RealEffort) AS totalEffort'
                  ])
                  ->joinWith('messages')
                  ->where($condition)->andWhere(['Module_ID' => $access['view']])
                  ->groupBy('{{tickets}}.Ticket_ID')
                  ->all();

        $projects = $this->availableProjects($access['edit']);
        $products = $this->availableProducts($access['edit'], $ticket->module->product->getAttribute('Project_ID'));
        $modules = $this->availableModules($access['edit'], $ticket->module->getAttribute('Product_ID'));

        $module_options = [];
        foreach ($modules as $module) {
          $module_options[$module->Module_ID] = ['data-up' => $module->Product_ID];
        }

        $newmsg = new Messages();

        $resolution = !empty($ticket->ticketResolution) ? $ticket->ticketResolution : new TicketResolution();

        $editors = $canEdit
                  ? $this->availableUsers([$ticket->Module_ID], [3,4], [], true)
                  : Users::find()->where(['user_id' => $ticket->AssignedTo, 'TD' => null])->distinct()->all();

        $viewers = $this->availableUsers([$ticket->Module_ID], [1,2,3,4], [$ticket->Author], true);

        if ($fav = Favorite::findOne(['User_ID' => $identity->user_id, 'Ticket_ID' => $ticket->Ticket_ID])) {
          $isFav = true;
        }
        else {
          $fav = new Favorite();
          $fav->User_ID = $identity->user_id;
          $fav->Ticket_ID = $ticket->Ticket_ID;
          $isFav = false;
        }

        $array_of_years=$this->getArray_of_years();
        $array_days_of_week=$this->getArray_days_of_week();
        $array_of_months=$this->getArray_of_months();
        $array_of_dates=$this->getArray_of_dates();
        $array_of_everything=$this->getArray_of_everything();
        $month_check = false;
   
        $period_base=  Period::find()->where(['Ticket_ID' => $ticket->Ticket_ID])->asArray()->all();

        $select_years_base = $select_months_base = $select_days_of_week_base = $select_everything_base = $select_time_base = $select_dates_base = [];
        foreach ($period_base as $key=>$value){
            if ($value['Year'] !== null) $select_years_base[]=$value['Year'];
            if ($value['Month'] !== null) $select_months_base[]=$value['Month'];
            if ($value['Day_Month'] !== null) $select_dates_base[]=$value['Day_Month'];
            if ($value['Weekday'] !== null) $select_days_of_week_base[]=$value['Weekday'];
            if ($value['time'] !== null) $select_time_base[]=$value['time'];
            if ($value['Week'] !== null) $select_everything_base[]=$value['Week'];
            if ($value['Month_check'] !== null) $month_check = true;

        }
        if (count($select_time_base) < 1) $select_time_base = [ null ];

        $subtickets_total = 0;
        if (count($subtickets) > 0) {
          $subtickets_total = array_sum(ArrayHelper::getColumn($subtickets, function ($element) {
            return (float)$element['totalEffort'];
          }));
        }


        $task=Tasks::findOne(['Ticket_ID'=>$id, 'Status'=>0] );

        $date_next_task= $task ? $task->Date_Time : null;


        return $this->render('edit', [
            'ticket' => $ticket,
            'messages' => $messages,
            'attachments' => $attachments,
            'attachmentsByMessage' => $attachmentsByMessage,
            'attachments1' => $attachments1,
            'attachments1ByMessage' => $attachments1ByMessage,
            'ticketbody' => count($messages) > 0 ? $messages[0] : new Messages(),
            'subtickets' => $subtickets,
            'backurl' => $backurl,
            'newmsg' => $newmsg,
            'resolution' => $resolution,
            'projects' => $projects,
            'products' => $products,
            'modules' => $modules,
            'module_options' => $module_options,
            'currentModule' => $ticket->Module_ID,
            'canCreate' => $canCreate,
            'isReadOnly' => !$canEdit,
            'editors' => $editors,
            'viewers' => $viewers,
            'fav' => $fav,
            'isFav' => $isFav,

            'array_of_years'=> $array_of_years,
            'array_days_of_week'=>$array_days_of_week,
            'array_of_months'=>$array_of_months,
            'array_of_everything'=>$array_of_everything,
            'array_of_dates'=>$array_of_dates,
            'date_next_task'=>$date_next_task,
            

            'select_years_base'=>$select_years_base,
            'select_months_base'=>$select_months_base,
            'select_dates_base'=> $select_dates_base,
            'select_days_of_week_base'=> $select_days_of_week_base,
            'select_time_base'=> $select_time_base,
            'select_everything_base'=>$select_everything_base,
            'period_month_check' => $month_check,


            'ticket_total' => array_sum(ArrayHelper::getColumn($ticket->messages, 'RealEffort')),
            'subtickets_total' => $subtickets_total

        ]);

    }

     public function actionCreate($id = '')
    {
        //echo Access::calculationDatetask(0, 0, 0, 0, 0, 0, 0, 0, 0);
        

        $session = new Session;
        $session->open();
        $backurl = empty($session['indexUrl']) ? Url::toRoute(['site/view']) : $session['indexUrl'];

        $this->layout = 'index-main';

        $identity = $this->currentUser();

        $ticket = new Ticket();
        $ticket->StartTime = $ticket->CreationTime = date('Y-m-d H:i:s');
        if ($id) {
          $ticket->DependsOn = $id;
          $ticket->Module_ID = $ticket->dependsOn->Module_ID;
        }
        $ticket->HighPriorityReason = '';
        $ticket->Author = $identity->user_id;
        $ticket->Status_ID = 1;
        $ticket->Progress = 0;
        $ticket->Priority_ID = 1;

        $newmsg = new Messages();
        $newmsg->Ticket_ID = 0;
        $newmsg->InReplyTo = null;
        $newmsg->DateTime = date('Y-m-d H:i:s');

        $access = $this->listModulesByAccessLevel();
        $projects = $this->availableProjects($access['create']);
        $products = $this->availableProducts($access['create']);
        $modules = $this->availableModules($access['create']);
        $module_options = [];
        foreach ($modules as $module) {
          $module_options[$module->Module_ID] = ['data-up' => $module->Product_ID];
        }

        if ($id) {
          $editors = $this->availableUsers($ticket->Module_ID, [3,4], [], true);
        }
        else {
          $editors = (count($modules) == 1) ? $this->availableUsers($access['create'], [3,4], [], true) : [];
        }

        $viewers = $this->availableUsers([$ticket->Module_ID], [1,2,3,4], [$ticket->Author], true);

         $array_of_years=$this->getArray_of_years();
         $array_days_of_week=$this->getArray_days_of_week();
         $array_of_months=$this->getArray_of_months();
         $array_of_everything=$this->getArray_of_everything();
         $array_of_dates=$this->getArray_of_dates();
      

        return $this->render('edit', [
            'ticket' => $ticket,
            'backurl' => $backurl,
            'newmsg' => $newmsg,
            'projects' => $projects,
            'products' => $products,
            'modules' => $modules,
            'module_options' => $module_options,
            'currentModule' => $ticket->Module_ID,
            'editors' => $editors,
            'viewers' => $viewers,
            'isReadOnly' => false,
            'array_of_years'=>$array_of_years,
            'array_days_of_week'=>$array_days_of_week,
            'array_of_months'=>$array_of_months,
            'array_of_everything'=>$array_of_everything,
            'array_of_dates'=>$array_of_dates,
            'date_next_task' => null,
            
            'select_years_base'=>[],
            'select_months_base'=>[],
            'select_dates_base'=> [],
            'select_days_of_week_base'=> [],
            'select_time_base'=> [ date('H:i', strtotime('+5 minutes')) ],
            'select_everything_base'=>[],
            'period_month_check' => false,

        ]);

        //return $this->render('view');
    }

    public function actionGenerateTicket($id = '')
    {
        //echo Access::calculationDatetask(0, 0, 0, 0, 0, 0, 0, 0, 0);
 
        $session = new Session;
        $session->open();
        $backurl = empty($session['indexUrl']) ? Url::toRoute(['site/view']) : $session['indexUrl'];

        $this->layout = 'index-main';

        $identity = $this->currentUser();

        $ticket = new Ticket();
        $ticket->CreationTime = date('Y-m-d H:i:s');
        if ($id) {
          $ticket->DependsOn = $id;
          $ticket->Module_ID = $ticket->dependsOn->Module_ID;
        }
        $ticket->HighPriorityReason = '';
        $ticket->Author = $identity->user_id;
        $ticket->Status_ID = 1;
        $ticket->Progress = 0;
        $ticket->Priority_ID = 1;

        $newmsg = new Messages();
        $newmsg->Ticket_ID = 0;
        $newmsg->InReplyTo = null;
        $newmsg->DateTime = date('Y-m-d H:i:s');

        $access = $this->listModulesByAccessLevel();
        $projects = $this->availableProjects($access['create']);
        $products = $this->availableProducts($access['create']);
        $modules = $this->availableModules($access['create']);
        $module_options = [];
        foreach ($modules as $module) {
          $module_options[$module->Module_ID] = ['data-up' => $module->Product_ID];
        }

        if ($id) {
          $editors = $this->availableUsers($ticket->Module_ID, [3,4], [], true);
        }
        else {
          $editors = (count($modules) == 1) ? $this->availableUsers($access['create'], [3,4], [], true) : [];
        }

        $viewers = $this->availableUsers([$ticket->Module_ID], [1,2,3,4], [$ticket->Author], true);

         $array_of_years=$this->getArray_of_years();
         $array_days_of_week=$this->getArray_days_of_week();
         $array_of_months=$this->getArray_of_months();
         $array_of_everything=$this->getArray_of_everything();
         $array_of_dates=$this->getArray_of_dates();


        return $this->render('edit', [
            'ticket' => $ticket,
            'backurl' => $backurl,
            'newmsg' => $newmsg,
            'projects' => $projects,
            'products' => $products,
            'modules' => $modules,
            'module_options' => $module_options,
            'currentModule' => $ticket->Module_ID,
            'editors' => $editors,
            'viewers' => $viewers,
            'isReadOnly' => false,
            'array_of_years'=>$array_of_years,
            'array_days_of_week'=>$array_days_of_week,
            'array_of_months'=>$array_of_months,
            'array_of_everything'=>$array_of_everything,
            'array_of_dates'=>$array_of_dates,

            'select_years_base'=>[],
            'select_months_base'=>[],
            'select_dates_base'=> [],
            'select_days_of_week_base'=> [],
            'select_time_base'=> [ date('H:i', strtotime('+5 minutes')) ],
            'select_everything_base'=>[],
            'period_month_check' => false,

        ]);

        //return $this->render('view');
    }

    public function actionNewticket() {

      $identity = $this->currentUser();

      $formData = Yii::$app->request->post();


      $ticket = new Ticket();

      $ticket->FD = date('Y-m-d H:i:s');
      $l = $ticket->load($formData);

      $ticket->Ticket_ID = 0;

      if ($l && $ticket->save()) {
          $id = $ticket->Version_ID;
          $ticket->Ticket_ID = $id;
          $ticket->Author = $identity->user_id;
          $ticket->Status_ID = 1;
          $ticket->Progress = 0;
          $ticket->save();

          if (!empty($formData['inform'])) {
            $newNotifications = array_map(
              function($item) use ($ticket) {
                return ['Ticket_ID' => $ticket->Ticket_ID, 'User_ID' => $item];
              },
              $formData['inform']);
            Yii::$app->db->createCommand()->batchInsert(Usernotification::tableName(), ['Ticket_ID', 'User_ID'], $newNotifications)->execute();
          }
          else {
            $formData['inform'] = [];
          }

      } else {
          $id = false;
          $ok = false;
      }

      if ($id) {

        $newmsg = new Messages();

        $newmsg->Ticket_ID = $id;
        $newmsg->InReplyTo = null;
        $newmsg->DateTime = date('Y-m-d H:i:s');
        $newmsg->User_ID = $ticket->Author;
        $newmsg->ProtocolItem = '';

        if (!$newmsg->load(Yii::$app->request->post())) {
          $newmsg->Text = ' ';
        }
        else {
          $newmsg->Text = nl2br(Html::encode("{$newmsg->Text}"));
        }

        if ($newmsg->save()) {
            $files = $this->handleFiles($newmsg);
            $ok = true;
        } else {
            $ok = false;
        }
      }




     

      if ($ok) {

        $recipient_ids = array_merge($formData['inform'], [$ticket->Author, $ticket->AssignedTo]);
        if (!empty($formData['inform_once'])) {
          $recipient_ids = array_merge($recipient_ids, $formData['inform_once']);
        }

        $recipients = Users::find()->where(['user_id' => $recipient_ids])->distinct()->select(['email'])->asArray()->all();
        $emails = ArrayHelper::getColumn($recipients, 'email');

        $this->informSubscribers($ticket, $identity,  $newmsg->Text, [], [], $emails, true);
        return $this->redirect(['site/view', 'id' => $id]);
      }
      else return $this->redirect(['site/index']);
    }

    public function actionEditticket() {

      \Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();

      $user = $this->currentUser();

      $ticket = new Ticket();
      $formData = Yii::$app->request->post();
      $ticket->load($formData);

      if (!$ticket->Ticket_ID) {
        throw new \yii\web\NotFoundHttpException();
        return;
      }

      $query0 = Ticket::find();
      $condition = ['Ticket_ID' => $ticket->Ticket_ID, 'TD' => null];
      $ticket0 = $query0->where($condition)->one();

      /* для частичного редактирования:
         пропущенным полям (кроме ID реализации и ID родительского запроса) копируем старые значения — они не меняются
         ID родительского запроса — исключение, может меняться с непустого на пустой */
      foreach ($ticket0 as $field => $value) {
        if ($field != 'Version_ID' && $field != 'DependsOn' && empty($ticket[$field])) $ticket[$field] = $value;
      }

      $rights = $this->checkRights($ticket0->Module_ID, $user->user_id);
      $canAccess = array_intersect($rights, [3,4]);
      if (count($canAccess) < 1) {
        throw new \yii\web\ForbiddenHttpException();
        return;
      }

      $oldSubscribers = ArrayHelper::getColumn($ticket0->usernotifications, 'User_ID');

      Usernotification::deleteAll(['Ticket_ID' => $ticket->Ticket_ID]);
      if (!empty($formData['inform'])) {
        $newNotifications = array_map(
          function($item) use ($ticket) {
            return ['Ticket_ID' => $ticket->Ticket_ID, 'User_ID' => $item];
          },
          $formData['inform']);
        Yii::$app->db->createCommand()->batchInsert(Usernotification::tableName(), ['Ticket_ID', 'User_ID'], $newNotifications)->execute();
      }
      else {
        $formData['inform'] = [];
      }

      $newSubscribers = array_diff($formData['inform'], $oldSubscribers);
      $removedSubscribers = array_diff($oldSubscribers, $formData['inform']);

      //var_dump($ticket); exit;

      /* генерация записи для протокола изменений */
      $system_msg = [];
      if ($ticket->Subject != $ticket0->Subject) {
        $system_msg[] = '<b>Тема:</b> ' . $ticket0->Subject . ' → '.$ticket->Subject;
      }
      if ($ticket->Module_ID != $ticket0->Module_ID) {
        $oldModule = Modules::Find()->where(['Module_ID'=>$ticket0->Module_ID])->one();
        $newModule = Modules::Find()->where(['Module_ID'=>$ticket->Module_ID])->one();
        $oldProduct = $oldModule->product;
        $newProduct = $newModule->product;
        $oldProject = $oldProduct->project;
        $newProject = $newProduct->project;

        if ($newProject->Project_ID != $oldProject->Project_ID) {
          $system_msg[] = '<b>Проект:</b> ' . $oldProject->Name . ' → ' . $newProject->Name;
        }
        if ($newProduct->Product_ID != $oldProduct->Product_ID) {
          $system_msg[] = '<b>Программный продукт:</b> ' . $oldProduct->Name . ' → ' . $newProduct->Name;
        }
        $system_msg[] = '<b>Подсистема:</b> ' . $oldModule->Name . ' → ' . $newModule->Name;
      }
      if ($ticket->Priority_ID != $ticket0->Priority_ID) {
        $system_msg[] = '<b>Приоритет:</b> ' . Priority::Find()->where(['Priority_ID'=>$ticket0->Priority_ID])->one()->Name . ' → '.Priority::Find()->where(['Priority_ID'=>$ticket->Priority_ID])->one()->Name;
      }
      if ($ticket->Type_ID != $ticket0->Type_ID) {
        $system_msg[] = '<b>Тип:</b> ' . Type::Find()->where(['Type_ID'=>$ticket0->Type_ID])->one()->Name . ' → '.Type::Find()->where(['Type_ID'=>$ticket->Type_ID])->one()->Name;
      }
      if ($ticket->Category_ID != $ticket0->Category_ID) {
        $system_msg[] = '<b>Категория:</b> ' . Categories::Find()->where(['Category_ID'=>$ticket0->Category_ID])->one()->Name . ' → '.Categories::Find()->where(['Category_ID'=>$ticket->Category_ID])->one()->Name;
      }
      if ($ticket->DependsOn != $ticket0->DependsOn) {
        if ($ticket0->DependsOn == null) {
          $system_msg[] = 'Переведен из <b>корневого запроса</b> в <b>подзапрос</b> для АЗ <a href="'.Url::toRoute(['site/view', 'id' => $ticket->DependsOn]).'">#'.$ticket->DependsOn.'</a>';
        }
        elseif ($ticket->DependsOn == null) {
          $system_msg[] = 'Переведен из <b>подзапроса</b> для АЗ <a href="'.Url::toRoute(['site/view', 'id' => $ticket0->DependsOn]).'">#'.$ticket0->DependsOn.'</a> в <b>корневой запрос</b>';
        }
        else
          $system_msg[] = '<b>Подзапрос для АЗ:</b> <a href="'.Url::toRoute(['site/view', 'id' => $ticket0->DependsOn]).'">#' . $ticket0->DependsOn . '</a> → <a href="'.Url::toRoute(['site/view', 'id' => $ticket->DependsOn]).'">#'.$ticket->DependsOn.'</a>';
      }
      if ($ticket->AssignedTo != $ticket0->AssignedTo) {
        $oldAssignee = Users::Find()->where(['user_id'=>$ticket0->AssignedTo, 'TD'=>null])->one();
        $newAssignee = Users::Find()->where(['user_id'=>$ticket->AssignedTo, 'TD'=>null])->one();
        $system_msg[] = '<b>Исполнитель:</b> <a href="'.Url::toRoute(['profile/alien', 'id' => $oldAssignee->id]).'">' . $oldAssignee->name . '</a> → <a href="'.Url::toRoute(['profile/alien', 'id' => $newAssignee->id]).'">'.$newAssignee->name.'</a>';
      }
      if ($ticket->StartTime != $ticket0->StartTime) {
        $system_msg[] = '<b>Дата начала:</b> ' . $ticket0->StartTime . ' → '.$ticket->StartTime;
      }
      if ($ticket->EstTime != $ticket0->EstTime) {
        $system_msg[] = '<b>Планируемая дата завершения:</b> ' . $ticket0->EstTime . ' → '.$ticket->EstTime;
      }
      if ($ticket->Status_ID != $ticket0->Status_ID) {
        $system_msg[] = '<b>Статус:</b> ' . Status::Find()->where(['Status_ID'=>$ticket0->Status_ID])->one()->Name . ' → '.Status::Find()->where(['Status_ID'=>$ticket->Status_ID])->one()->Name;
      }
      if ($ticket->Progress != $ticket0->Progress) {
        $system_msg[] = '<b>Выполнено:</b> ' . $ticket0->Progress . '% → '.$ticket->Progress .'%';
      }
      if ($ticket->EstEffort != $ticket0->EstEffort) {
        $system_msg[] = '<b>Планируемое время:</b> ' . number_format($ticket0->EstEffort, 1, ',', ' ') . ' ч. → '.number_format($ticket->EstEffort, 1, ',', ' '). ' ч.';
      }

      /* конец генерации записи для протокола изменений */

      $mod_date = time();
      $ticket0->TD = date('Y-m-d H:i:s', $mod_date);
      $ticket0->save();

      $ticket->FD = date('Y-m-d H:i:s', $mod_date + 1);

      /* если запрос переводят в статус "Выполнен", формируем заключение */
      $resolution_text = '';
      if ($ticket0->Status_ID != $ticket->statusReady() && $ticket->Status_ID == $ticket->statusReady()) {

        $resolution = new TicketResolution();

        if ($resolution->load(Yii::$app->request->post())) {
          $resolution->Author = $user->user_id;
          $err = false;
          // закрываем старое заключение, если было
          if ($ticket->ticketResolution) {
            $ticket->ticketResolution->TD = $ticket0->TD;
            if (!$ticket->ticketResolution->save()) $err = 'Old res not saved';
          }
          if (!$err) {;
            $resolution->Ticket_ID = $ticket->Ticket_ID;
            $resolution->FD = $ticket->FD;
            if (!$resolution->save()) $err = 'New res not saved';
          }
          if (!$err) {
            //$ticket->Progress = 90;
            $resolution_text = '
<h5>Заключение</h5>
<p><b>Проблема:</b> '.Html::encode("{$resolution->Problem}").'</p>
<p><b>Предпринятые действия:</b> '.Html::encode("{$resolution->Actions}").'</p>
<p><b>Результат:</b> '.Html::encode("{$resolution->Result}").'</p>';
          }
        }
      }
      /* конец формирования заключение */


      $newmsg = new Messages();
      $msg_ok = $newmsg->load(Yii::$app->request->post());

      $changes = count($system_msg) ? '<h5>Были внесены изменения:</h5><p>'.join("<br>", $system_msg).'</p>' : '';
      $newmsg->ProtocolItem = $changes;

      $timeSpent = false;
      if (!empty($newmsg->RealEffort)) {
        $timeSpent = number_format($newmsg->RealEffort, 1, ',', ' ');
        $newmsg->ProtocolItem .= '<p><b>Затрачено времени:</b> '.$timeSpent.' ч.</p>';
      }

      $rawtext = trim($newmsg->Text) . $resolution_text;
      $newmsg->Text = $rawtext;

      $newmsg->Ticket_ID = $ticket->Ticket_ID;
      $newmsg->InReplyTo = null;
      $newmsg->DateTime = date('Y-m-d H:i:s');
      $newmsg->User_ID =  $user->user_id;

      if ($msg_ok && $newmsg->save()) {
          // ok

          // сохранение файлов по-новому
          $files1 = $this->handleFiles1($newmsg, $ticket);

          $files = $this->handleFiles($newmsg);
          $recipient_ids = [$ticket0->Author, $ticket0->AssignedTo];
          if ($ticket0->AssignedTo != $ticket->AssignedTo) {
            $recipient_ids[] = $ticket->AssignedTo;
          }
          if (!empty($formData['inform_once'])) {
            $recipient_ids = array_merge($recipient_ids, $formData['inform_once']);
          }
          $recipient_ids = array_merge($recipient_ids, $oldSubscribers, $newSubscribers);

          $recipients = Users::find()->where(['user_id' => $recipient_ids])->distinct()->select(['email'])->asArray()->all();
          $emails = ArrayHelper::getColumn($recipients, 'email');

          $this->informSubscribers($ticket, $user, $rawtext, $system_msg, $files, $emails, false, $newSubscribers, $removedSubscribers, $timeSpent);

      } else {
          // error
      }


      $select_years=empty($formData['select_years']) ? [] : $formData['select_years'];
      $select_months=empty($formData['select_months']) ? [] : $formData['select_months'];
      $select_everything=empty($formData['select_everething']) ? [] : $formData['select_everething'];
      $select_days_of_week=empty($formData['select_days_of_week']) ? [] : $formData['select_days_of_week'];
      $select_dates=empty($formData['select_dates']) ? [] : $formData['select_dates'];
      $time_task=empty($formData['time_task']) ? [] : $formData['time_task'];
      $month_check = empty($formData['month-check']) ? false : $formData['month-check'];
    
      Period::deleteAll(['Ticket_ID'=>$ticket->Ticket_ID]);
      foreach ($select_years as $key=>$value){

        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->Year=$value;

        $period->save();
      }

      foreach ($select_months as $key=>$value){

        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->Month=$value;

        $period->save();
      }

      foreach ($select_days_of_week as $key=>$value){

        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->Weekday=$value;

        $period->save();
      }

      foreach ($select_everything as $key=>$value){

        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->Week=$value;

        $period->save();
      }

      foreach ($select_dates as $key=>$value){

        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->Day_Month=$value;

        $period->save();
      }

      foreach ($time_task as $key=>$value){

        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->time=$value;

        $period->save();
      }

      if ($month_check){
        $period=new Period();
        $period->Ticket_ID=$ticket->Ticket_ID;
        $period->Month_check=1;

        $period->save();
      }


       $task_old=Tasks::findOne(['Ticket_ID'=>$ticket->Ticket_ID, 'Status'=>0] );
       if(!empty($task_old)){
       $task_old->Status=2;
       $task_old->save();
       }

      $task=new Tasks;
      $date_end=$ticket->EstTime;
      $datetime=Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $time_task, $ticket->StartTime, $ticket->EstTime, null);
      //echo $datetime;
     // $task->Date_Time= $datetime;
      $task->Date_Time= $datetime;
      $task->Type_Task=1;
      $task->Ticket_ID=$ticket->Ticket_ID;
      $task->Status=0;
      $task->save();

      if ($ticket->save()) {
          return $this->redirect(['view', 'id' => $ticket->Ticket_ID]);
      } else {
          return $this->redirect(['site/index']);
      }
    }

    public function actionNewmessage()
    {
      $user = $this->currentUser();

      $files = [];

      $model = new Messages();

      $formData = Yii::$app->request->post();

      if (empty($formData['inform'])) $formData['inform'] = [];

      $form_ok = $model->load($formData);

      if ($form_ok) {

        $model->InReplyTo = null;
        $model->DateTime = date('Y-m-d H:i:s');
        $model->User_ID =  $user->user_id;

        $rawtext = trim($model->Text);
        $model->Text = $rawtext;
        $model->ProtocolItem = '';

        if ($model->save()) {
            // ok
            $files = $this->handleFiles($model);

            $recipient_ids = array_merge(
              [$model->ticket->Author, $model->ticket->AssignedTo],
              ArrayHelper::getColumn($model->ticket->usernotifications, 'User_ID')
            );
            if (!empty($formData['inform_once'])) {
              $recipient_ids = array_merge($recipient_ids, $formData['inform_once']);
            }
            $recipients = Users::find()->where(['user_id' => $recipient_ids])->distinct()->select(['email'])->asArray()->all();
            $emails = ArrayHelper::getColumn($recipients, 'email');

            $this->informSubscribers($model->ticket, $user, $rawtext, [], $files, $emails, false, $formData['inform']);
        } else {
            // error
        }
      } else {
        // error
      }
      return $this->redirect(['site/view', 'id' => $model->Ticket_ID, 'files' => $files]);

    }



     public static function actionNewmessageFromSla($dateTime, $formData)
    {
      $user = $this->currentUser();

      $model = new Messages();

      if (empty($formData['inform'])) $formData['inform'] = [];

      $form_ok = $model->load($formData);

      if ($form_ok) {
        $rawtext = $model->Text;

        $model->Text = '<p>'.Html::encode($rawtext).'</p>';
        $model->ProtocolItem = '';

        if ($model->save()) {
            // ok
            $files = $this->handleFiles($model);

            $recipient_ids = array_merge(
              [$model->ticket->Author, $model->ticket->AssignedTo],
              ArrayHelper::getColumn($model->ticket->usernotifications, 'User_ID')
            );
            if (!empty($formData['inform_once'])) {
              $recipient_ids = array_merge($recipient_ids, $formData['inform_once']);
            }
            $recipients = Users::find()->where(['user_id' => $recipient_ids])->distinct()->select(['email'])->asArray()->all();
            $emails = ArrayHelper::getColumn($recipients, 'email');

            $this->informSubscribers($model->ticket, $user, $rawtext, [], $files, $emails, false, $formData['inform']);
        } else {
            // error
        }
      } else {
        // error
      }
      echo "ок";
      //return $this->redirect(['site/view', 'id' => $model->Ticket_ID, 'files' => $files]);

    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {

           $identity = Yii::$app->user->getIdentity();
           if(is_object($identity) && $identity->username=='admin'){

            return $this->redirect(['site/admin']);

           }
           else {
             return $this->redirect(['site/hello']);
           }
        }

     $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if(Yii::$app->user->getIdentity()->username=='admin'){

            return $this->redirect(['site/admin']);

            }
           elseif(Yii::$app->user->getIdentity()->status==2)  {
            return $this->redirect(['site/hello']);
           }
           elseif(Yii::$app->user->getIdentity()->status==1){
              $message="Введенный логин был заблокирован Администратором. Авторизация невозможна";
             Yii::$app->user->logout();
              $this->layout = 'index-main';
              return $this->render('login', [
                'model' => $model,
                'message' =>$message,
            ]);
           }
           else{
             $message="Введенный логин был заблокирован Администратором. Авторизация невозможна";
             Yii::$app->user->logout();
              $this->layout = 'index-main';
              return $this->render('login', [
                'model' => $model,
                'message' =>$message,
            ]);

           }
        } else {
            $this->layout = 'index-main';
            return $this->render('login', [
                'model' => $model,
                'message' => '',
            ]);
        }
    }

    public function actionAdmin()
    {
        if(Yii::$app->user->getIdentity()->username=='admin'){

          return $this->render('admin', ['content' => '',]);
        }
        else
        {
            return $this->redirect(['site/hello']);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/index']);

    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
 ?>

               <img src="uploads/<?php echo $model['imageFile']->name; ?>">
                <?php return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionHello()
    {
      $user = $this->currentUser();

      $access = $this->listModulesByAccessLevel();

      if (empty($access['view'])){  //if user don't have access - redirect him on page site/notaccess
          return $this->redirect(['site/notaccess']);
      }

      $overall = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere('`Status_ID` NOT IN (6,8)')->count();
      $my = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Author' => $user->user_id])->count();
      $my_open = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Author' => $user->user_id])->andWhere(['Status_ID' => 1])->count();
      $my_on = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Author' => $user->user_id])->andWhere(['Status_ID' => 2])->count();
      $my_critical = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Author' => $user->user_id])->andWhere(['Priority_ID' => [3,4]])->count();
      $forme = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['AssignedTo' => $user->user_id])->count();
      $forme_open = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['AssignedTo' => $user->user_id])->andWhere(['Status_ID' => 1])->count();
      $forme_on = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['AssignedTo' => $user->user_id])->andWhere(['Status_ID' => 2])->count();
      $forme_critical = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['AssignedTo' => $user->user_id])->andWhere(['Priority_ID' => [3,4]])->count();

      $connection=Yii::$app->db;
      $withme_ids = $connection->createCommand(
        " SELECT DISTINCT t.Ticket_ID AS id FROM Tickets t
          WHERE t.Ticket_ID IN (SELECT Ticket_ID FROM userNotifications WHERE User_ID = ".$user->user_id.")
          OR t.Ticket_ID IN (SELECT Ticket_ID FROM messages WHERE User_ID = ".$user->user_id.")
          OR t.Author = ".$user->user_id." OR t.AssignedTo = ".$user->user_id)->queryColumn('id');

      $withme = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $withme_ids])->count();
      $withme_open = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $withme_ids])->andWhere(['Status_ID' => 1])->count();
      $withme_on = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $withme_ids])->andWhere(['Status_ID' => 2])->count();
      $withme_critical = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $withme_ids])->andWhere(['Priority_ID' => [3,4]])->count();

      $favorite_ids = Favorite::find(['Ticket_ID'])->where(['User_ID' => $user->user_id])->asArray()->all();

      $favorite = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $favorite_ids])->count();
      $favorite_open = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $favorite_ids])->andWhere(['Status_ID' => 1])->count();
      $favorite_on = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $favorite_ids])->andWhere(['Status_ID' => 2])->count();
      $favorite_critical = Ticket::find(['*'])->where(['TD' => null])->andWhere(['Module_ID' => $access['view']])->andWhere(['Ticket_ID' => $favorite_ids])->andWhere(['Priority_ID' => [3,4]])->count();

      $priorities = [
        4 => [ "name"=>"Максимально критичные",
            "y"=>0,
            "sliced"=>true,
            "selected"=>true,
            "color"=>"#e00" ],
        3 => [ "name"=>"Критичные",
            "y"=>0,
            "sliced"=>true,
            "selected"=>true,
            "color"=>"#F26E27" ],
        2 => [ "name"=>"Условно критичные",
            "y"=>0,
            "color"=>"yellow" ],
        1 => [ "name"=>"Некритичные",
            "y"=>0,
            "color"=>"#5cb85c" ]
      ];

      $data = [];

      $command=$connection->createCommand("select count(*) as cnt, Priority_ID from Tickets where Module_ID IN(".implode(',',$access['view']).") and `Status_ID` NOT IN (6,8) and TD IS NULL group by Priority_ID order by Priority_ID");
      $dataReader=$command->queryAll();
      foreach ($dataReader as $row) {
        $priorities[$row['Priority_ID']]['y'] = (int)$row['cnt'];
        $data[] = $priorities[$row['Priority_ID']];
      }

      return $this->render('hello', [
            'user' => $user,
            'overall' => $overall,
            'my' => $my,
            'my_open' => $my_open,
            'my_on' => $my_on,
            'my_critical' => $my_critical,
            'forme' => $forme,
            'forme_open' => $forme_open,
            'forme_on' => $forme_on,
            'forme_critical' => $forme_critical,
            'withme' => $withme,
            'withme_open' => $withme_open,
            'withme_on' => $withme_on,
            'withme_critical' => $withme_critical,
            'favorite' => $favorite,
            'favorite_open' => $favorite_open,
            'favorite_on' => $favorite_on,
            'favorite_critical' => $favorite_critical,
            'data' => $data,
          ]);
    }

    public function actionWiki(){
        $identity = $this->currentUser();
        // временная мера — показываем типовые запросы только сотрудникам Ньюлэнда (1) и Кенфордбела (5)
        $company_id = Yii::$app->db->createCommand("SELECT Company_ID FROM Departments WHERE Department_ID=".$identity->department_id)->queryScalar('Company_ID');
        $internal_user = in_array($company_id, [1,5]);
        $this->layout = 'index-main';
        return $this->render('wiki', ['internal_user' => $internal_user]);
    }

    public function actionWikitrebov(){
        $identity = $this->currentUser();
        // временная мера — показываем типовые запросы только сотрудникам Ньюлэнда (1) и Кенфордбела (5)
        $company_id = Yii::$app->db->createCommand("SELECT Company_ID FROM Departments WHERE Department_ID=".$identity->department_id)->queryScalar('Company_ID');
        $internal_user = in_array($company_id, [1,5]);
        $this->layout = 'index-main';
        return $this->render('wikitrebov', ['internal_user' => $internal_user]);
    }

    public function actionWikiregistration(){
        $identity = $this->currentUser();
        // временная мера — показываем типовые запросы только сотрудникам Ньюлэнда (1) и Кенфордбела (5)
        $company_id = Yii::$app->db->createCommand("SELECT Company_ID FROM Departments WHERE Department_ID=".$identity->department_id)->queryScalar('Company_ID');
        $internal_user = in_array($company_id, [1,5]);
        $this->layout = 'index-main';
        return $this->render('wikiregistration', ['internal_user' => $internal_user]);
    }

    public function actionWikispravochnik(){
        $identity = $this->currentUser();
        // временная мера — показываем типовые запросы только сотрудникам Ньюлэнда (1) и Кенфордбела (5)
        $company_id = Yii::$app->db->createCommand("SELECT Company_ID FROM Departments WHERE Department_ID=".$identity->department_id)->queryScalar('Company_ID');
        $internal_user = in_array($company_id, [1,5]);
        $this->layout = 'index-main';
        return $this->render('wikispravochnik', ['internal_user' => $internal_user]);
    }

     public function actionNotaccess(){

        return $this->render('notaccess');
    }




}
