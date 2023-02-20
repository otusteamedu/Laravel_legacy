<?php

namespace app\controllers;

use Yii;
use yii\base\DynamicModel;
use app\models\Messages;
use app\models\MessagesQuery;
use app\models\TicketWithTime;
use app\models\Modules;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class ReportsController extends SiteController
{
    protected function currentUser() {
      $user = parent::currentUser();
      if (!in_array($user->user_id, [134, 149, 1249, 156])) {
        throw new \yii\web\ForbiddenHttpException('Извините, у вас нет права доступа к этой функциональности');
        return null;
      }
      return $user;
    }

    public $defaultAction = 'index';

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
     * Lists all Messages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = $this->currentUser();

        return $this->render('index', [
        ]);
    }

    public function actionMy()
    {
        $user = $this->currentUser();

        //$access = $this->listModulesByAccessLevel();

        $get_values = Yii::$app->request->get();

        $date_start = date('w') == 1 ? 'today' : 'last monday';

        $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
        $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

        $users = [ $user->user_id ];

        $tickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      'SUM({{messages}}.RealEffort) AS totalEffort'
                  ])
                  ->joinWith('messages')
                  ->where(['User_ID' => $users])->andWhere(['not', ['RealEffort' => null]])
                  //->andWhere(['Module_ID' => $access['view']])
                  ->andWhere(['TD' => null])
                  ->groupBy('{{messages}}.Ticket_ID')
                  ->with('author')->with('module')->with('module.product')->with('module.product.project')->with('status')->with('priority')
                  ->andFilterWhere(['>=', '{{messages}}.DateTime', $from.' 00:00:00'])
                  ->andFilterWhere(['<=', '{{messages}}.DateTime', $to.' 23:59:59'])
                  ->all();

        $overallSum = number_format(array_sum(ArrayHelper::getColumn($tickets, function ($element) {
          return (float)$element['totalEffort'];
        })), 1, ',', ' ');

        $accessible = parent::listModulesByAccessLevel();

        return $this->render('my', [
            'tickets' => $tickets,
            'from' => $from,
            'to' => $to,
            'sum' => $overallSum,
        ]);
    }

    public function actionOthers()
    {
        $user = $this->currentUser();

        $get_values = Yii::$app->request->get();

        $date_start = date('w') == 1 ? 'today' : 'last monday';

        $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
        $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

        $users = !empty($get_values['users']) ? $get_values['users'] : [ $user->user_id ];

        $tickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      'SUM({{messages}}.RealEffort) AS totalEffort'
                  ])
                  ->joinWith('messages')
                  ->where(['User_ID' => $users])->andWhere(['not', ['RealEffort' => null]])
                  //->andWhere(['Module_ID' => $access['view']])
                  ->andWhere(['TD' => null])
                  ->groupBy('{{messages}}.Ticket_ID')
                  ->with('author')->with('module')->with('module.product')->with('module.product.project')->with('status')->with('priority')
                  ->andFilterWhere(['>=', '{{messages}}.DateTime', $from.' 00:00:00'])
                  ->andFilterWhere(['<=', '{{messages}}.DateTime', $to.' 23:59:59'])
                  ->all();

        $overallSum = number_format(array_sum(ArrayHelper::getColumn($tickets, function ($element) {
          return (float)$element['totalEffort'];
        })), 1, ',', ' ');

        $accessible = parent::listModulesByAccessLevel();

        return $this->render('others', [
            'tickets' => $tickets,
            'users' => parent::availableUsers($accessible['view'], [3,4], [], true),
            'selected_users' => $users,
            'from' => $from,
            'to' => $to,
            'sum' => $overallSum,
        ]);
    }

    public function actionBreakdown()
    {
        $user = $this->currentUser();

        $get_values = Yii::$app->request->get();

        $date_start = date('w') == 1 ? 'today' : 'last monday';

        $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
        $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

        $users = !empty($get_values['users']) ? $get_values['users'] : [ $user->user_id ];

        $tickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      '{{messages}}.User_ID AS executor_ID',
                      'SUM({{messages}}.RealEffort) AS totalEffort',
                      '{{messages}}.Message_ID as indexator'
                  ])
                  ->indexBy('indexator')
                  ->joinWith('messages')
                  ->andWhere(['not', ['RealEffort' => null]])
                  ->andWhere(['TD' => null])
                  ->orderBy(['Ticket_ID' => SORT_ASC, 'executor_ID' => SORT_ASC])
                  ->groupBy(['executor_ID', 'Ticket_ID'])
                  ->with('author')->with('module')->with('module.product')->with('module.product.project')->with('status')->with('priority')->with('executor')
                  ->andFilterWhere(['>=', '{{messages}}.DateTime', $from.' 00:00:00'])
                  ->andFilterWhere(['<=', '{{messages}}.DateTime', $to.' 23:59:59'])
                  ->having(['executor_ID' => $users])
                  ->all();

        $overallSum = number_format(array_sum(ArrayHelper::getColumn($tickets, function ($element) {
          return (float)$element['totalEffort'];
        })), 1, ',', ' ');

        $accessible = parent::listModulesByAccessLevel();

        return $this->render('breakdown', [
            'tickets' => $tickets,
            'users' => parent::availableUsers($accessible['view'], [3,4], [], true),
            'selected_users' => $users,
            'from' => $from,
            'to' => $to,
            'sum' => $overallSum
        ]);
    }

    public function actionProject()
    {
        $user = $this->currentUser();

        $get_values = Yii::$app->request->get();

        $date_start = date('w') == 1 ? 'today' : 'last monday';

        $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
        $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

        $projects = parent::allProjects();
        $currentProject = empty($get_values['Project_ID']) ? '' : $get_values['Project_ID'];

        $allmodules = $products = [];
        if ($currentProject) {
          $products = parent::allProducts($currentProject);
          $allmodules = parent::allModules(ArrayHelper::getColumn($products, 'Product_ID'));
        }

        //var_dump($products); exit;

        $creationdate0 = isset($get_values['creationdate0']) ? $get_values['creationdate0'] : '';
        $creationdate1 = isset($get_values['creationdate1']) ? $get_values['creationdate1'] : '';
        $startdate0 = isset($get_values['startdate0']) ? $get_values['startdate0'] : '';
        $startdate1 = isset($get_values['startdate1']) ? $get_values['startdate1'] : '';
        $estdate0 = isset($get_values['estdate0']) ? $get_values['estdate0'] : '';
        $estdate1 = isset($get_values['estdate1']) ? $get_values['estdate1'] : '';

        $creationdate0_q = $creationdate0 ? $creationdate0.' 00:00:00' : '';
        $creationdate1_q = $creationdate1 ? $creationdate1.' 23:59:59' : '';
        $startdate0_q = $startdate0 ? $startdate0.' 00:00:00' : '';
        $startdate1_q = $startdate1 ? $startdate1.' 23:59:59' : '';
        $estdate0_q = $estdate0 ? $estdate0.' 00:00:00' : '';
        $estdate1_q = $estdate1 ? $estdate1.' 23:59:59' : '';


        $tickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      'SUM({{messages}}.RealEffort) AS totalEffort'
                  ])
                  ->joinWith('messages')
                  ->where(['Module_ID' => ArrayHelper::getColumn($allmodules, 'Module_ID')])
                  ->andWhere(['TD' => null])
                  ->groupBy('{{messages}}.Ticket_ID')
                  ->orderBy(['Module_ID' => SORT_ASC, 'Ticket_ID' => SORT_ASC])
                  ->with('assignedTo')->with('module')->with('module.product')->with('status')->with('priority')
                  ->andFilterWhere(['>=', 'CreationTime', $creationdate0_q])
                  ->andFilterWhere(['<=', 'CreationTime', $creationdate1_q])
                  ->andFilterWhere(['>=', 'StartTime', $startdate0_q])
                  ->andFilterWhere(['<=', 'StartTime', $startdate1_q])
                  ->andFilterWhere(['>=', 'EstTime', $estdate0_q])
                  ->andFilterWhere(['<=', 'EstTime', $estdate1_q])
                  ->all();

        $overallSum = number_format(array_sum(ArrayHelper::getColumn($tickets, function ($element) {
          return (float)$element['totalEffort'];
        })), 1, ',', ' ');


        return $this->render('project', [
            'tickets' => $tickets,
            'creationdate0' => $creationdate0,
            'creationdate1' => $creationdate1,
            'startdate0' => $startdate0,
            'startdate1' => $startdate1,
            'estdate0' => $estdate0,
            'estdate1' => $estdate1,
            'projects' => $projects,
            'currentProject' => $currentProject,
            'sum' => $overallSum
        ]);

    }

    public function actionExcel() {
      $user = $this->currentUser();

      $get_values = Yii::$app->request->get();

      $date_start = date('w') == 1 ? 'today' : 'last monday';

      $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
      $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

      $users = !empty($get_values['users']) ? $get_values['users'] : [ $user->user_id ];

      $tickets = TicketWithTime::find()
                ->select([
                    '{{tickets}}.*',
                    'SUM({{messages}}.RealEffort) AS totalEffort'
                ])
                ->joinWith('messages')
                ->where(['User_ID' => $users])->andWhere(['not', ['RealEffort' => null]])
                //->andWhere(['Module_ID' => $access['view']])
                ->andWhere(['TD' => null])
                ->groupBy('{{messages}}.Ticket_ID')
                ->with('author')->with('module')->with('module.product')->with('module.product.project')->with('status')->with('priority')
                ->andFilterWhere(['>=', '{{messages}}.DateTime', $from.' 00:00:00'])
                ->andFilterWhere(['<=', '{{messages}}.DateTime', $to.' 23:59:59'])
                ->all();

      return \moonland\phpexcel\Excel::widget([
    'models' => $tickets,
    'mode' => 'export', //default value as 'export'
    'columns' => [
      'Ticket_ID:text:ID запроса',
      'Subject:text:Тема запроса',
      [
        'attribute' => 'project',
        'header' => 'Проект',
        'format' => 'text',
        'value' => function($model) {
            return $model->module->product->project->Name;
        },
      ],
      [
        'attribute' => 'author',
        'header' => 'Автор',
        'format' => 'text',
        'value' => function($model) {
            return trim($model->author->name);
        },
      ],
      [
        'attribute' => 'status',
        'header' => 'Статус',
        'format' => 'text',
        'value' => function($model) {
            return $model->status->Name;
        },
      ],
      [
        'attribute' => 'priority',
        'header' => 'Критичность',
        'format' => 'text',
        'value' => function($model) {
            return $model->priority->Name;
        },
      ],
      'totalEffort:decimal:Затраченное время',
    ],
    'fileName' => 'Отчет о затраченном времени за '.$from.' - '.$to.' ('.trim($user->name).').xlsx',
]);
    }

    public function actionExcel1() {
      $user = $this->currentUser();

      $get_values = Yii::$app->request->get();

      $date_start = date('w') == 1 ? 'today' : 'last monday';

      $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
      $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

      $users = !empty($get_values['users']) ? $get_values['users'] : [ $user->user_id ];

      $tickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      '{{messages}}.User_ID AS executor_ID',
                      'SUM({{messages}}.RealEffort) AS totalEffort',
                      '{{messages}}.Message_ID as indexator'
                  ])
                  ->indexBy('indexator')
                  ->joinWith('messages')
                  ->andWhere(['not', ['RealEffort' => null]])
                  ->andWhere(['TD' => null])
                  ->orderBy(['Ticket_ID' => SORT_ASC, 'executor_ID' => SORT_ASC])
                  ->groupBy(['executor_ID', 'Ticket_ID'])
                  ->with('author')->with('module')->with('module.product')->with('module.product.project')->with('status')->with('priority')->with('executor')
                  ->andFilterWhere(['>=', '{{messages}}.DateTime', $from.' 00:00:00'])
                  ->andFilterWhere(['<=', '{{messages}}.DateTime', $to.' 23:59:59'])
                  ->having(['executor_ID' => $users])
                  ->all();

      return \moonland\phpexcel\Excel::widget([
    'models' => $tickets,
    'mode' => 'export', //default value as 'export'
    'columns' => [
      'Ticket_ID:text:ID запроса',
      'Subject:text:Тема запроса',
      [
        'attribute' => 'project',
        'header' => 'Проект',
        'format' => 'text',
        'value' => function($model) {
            return $model->module->product->project->Name;
        },
      ],
      [
        'attribute' => 'status',
        'header' => 'Статус',
        'format' => 'text',
        'value' => function($model) {
            return $model->status->Name;
        },
      ],
      [
        'attribute' => 'priority',
        'header' => 'Критичность',
        'format' => 'text',
        'value' => function($model) {
            return $model->priority->Name;
        },
      ],
      [
        'attribute' => 'executor',
        'header' => 'Исполнитель',
        'format' => 'text',
        'value' => function($model) {
            return trim($model->executor->name);
        },
      ],
      'totalEffort:decimal:Затраченное время',
    ],
    'fileName' => 'Отчет о затраченном времени за '.$from.' - '.$to.' ('.trim($user->name).').xlsx',
]);
    }

    public function actionExcel2()
    {
        $user = $this->currentUser();

        $get_values = Yii::$app->request->get();

        $date_start = date('w') == 1 ? 'today' : 'last monday';

        $from = !empty($get_values['from']) ? $get_values['from'] : date('Y-m-d', strtotime($date_start));
        $to = !empty($get_values['to']) ? $get_values['to'] : date('Y-m-d',strtotime($date_start.' + 4 days'));

        $projects = parent::allProjects();
        $currentProject = empty($get_values['Project_ID']) ? '' : $get_values['Project_ID'];

        $allmodules = $products = [];
        if ($currentProject) {
          $products = parent::allProducts($currentProject);
          $allmodules = parent::allModules(ArrayHelper::getColumn($products, 'Product_ID'));
        }

        //var_dump($products); exit;

        $creationdate0 = isset($get_values['creationdate0']) ? $get_values['creationdate0'] : '';
        $creationdate1 = isset($get_values['creationdate1']) ? $get_values['creationdate1'] : '';
        $startdate0 = isset($get_values['startdate0']) ? $get_values['startdate0'] : '';
        $startdate1 = isset($get_values['startdate1']) ? $get_values['startdate1'] : '';
        $estdate0 = isset($get_values['estdate0']) ? $get_values['estdate0'] : '';
        $estdate1 = isset($get_values['estdate1']) ? $get_values['estdate1'] : '';

        $creationdate0_q = $creationdate0 ? $creationdate0.' 00:00:00' : '';
        $creationdate1_q = $creationdate1 ? $creationdate1.' 23:59:59' : '';
        $startdate0_q = $startdate0 ? $startdate0.' 00:00:00' : '';
        $startdate1_q = $startdate1 ? $startdate1.' 23:59:59' : '';
        $estdate0_q = $estdate0 ? $estdate0.' 00:00:00' : '';
        $estdate1_q = $estdate1 ? $estdate1.' 23:59:59' : '';

        $tickets = TicketWithTime::find()
                  ->select([
                      '{{tickets}}.*',
                      'SUM({{messages}}.RealEffort) AS totalEffort'
                  ])
                  ->joinWith('messages')
                  ->where(['Module_ID' => ArrayHelper::getColumn($allmodules, 'Module_ID')])
                  ->andWhere(['TD' => null])
                  ->groupBy('{{messages}}.Ticket_ID')
                  ->orderBy(['Module_ID' => SORT_ASC, 'Ticket_ID' => SORT_ASC])
                  ->with('assignedTo')->with('module')->with('module.product')->with('status')->with('priority')
                  ->andFilterWhere(['>=', 'CreationTime', $creationdate0_q])
                  ->andFilterWhere(['<=', 'CreationTime', $creationdate1_q])
                  ->andFilterWhere(['>=', 'StartTime', $startdate0_q])
                  ->andFilterWhere(['<=', 'StartTime', $startdate1_q])
                  ->andFilterWhere(['>=', 'EstTime', $estdate0_q])
                  ->andFilterWhere(['<=', 'EstTime', $estdate1_q])
                  ->all();

        $overallSum = number_format(array_sum(ArrayHelper::getColumn($tickets, function ($element) {
          return (float)$element['totalEffort'];
        })), 1, ',', ' ');return \moonland\phpexcel\Excel::widget([
    'models' => $tickets,
    'mode' => 'export',
    'columns' => [
      'Ticket_ID:text:ID запроса',
      [
        'attribute' => 'product',
        'header' => 'Продукт',
        'format' => 'text',
        'value' => function($model) {
            return $model->module->product->Name;
        },
      ],
      [
        'attribute' => 'module',
        'header' => 'Подсистема',
        'format' => 'text',
        'value' => function($model) {
            return $model->module->Name;
        },
      ],
      'Subject:text:Тема запроса',
      [
        'attribute' => 'assignee',
        'header' => 'Исполнитель',
        'format' => 'text',
        'value' => function($model) {
            return trim($model->assignedTo->name);
        },
      ],
      [
        'attribute' => 'StartTime',
        'header' => 'Дата начала',
        'format' => 'text',
        'value' => function($model) {
            return $model->StartTime > '2000' ? $model->StartTime : 'не задана';
        },
      ],
      [
        'attribute' => 'EstTime',
        'header' => 'Планируемая дата завершения',
        'format' => 'text',
        'value' => function($model) {
            return $model->EstTime > '2000' ? $model->EstTime : 'не задана';
        },
      ],
      [
        'attribute' => 'status',
        'header' => 'Статус',
        'format' => 'text',
        'value' => function($model) {
            return $model->status->Name;
        },
      ],
      [
        'attribute' => 'priority',
        'header' => 'Критичность',
        'format' => 'text',
        'value' => function($model) {
            return $model->priority->Name;
        },
      ],
      [
        'attribute' => 'EstEffort',
        'header' => 'Трудоёмкость',
        'format' => 'decimal',
        'value' => function($model) {
            return $model->EstEffort * 1;
        },
      ],
      [
        'attribute' => 'totalEffort',
        'header' => 'Затраченное время',
        'format' => 'decimal',
        'value' => function($model) {
            return $model->totalEffort * 1;
        },
      ],
      [
        'attribute' => 'delta',
        'header' => 'Дельта времени',
        'format' => 'decimal',
        'value' => function($model) {
            return $model->totalEffort * 1 - $model->EstEffort * 1;
        },
      ],
    ],
    'fileName' => 'Сводка задач по проекту «'.$tickets[0]->module->product->project->Name.'» ('.trim($user->name).').xlsx',
]);

    }

    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
