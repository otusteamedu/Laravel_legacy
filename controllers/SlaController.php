<?php

namespace app\controllers;

use Yii;
use app\models\Sla;
use app\models\SlaQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Projects;
use app\models\Products;
use app\models\Modules;
use yii\helpers\ArrayHelper;
use app\models\Messages;
use yii\helpers\Html;
use app\models\Users;
use yii\helpers\Url;
use app\models\Ticket;
use app\models\Roles;
use app\models\Ticketsestimatesend;
use app\models\UsersRoles;
use app\models\Access;
use app\models\Period;
use app\models\Tasks;

/**
 * SlaController implements the CRUD actions for sla model.
 */
class SlaController extends Controller
{
     public function actionCalendar(){
        return $this->render('calendar', [
            'array_of_years'=>$this->getArray_of_years()

        ]);
    }

    static function getArray_of_years(){
        $array_of_years=[
    ['id' => '2016', 'data' => '2016'],
    ['id' => '2017', 'data' => '2017'],
    ['id' => '2018', 'data' => '2018'],
    ['id' => '2019', 'data' => '2019'],
];
        return  $array_of_years;
    }

     static function getArray_of_months(){
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


     static function getArray_days_of_week(){
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

     static function getArray_of_dates(){
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

       static function getArray_of_everything(){
    $array_of_everything=[
    ['id' => '1', 'data' => '1'],
    ['id' => '2', 'data' => '2'],
    ['id' => '3', 'data' => '3'],
    ['id' => '4', 'data' => '4'],
    ['id' => '5', 'data' => 'последний'],

];
        return  $array_of_everything;
    }
    
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all sla models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlaQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }
  function actionTest(){
      \app\models\Access::mailoursystem('aliaksandr.paskrobka', 'Тема', 'Сообщение');
      echo "good";
  } 
    
     private static function informSubscribers($ticket, $user, $text, $changes, $files, $emails, $isNew = false, $newSubscribers = [], $removedSubscribers = [], $timeSpent = false) {

      $subject = $actions = '';
      $shortSubj = trim($ticket->Subject);

      $msgUrl = "http://".$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT']=='80'?'':':'.$_SERVER['SERVER_PORT']).Url::toRoute(['site/view', 'id' => $ticket->Ticket_ID]);

      if ($isNew) {
        $subject = 'Создана новая задача '.$ticket->Ticket_ID.' ('.$shortSubj.')';
        $actions = "
<p>АВТОР: ".$ticket->author->name."</p>

<p>ИСПОЛНИТЕЛЬ: ".$ticket->assignedTo->name."</p>
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
Администрация сайта support.someproject.by</p>
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
  
  
  
  
    /**
     * Displays a single sla model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       $project_id=$this->findModel($id)->project_id;
       $project= \app\models\Projects::findOne($project_id);
       $project_name=$project->Name; 
       $product_id=$this->findModel($id)->product_id;
       $product= \app\models\Products::findOne($product_id);
       $product_name=$product->Name; 
       $module_id=$this->findModel($id)->module_id;
       $module= \app\models\Modules::findOne($module_id);
       $module_name=$module->Name; 
       $priority_id=$this->findModel($id)->priority_id;
       $priority= \app\models\Priority::findOne($priority_id);
       $priority_name=$priority->Name; 
       $type_id=$this->findModel($id)->type_id;
       $type= \app\models\Type::findOne($type_id);
       $type_name=$type->Name; 
       $status_id=$this->findModel($id)->status_id;
       $status= \app\models\Status::findOne($status_id);
       $status_name=$status->Name; 
       if($this->findModel($id)->active==0) 
           {
           $active_string ='Неактивен';
           }
       if($this->findModel($id)->active==1) 
           {
           $active_string ='Активен';
           }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'project_name'=> $project_name,
            'product_name'=> $product_name,
            'module_name'=> $module_name,
            'priority_name'=> $priority_name,
            'type_name'=> $type_name,
            'status_name'=> $status_name,
            'active_string'=>$active_string,
        ]);
    }

    /**
     * Creates a new sla model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new sla();
       
       $load=$model->load(Yii::$app->request->post());
       $model->setAttribute('last_send', date('Y-m-j H:i:s'));
       
        if ($load && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing sla model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing sla model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the sla model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return sla the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = sla::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
 
    
     public function actionRun()
     {
         $cron_period=10; //10 min 
         $dateTime=date('Y-m-d H:i:s');
         $ticketsestimatesend = Ticketsestimatesend::findBySql("select * from ticketsestimatesend where last_send > DATE_ADD('$dateTime', INTERVAL -60 MINUTE)")->all();
        // echo "select * from ticketsestimatesend where last_send > DATE_ADD('$dateTime', INTERVAL -60 MINUTE)";
         
        
         $tickets=Ticket::findBySql("select * from tickets where((TD is null) and (Status_ID IN (1, 2, 3, 4, 7 ,9))  and (EstTime BETWEEN DATE_ADD('$dateTime', INTERVAL 0 MINUTE) AND  DATE_ADD('$dateTime', INTERVAL 60 MINUTE) ))")->all();
            echo "select * from tickets where((TD is null) and (Status_ID IN (1, 2, 3, 4, 7 ,9))  and (EstTime BETWEEN DATE_ADD('$dateTime', INTERVAL 0 MINUTE) AND  DATE_ADD('$dateTime', INTERVAL 60 MINUTE) ))";
             //exit;
             //var_dump($tickets);
             //exit;
             foreach ($tickets as $keyt=>$valuet){
                 echo $tickets;
                 //var_dump($valuet);
                // exit;
                  $send_already=0;
                 foreach ($ticketsestimatesend as $key1=>$value1){
                     
                  if (($valuet->Ticket_ID==$value1->Ticket_ID) AND ($valuet->EstTime==$value1->esttime)){
                      $send_already=1;   
                  } 
              }
                 
                 if ($send_already==0){
             $formData['Messages']['Ticket_ID']=$valuet->Ticket_ID;
             $formData['Messages']['InReplyTo']='';
             $formData['Messages']['DateTime']=  $dateTime;
             $formData['Messages']['User_ID']='1';
             $formData['Messages']['Text']="До планируемой даты выполнения запроса осталось меньше часа";
             var_dump($formData);
            // exit;
              //echo "<pre>";
             self::Newmessage($formData);
             $connection=Yii::$app->db; 
         $connection->createCommand("insert into ticketsestimatesend  (Ticket_ID, last_send, esttime) values ('$valuet->Ticket_ID', '$dateTime', '$valuet->EstTime')")->query();
         echo "insert into ticketsestimatesend  (Ticket_ID, last_send, esttime) values ('$valuet->Ticket_ID', '$dateTime', '$valuet->EstTime')";
         }
             }
         $settings=  Sla::findBySql("select * from sla where ((active=1) and (last_send <= '$dateTime') )")->all();  //all sla settings
         //var_dump($settings);
        
         
        // echo "select * from sla where ((active=1) and (last_send < DATE_ADD('$dateTime', INTERVAL $cron_period MINUTE)) )";
         foreach ($settings as $key=>$value){
             // echo "<pre>";
             echo "settings";
          //   exit;
            
            
             $sla=$value->sla;
             $tickets=Ticket::findBySql("select * from tickets where((TD is null) and (Module_ID =$value->module_id) and (Type_ID=$value->type_id) and (Priority_ID=$value->priority_id) and (Status_ID=$value->status_id) and (DATE_ADD(FD, INTERVAL $value->sla MINUTE) < '$dateTime'))")->all();
             //echo "select * from tickets where((TD is null) and (Module_ID =$value->module_id) and (Type_ID=$value->type_id) and (Priority_ID=$value->priority_id) and (Status_ID=$value->status_id) and (DATE_ADD(FD, INTERVAL $value->sla MINUTE) < '$dateTime'))";
             
             //var_dump($tickets);
             //exit;
             foreach ($tickets as $keyt=>$valuet){
                 echo $tickets;
                 //var_dump($valuet);
                // exit;
             $formData['Messages']['Ticket_ID']=$valuet->Ticket_ID;
             $formData['Messages']['InReplyTo']='';
             $formData['Messages']['DateTime']=  $dateTime;
             $formData['Messages']['User_ID']='1';
             $formData['Messages']['Text']=$value->message;
             var_dump($formData);
            // exit;
              //echo "<pre>";
             self::Newmessage($formData);
         }
         $connection=Yii::$app->db; 
         $connection->createCommand("update sla set last_send=(DATE_ADD('$dateTime', INTERVAL $value->interval MINUTE)) where id=$value->id" )->query();
         }
        
         echo "run is working";
     }
     
     
     
     
       public function actionRun2()
     {
       
         
         $rows = (new \yii\db\Query())
    ->select(['users.id as u', 'users.`name` as n', 'users.surname as s', 'users.second_name as ss'])
    ->from('users')
      
    ->where([])
    ->limit(1000)
    ->all();
     foreach ($rows as $key=>$value){
         $u=$value['u'];
        $fio=$value['s'].' '.$value['n'].' '.$value['ss'];
       $n=$value['n'];
        //exit;
         $connection=Yii::$app->db; 
         $connection->createCommand("update users set name='$fio', realname='$n'  where id=$u")->query();
     } 
     }  
     
     
      public function actionRun1()
     {
       
      
        
          
          
          
     $rows = (new \yii\db\Query())
    ->select(['users.id as u', 'departments.`Name` as d', 'companies.Name as c'])
    ->from('users')
             ->leftJoin('departments', 'users.department_id=departments.Department_ID') ->leftJoin('companies', 'departments.Company_ID=companies.`Company_ID`')
    ->where([])
    ->limit(1000)
    ->all();
     foreach ($rows as $key=>$value){
        $u= $value['u'];
        $d=$value['d'];
        $c=$value['c'];
        
         $connection=Yii::$app->db; 
         $connection->createCommand("update users set department='$d' ,company='$c' where id=$u")->query();
         
     }
    
          exit;
          
       
          $connection=Yii::$app->db; 
        
        // $connection->("SELECT users.`name`, departments.`Name`, companies.`Name` from users left join departments on (users.department_id=departments.Department_ID) left join companies on (departments.Company_ID=companies.Company_ID)")->query();
         var_dump($connection);
         exit;
         $connection=Yii::$app->db; 
        // $connection->createCommand("update sla set last_send=(DATE_ADD('$dateTime', INTERVAL $value->interval MINUTE)) where id=$value->id" )->query();
         
        
         echo "run is working";
     }
     
     
     
     
     public function actionUpdatepersonal()
     {
         $users=  Users::findBySql("select user_id, username from users")->all();
        $connection=Yii::$app->db;
        foreach ($users as $key=>$value){
            $user_id=$value->getAttribute('user_id');
            $username=$value->getAttribute('username');
            $connection->createCommand("insert into roles  (Name, Description, is_own) values ('$username', 'Персональная роль', '$user_id') ")->query();
            $role=Roles::findOne(['Name'=>$username]);
         
            
                $role_id=$role->getAttribute('Role_ID');
                 
            $connection->createCommand("insert into users_roles  (user_id, role_id) values ('$user_id', '$role_id') ")->query();
        }
         $connection=Yii::$app->db; 
         //$connection->createCommand("" )->query();
       
     }
   
   
     
      public static function currentUser() {
      $identity = Yii::$app->user->getIdentity();
      $identity=$user = [  23 => [
            'id' =>  23,
            'username' => 'admin',
            'name' => 'admin',
            'password' => '',
            'status' => 2,
            'user_id' => 1,
            'department_id' => '1',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ] ];
      if (!$identity)
        return $this->redirect(['site/login']);
      return $identity;
    }
    
     public static function Newmessage($formData)
    {
      $user = [  23 => [
            'id' =>  23,
            'username' => 'admin',
            'name' => 'admin',
            'password' => '',
            'status' => 2,
            'user_id' => 1,
            'department_id' => '1',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ] ];
      
    
      $model = new Messages();

     // $formData = Yii::$app->request->post();
  
      
      if (empty($formData['inform'])) $formData['inform'] = [];

      $form_ok = $model->load($formData);

      if ($form_ok) {
        $rawtext = $model->Text;

        $model->Text = '<p>'.Html::encode($rawtext).'</p>';
        $model->ProtocolItem = '';
        echo "<pre>";
var_dump($model->ticket);
echo "</pre>";
        if ($model->save()) {
            echo "ok save!!!!";
            $files = [];
            var_dump($model->ticket->Author);
            var_dump($model->ticket->AssignedTo);
            echo "<hr>";
            $recipient_ids = array_merge(
              //[$model->ticket->Author, $model->ticket->AssignedTo],
                [$model->ticket->AssignedTo], //didn't send mail for author only for assignedTo
              ArrayHelper::getColumn($model->ticket->usernotifications, 'User_ID')
            );
            echo "hgjghjhgj";
            var_dump($recipient_ids);
           // exit;
            if (!empty($formData['inform_once'])) {
              $recipient_ids = array_merge($recipient_ids, $formData['inform_once']);
            }
            $recipients = Users::find()->where(['user_id' => $recipient_ids])->distinct()->select(['email'])->asArray()->all();
            $emails = ArrayHelper::getColumn($recipients, 'email');

            self::informSubscribers($model->ticket, $user, $rawtext, [], $files, $emails, false, $formData['inform']);
        } else {
            echo "didnt save";
        }
      } else {
        echo "form didnt load";
      }
     echo "ok";

    }
    
    
    
    
    
     private static function availableModules($avail_list, $product_id = null) {
      static $modules;

      if (empty($modules)) {
        $query = Modules::find();
        $condition = ['Product_ID' => $product_id, 'Active'=>1];
        $modules = $query->where(['Module_ID' => $avail_list])->andFilterWhere($condition)->all();
      }

      return $modules;
    }
    
    private static function availableProducts($avail_list, $project_id = null) {
      static $products;

      if (empty($products)) {
        $query = Products::find();
        $condition = ['Project_ID' => $project_id, 'Active'=>1];

        $modules = SlaController::availableModules($avail_list);
        $productIdArray = array_unique(ArrayHelper::getColumn($modules, 'Product_ID'));

        $products = $query->where(['Product_ID' => $productIdArray])->andFilterWhere($condition)->all();
      }

      return $products;
    }
    
     private static function availableProjects($avail_list) {
      static $projects;

      if (empty($projects)) {
        $query = Projects::find();

        $products = SlaController::availableProducts($avail_list);
        $projectIdArray = array_unique(ArrayHelper::getColumn($products, 'Project_ID'));

        $projects = $query->where(['Project_ID' => $projectIdArray, 'Active'=>1])->all();
      }

      return $projects;
    }
    
    
       protected static function listModulesByAccessLevel()
    {
      $identity = SlaController::currentUser();

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
    
     private static function availableUsers($modules, $access_levels, $filter = [], $onlyActive = false) {
      $roles = Access::find()->where(['Level_Rights' => $access_levels])->andWhere(['Module_ID' => $modules])->select(['Role_ID'])->distinct()->asArray();
      $rolesArray = array_unique(ArrayHelper::getColumn($roles->all(), 'Role_ID'));
      $userRoles = UsersRoles::find()->where(['Role_ID' => $rolesArray])->select(['User_ID'])->distinct()->asArray();
      $usersArray = array_unique(ArrayHelper::getColumn($userRoles->all(), 'User_ID'));
      $usersCriteria = ['user_id' => $usersArray, 'TD' => null];
      if ($onlyActive) $usersCriteria['status'] = 2;
      $users = Users::find()->where($usersCriteria)->andFilterWhere(['not in', 'user_id', $filter])->distinct()->orderBy('name')->all();
      return $users;
    }
    
    
    
    
         public static function actionGenerateticket($id)
     {
         
         $parent_ticket_id=$id;
         $parent_ticket=  Ticket::findOne(['Ticket_ID'=>$parent_ticket_id, 'TD'=>null]);
         
         $ticket=new Ticket;
         $ticket->CreationTime = date('Y-m-d H:i:s');
        if ($parent_ticket_id) {
          $ticket->DependsOn = $parent_ticket_id;
          $ticket->Module_ID = $ticket->dependsOn->Module_ID;
        }
        $ticket->HighPriorityReason = $parent_ticket->getAttribute('HighPriorityReason');
        $ticket->Author = $parent_ticket->getAttribute('Author');
        $ticket->Status_ID = 1;
        $ticket->Progress = 0;
        $ticket->Priority_ID = $parent_ticket->Priority_ID;
        $ticket->AssignedTo=$parent_ticket->AssignedTo;
        $ticket->Category_ID=$parent_ticket->Category_ID;
        $ticket->Type_ID=$parent_ticket->Type_ID;
        $ticket->Subject=$parent_ticket->Subject;
        $ticket->FD=date('Y-m-d H:i:s');
        $ticket->StartTime=$ticket->CreationTime;
        //var_dump($ticket);
        $newmsg = new Messages();
        $newmsg->Ticket_ID = 0;
        $newmsg->InReplyTo = null;
        $newmsg->DateTime = date('Y-m-d H:i:s');

        $access = SlaController::listModulesByAccessLevel();
        $projects = SlaController::availableProjects($access['create']);
        $products = SlaController::availableProducts($access['create']);
        $modules = SlaController::availableModules($access['create']);
        $module_options = [];
        foreach ($modules as $module) {
          $module_options[$module->Module_ID] = ['data-up' => $module->Product_ID];
        }

        if ($id) {
          $editors = SlaController::availableUsers($ticket->Module_ID, [3,4], [], true);
        }
        else {
          $editors = (count($modules) == 1) ? SlaController::availableUsers($access['create'], [3,4], [], true) : [];
        }

        $viewers = SlaController::availableUsers([$ticket->Module_ID], [1,2,3,4], [$ticket->Author], true);
         

 
       
        
        
        $ticket->save();
        $ticket->refresh();
         
         $period_base=  Period::find()->where(['Ticket_ID' =>  $ticket->DependsOn])->asArray()->all();
         var_dump($ticket->Ticket_ID);
         var_dump($period_base);

    //  if (!empty( $period_years_base)|| !empty( $period_years_base) ||  !empty( $period_days_of_week_base) || !empty($period_time_base) || !empty( $period_dates_base)){
        foreach ($period_base as $key=>$value){
            if (!empty($value['Year'])) $select_years_base[]=$value['Year'];
            if (!empty($value['Month'])) $select_years_base[]=$value['Month'];
            if (!empty($value['Day_Month'])) $select_dates_base[]=$value['Day_Month'];
            if (!empty($value['Weekday'])) $select_days_of_week_base[]=$value['Weekday'];
            if (!empty($value['time'])) $select_time_base[]=$value['time'];
            if (!empty($value['Week'])) $select_everything_base[]=$value['Week'];
            if (!empty($value['Month_check'])) $month_check = true;
        }

         
         
         
       $task=new Tasks;
      $date_end=$ticket->EstTime;
      $datetime=Access::calculationDatetask($select_years_base, $select_years_base, $select_days_of_week, $select_dates_base, $everything, $month_check, $select_time_base, $date_start, $date_end, $datetimelasttask);
     // $task->Date_Time= $datetime;
      $task->Date_Time= $datetime;
      $task->Type_Task=1;
      $task->Ticket_ID=$ticket->DependsOn;
      $task->Status=0;
      $task->save();
         
             $formData['Messages']['Ticket_ID']=$ticket->Ticket_ID;
             $formData['Messages']['InReplyTo']='';
             $formData['Messages']['DateTime']=  $ticket->CreationTime;
             $formData['Messages']['User_ID']=$ticket->Author;
             $formData['Messages']['Text']=$ticket->Subject;
           
         self::Newmessage($formData);
         
         
     }
     
     public static function  actionStartgenerateticket(){
        
         $now=date('Y-m-d H:i:s');
         $tasks= Tasks::findBySql("select * from tasks where (Status=0 and Type_Task=1 and Date_Time<'$now')")->all();
         
        
         foreach ($tasks as $key=>$value){
             $ticket_id=$value->Ticket_ID;
             $connection=Yii::$app->db; 
             $connection->createCommand("update tasks set Status=1 where Ticket_ID=$ticket_id")->query();
             SlaController::actionGenerateticket($ticket_id);
             
             
             exit;
         }
         
     }
     
     
       public static function  actionTestperiodic(){
        
      $array_of_years=  SlaController::getArray_of_years();
      $array_of_months= SlaController::getArray_of_months();
      $array_of_dates=  SlaController::getArray_of_dates();
      $array_of_times=['10:15', '00:34','23:14','08:01'];

      
      $select_years= $array_of_years;
      $select_months=$array_of_months;
      $select_dates=$array_of_dates;
      $time_task=$array_of_times;
      
      
                $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];

          
       var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));          
          
       
              $select_months=[
            
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
     
     
     
              $select_months=[
              3,5
           ];

                    $select_dates=[
           

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
     
     
     
     
              $select_months=[
           
           ];

                    $select_dates=[
              

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
     
     
     
              $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
              
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
     
     
     
              $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4,7];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
     
     
     
              $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[1,2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));  
         
             $select_months=[
             3,5,12,11
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5,1,2,6
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4,5];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              

           ];

                     $select_years=[
               '2016',
               '2017',
                
           ];

                     $select_days_of_week=[];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              11,7

           ];

                     $select_years=[
              
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             
           ];

                    $select_dates=[
              1,2,7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4,1,3];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
              // '2017',
              //  '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
         
           //  $select_months=[
          //   3,5
          // ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
          
           ];

                    $select_dates=[
            

           ];

                     $select_years=[
               '2016',
               
           ];

                     $select_days_of_week=[];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
            
           ];

                    $select_dates=[
             

           ];

                     $select_years=[
               '2016',
              
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
              
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
            
           ];

                    $select_dates=[
              

           ];

                     $select_years=[
               
               
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              

           ];

                     $select_years=[
               '2016',
               
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
             

           ];

                     $select_years=[
               '2016',
               '2017',
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7,2,3

           ];

                     $select_years=[
               
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              1,2,7

           ];

                     $select_years=[
               '2016',
              
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               '2016',
              
                '2018',
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               
                '2019'
           ];

                     $select_days_of_week=[4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
             $select_months=[
             3,5
           ];

                    $select_dates=[
              7

           ];

                     $select_years=[
               
                '2019'
           ];

                     $select_days_of_week=[2,4];
         
        // echo Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null);
         //echo "<hr><hr><hr>";
                     echo "<br>";
         var_dump(Access::calculationDatetask($select_years, $select_months, $select_days_of_week, $select_dates, $select_everything, $month_check, $array_of_times, $ticket->StartTime, $ticket->EstTime, null));      
         
     }
             
}
     
