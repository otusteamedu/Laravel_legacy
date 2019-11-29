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
use app\models\Departments;
use app\models\Companies;

class TtController extends SiteController
{
    private $IThelp_assignee_ID = 158; // it-help
    private $IThelp_request_type_ID = 10; // Запрос на обслуживание
    private $target_module_name = 'Входящие обращения';

    private function relevantProductsAndModules($active_project) {
      $access = $this->listModulesByAccessLevel();

      $products = $this->availableProducts($access['create'], $active_project);
      $target_modules = [];

      $modules0 = $this->availableModules($access['create'], ArrayHelper::getColumn($products, 'Product_ID'));

      foreach($modules0 as $module) {
        if ($module['Name'] == $this->target_module_name) {
          $target_modules[$module['Product_ID']] = $module;
        }
      }

      foreach($products as $k => $product) {
        if (!isset($target_modules[$product['Product_ID']])) {
          unset($products[$k]);
        }
      }

      return [$products, $target_modules];
    }

    private function IT_project($company_id) {
      $IT_projects = [
          1 => 14,
          2 => 11
      ];
      if ($IT_projects[$company_id]) return $IT_projects[$company_id];
      else return false;
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

    public $defaultAction = 'about';

    public function actionIndex()
    {
       
        $session = new Session;
        $session->open();

        $this->layout = 'tt';

        $query0 = Ticket::find();
        $query0->where(['Tickets.TD' => null]);

        $user = $this->currentUser();
        
        
        // временная мера — показываем типовые запросы только сотрудникам Ньюлэнда (1) и Кенфордбела (5)
        $company_id = Yii::$app->db->createCommand("SELECT Company_ID FROM Departments WHERE Department_ID=".$user->department_id)->queryScalar('Company_ID');
        $internal_user = in_array($company_id, [1,5]);
        
   

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
              $filterExtended = true;
            }
          }
        }
        if (!empty($get_values['Messages']['Text'])) {
          $filterEmpty = false;
        }

        if (empty($get_values['SortBy'])) {
          $get_values['SortBy'] = ["Status", "ChangedDate"];
        }

        if ($filterEmpty) {
          $query0->andWhere(['not in', 'Status_ID', [6,8]]);
        }
        else {
          foreach ($filter->attributes() as $attr) {
            $query0->andFilterWhere([$attr => $filter->{$attr}]);
          }
          if (!empty($get_values['Ticket']['creationdate0'])) $query0->andFilterWhere(['>=', 'CreationTime', $get_values['Ticket']['creationdate0'].' 00:00:00']);
          if (!empty($get_values['Ticket']['creationdate1'])) $query0->andFilterWhere(['<=', 'CreationTime', $get_values['Ticket']['creationdate1'].' 23:59:59']);
          if (!empty($get_values['Ticket']['estdate0'])) $query0->andFilterWhere(['>=', 'EstTime', $get_values['Ticket']['estdate0'].' 00:00:00']);
          if (!empty($get_values['Ticket']['estdate1'])) $query0->andFilterWhere(['<=', 'EstTime', $get_values['Ticket']['estdate1'].' 23:59:59']);
          if (!empty($get_values['Messages']['Text'])) {
            $relevant_ids = Messages::find()->where(['like', 'Text', $get_values['Messages']['Text']])->select(['Ticket_ID', 'Text'])->asArray()->all();
            $query0->andWhere(['Ticket_ID' => $relevant_ids]);
          }

        }

        $query0
              ->with('priority')->with('type')->with('status')
              ->with('module')->with('module.product')
              ->distinct();

        if (empty($get_values['SortBy'])) {
          $get_values['SortBy'] = ["Status", "ChangedDate"];
        }

        $query0->andWhere(['Author' => $user->user_id ])
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
              ->with('module')->with('module.product')
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

        $session['indexUrl'] = Url::current();

        $dept = Departments::find()->where(['Department_ID' => $user->department_id])->distinct()->asArray()->one();
        $active_project = $this->IT_project($dept['Company_ID']);
        list($products, $target_modules) = $this->relevantProductsAndModules($active_project);

        return $this->render('index', [
            'user' => $user,
            'filter' => $filter,
            'filterEmpty' => $filterEmpty,
            'filterExtended' => $filterExtended,
            'modules' => $target_modules,
            'creationdate0' => isset($get_values['Ticket']['creationdate0']) ? $get_values['Ticket']['creationdate0'] : '',
            'creationdate1' => isset($get_values['Ticket']['creationdate1']) ? $get_values['Ticket']['creationdate1'] : '',
            'estdate0' => isset($get_values['Ticket']['estdate0']) ? $get_values['Ticket']['estdate0'] : '',
            'estdate1' => isset($get_values['Ticket']['estdate1']) ? $get_values['Ticket']['estdate1'] : '',
            'sortSettings' => $get_values['SortBy'],
            'tickets' => $tickets,
            'pages' => $pages,
            'message' => $message,
            'canCreate' => count($access['create']),
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

    public function actionView($id)
    {
        $session = new Session;
        $session->open();
        $backurl = empty($session['indexUrl']) ? Url::toRoute(['tt/index']) : $session['indexUrl'];

        $this->layout = 'tt';

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

         $attachments =  MessageFile::find()->with('message')->where(['Message_ID' => $ids])->all();
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
        $query3 = Ticket::find();
        $condition = ['DependsOn' => $id, 'TD' => null];
        $subtickets = $query3->where($condition)->andWhere(['Module_ID' => $access['view']])->all();

        $dept = Departments::find()->where(['Department_ID' => $identity->department_id])->distinct()->asArray()->one();
        $active_project = $this->IT_project($dept['Company_ID']);

        list($products, $target_modules) = $this->relevantProductsAndModules($active_project);

        $newmsg = new Messages();

        $viewers = $this->availableUsers(ArrayHelper::getColumn($target_modules, 'Module_ID'), [1,2,3,4], [$ticket->Author], true);

        return $this->render('edit', [
            'ticket' => $ticket,
            'backurl' => $backurl,
            'newmsg' => $newmsg,
            'products' => $products,
            'target_modules' => $target_modules,
            'viewers' => $viewers,
            'isReadOnly' => false,
            'ticketbody' => count($messages) > 0 ? $messages[0] : new Messages(),
            'messages' => $messages,
            'attachments' => $attachments,
            'attachments1' => $attachments1,
            'attachmentsByMessage' => $attachmentsByMessage,
            'attachments1ByMessage' => $attachments1ByMessage,
        ]);
    }

    public function actionCreate($id = '')
    {

        $session = new Session;
        $session->open();
        $backurl = empty($session['indexUrl']) ? Url::toRoute(['tt/view']) : $session['indexUrl'];

        $this->layout = 'tt';

        $identity = $this->currentUser();

        $dept = Departments::find()->where(['Department_ID' => $identity->department_id])->distinct()->asArray()->one();
        $active_project = $this->IT_project($dept['Company_ID']);

        $ticket = new Ticket();
        $ticket->StartTime = $ticket->CreationTime = date('Y-m-d H:i:s');
        $ticket->HighPriorityReason = '';
        $ticket->Author = $identity->user_id;
        $ticket->Status_ID = 1;
        $ticket->Progress = 0;
        $ticket->Priority_ID = 1;

        $newmsg = new Messages();
        $newmsg->Ticket_ID = 0;
        $newmsg->InReplyTo = null;
        $newmsg->DateTime = date('Y-m-d H:i:s');

        list($products, $target_modules) = $this->relevantProductsAndModules($active_project);

        $viewers = $this->availableUsers(ArrayHelper::getColumn($target_modules, 'Module_ID'), [1,2,3,4], [$ticket->Author], true);

        return $this->render('create', [
            'ticket' => $ticket,
            'backurl' => $backurl,
            'newmsg' => $newmsg,
            'products' => $products,
            'target_modules' => $target_modules,
            'viewers' => $viewers,
            'isReadOnly' => false
        ]);

    }

    public function actionUpdate($id)
    {
        $session = new Session;
        $session->open();
        $backurl = empty($session['indexUrl']) ? Url::toRoute(['tt/index']) : $session['indexUrl'];

        $this->layout = 'tt';

        $query0 = Ticket::find();
        $condition = ['Ticket_ID' => $id, 'TD' => null];
        $ticket = $query0->where($condition)->with('author')->with('assignedTo')->with('dependsOn')->with('module')->one();

        if (!$ticket) {
          throw new \yii\web\NotFoundHttpException();
          return;
        }

        $identity = $this->currentUser();

        $rights = $this->checkRights($ticket->Module_ID, $identity->user_id);
        $canAccess = array_intersect($rights, [3,4]);
        if (count($canAccess) < 1) return $this->redirect(['tt/index', 'msg' => 'Check the rights for the operation']);

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

        $access = $this->listModulesByAccessLevel();
        $query3 = Ticket::find();
        $condition = ['DependsOn' => $id, 'TD' => null];
        $subtickets = $query3->where($condition)->andWhere(['Module_ID' => $access['view']])->all();

        $newmsg = new Messages();

        $resolution = !empty($ticket->ticketResolution) ? $ticket->ticketResolution : new TicketResolution();

        $access = $this->listModulesByAccessLevel();
        $projects = $this->availableProjects($access['edit']);
        $products = $this->availableProducts($access['edit'], $ticket->module->product->getAttribute('Project_ID'));
        $modules = $this->availableModules($access['edit'], $ticket->module->getAttribute('Product_ID'));
        $module_options = [];
        foreach ($modules as $module) {
          $module_options[$module->Module_ID] = ['data-up' => $module->Product_ID];
        }

        $editors = $this->availableUsers([$ticket->Module_ID], [3,4], [], true);

        $viewers = $this->availableUsers([$ticket->Module_ID], [1,2,3,4], [$ticket->Author], true);

        return $this->render('edit', [
            'ticket' => $ticket,
            'messages' => $messages,
            'attachments' => $attachments,
            'attachmentsByMessage' => $attachmentsByMessage,
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
            'editors' => $editors,
            'viewers' => $viewers,
        ]);
    }

    public function actionNewticket() {
      $identity = $this->currentUser();

      $formData = Yii::$app->request->post();

      $ticket = new Ticket();

      $ticket->FD = $ticket->CreationTime = date('Y-m-d H:i:s');
      $l = $ticket->load($formData);

      $ticket->Ticket_ID = 0;
      $ticket->AssignedTo = $this->IThelp_assignee_ID;
      $ticket->Subject = $ticket->module->product->Name . ' (IT-help)';
      $ticket->Category_ID = 1;
      $ticket->Type_ID = $this->IThelp_request_type_ID;
      $ticket->Author = $identity->user_id;
      $ticket->Status_ID = 1;
      $ticket->Progress = 0;
      $ticket->HighPriorityReason = '';

      if ($l && $ticket->save()) {
          $id = $ticket->Version_ID;

          $ticket->Ticket_ID = $id;

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
            $files = $this->handleFiles1($newmsg);
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

        $this->informSubscribers($ticket, $identity, '', [], [], $emails, true);
        return $this->redirect(['tt/index']);
      }
      else return $this->redirect(['tt/index']);
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
         пропущенным полям (кроме ID реализации) копируем старые значения — они не меняются */
      foreach ($ticket0 as $field => $value) {
        if ($field != 'Version_ID' && empty($ticket[$field])) $ticket[$field] = $value;
      }

      $rights = $this->checkRights($ticket0->Module_ID, $user->user_id);
      $canAccess = array_intersect($rights, [3,4]);
      if (count($canAccess) < 1) return $this->redirect(['tt/index', 'msg' => 'Check the rights for the operation']);

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
          $system_msg[] = 'Переведен из <b>корневого запроса</b> в <b>подзапрос</b> для АЗ <a href="'.Url::toRoute(['tt/view', 'id' => $ticket->DependsOn]).'">#'.$ticket->DependsOn.'</a>';
        }
        elseif ($ticket->DependsOn == null) {
          $system_msg[] = 'Переведен из <b>подзапроса</b> для АЗ <a href="'.Url::toRoute(['tt/view', 'id' => $ticket0->DependsOn]).'">#'.$ticket0->DependsOn.'</a> в <b>корневой запрос</b>';
        }
        else
          $system_msg[] = '<b>Подзапрос для АЗ:</b> <a href="'.Url::toRoute(['tt/view', 'id' => $ticket0->DependsOn]).'">#' . $ticket0->DependsOn . '</a> → <a href="'.Url::toRoute(['tt/view', 'id' => $ticket->DependsOn]).'">#'.$ticket->DependsOn.'</a>';
      }
      if ($ticket->AssignedTo != $ticket0->AssignedTo) {
        $oldAssignee = Users::Find()->where(['user_id'=>$ticket0->AssignedTo, 'TD'=>null])->one();
        $newAssignee = Users::Find()->where(['user_id'=>$ticket->AssignedTo, 'TD'=>null])->one();
        $system_msg[] = '<b>Исполнитель:</b> <a href="'.Url::toRoute(['profile/alien', 'id' => $oldAssignee->id]).'">' . $oldAssignee->name . '</a> → <a href="'.Url::toRoute(['profile/alien', 'id' => $newAssignee->id]).'">'.$newAssignee->name.'</a>';
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

      $rawtext = trim($newmsg->Text) . $resolution_text;
      $newmsg->Text = $rawtext;

      $newmsg->Ticket_ID = $ticket->Ticket_ID;
      $newmsg->InReplyTo = null;
      $newmsg->DateTime = date('Y-m-d H:i:s');
      $newmsg->User_ID =  $user->user_id;

      if ($msg_ok && $newmsg->save()) {

          // ok
          $files = $this->handleFiles1($newmsg);

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

          $this->informSubscribers($ticket, $user, $rawtext, $system_msg, $files, $emails, false, $newSubscribers, $removedSubscribers);

      } else {
          //var_dump([$msg_ok, $newmsg]);
          //exit;
          // error
      }

      if ($ticket->save()) {
          return $this->redirect(['view', 'id' => $ticket->Ticket_ID]);
      } else {
          return $this->redirect(['index']);
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
            $files = $this->handleFiles1($model);

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
      return $this->redirect(['tt/view', 'id' => $model->Ticket_ID, 'files' => $files]);

    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {

           $identity = Yii::$app->user->getIdentity();
           if(is_object($identity) && $identity->username=='admin'){

            return $this->redirect(['tt/admin']);

           }
           else {
             return $this->redirect(['tt/index']);
           }
        }

     $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
           if(Yii::$app->user->getIdentity()->status==2)  {
            return $this->redirect(['tt/index']);
           }
           elseif(Yii::$app->user->getIdentity()->status==1){
              $message="Введенный логин был заблокирован Администратором. Авторизация невозможна";
             Yii::$app->user->logout();
              $this->layout = 'tt';
              return $this->render('login', [
                'model' => $model,
                'message' =>$message,
            ]);
           }
           else{
             $message="Введенный логин был заблокирован Администратором. Авторизация невозможна";
             Yii::$app->user->logout();
              $this->layout = 'tt';
              return $this->render('login', [
                'model' => $model,
                'message' =>$message,
            ]);

           }
        } else {
            $this->layout = 'tt';
            return $this->render('login', [
                'model' => $model,
                'message' => '',
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['tt/login']);

    }

      public function actionAbout(){
         
        $identity = $this->currentUser();
        // временная мера — показываем типовые запросы только сотрудникам Ньюлэнда (1) и Кенфордбела (5)
        $company_id = Yii::$app->db->createCommand("SELECT Company_ID FROM Departments WHERE Department_ID=".$identity->department_id)->queryScalar('Company_ID');
        $internal_user = in_array($company_id, [1,5]);
        $this->layout = 'tt';
        if($internal_user){
        return $this->render('about', ['internal_user' => $internal_user]);
        }
        else{
          return  $this->redirect(['tt/index']);
        }
    }
}
