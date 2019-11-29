<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\Departments;
use app\models\Roles;
use yii\helpers\ArrayHelper;
use app\models\UsersRoles;
use app\models\Access;
use app\models\AccessQuery;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex(){
        
  
         \app\models\Access::isAdmin();
        $searchModel = new UsersQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        $models = $dataProvider->getModels();
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'models'=>$models,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       
         \app\models\Access::isAdmin();
         $department_id=$this->findModel($id)->department_id;
       $department= \app\models\Departments::findOne($department_id);
       $department_name=$department->Name;
       $company_id=$department->Company_ID;
       $company=  \app\models\Companies::findOne($company_id);
       $company_name=$company->Name;
           $roles = Roles::find()->all();
      foreach ($roles as $key=>$value){
        $key=$value->getAttribute('Role_ID');
        $rolesArray[$key]=$value->getAttribute('Name');
      }
      
        $model = $this->findModel($id);
        $user_id= $model->getAttribute('user_id');
        
        
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $roles_this_user = ArrayHelper::getColumn($roles, 'Role_ID');
        
        
         $department_id=$this->findModel($id)->department_id;
       $department= \app\models\Departments::findOne($department_id);
       $department_name=$department->Name;
       $company_id=$department->Company_ID;
       $company=  \app\models\Companies::findOne($company_id);
       $company_name=$company->Name;
       $model=$this->findModel($id);
      // $model->setAttribute("department_id", $department);
         $user_id= $this->findModel($id)->user_id;

        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $rolesArray1 = ArrayHelper::getColumn($roles, 'Role_ID');
        $rights = Access::find()->where(['Role_ID' => $rolesArray1])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();

        $project_tree = [];

        foreach ($rights as $item) {
          /* пропускаем ошибочные доступы, которым не соответствуют никакие реальные подсистемы */
          if (empty($item['module'])) continue;
          /* собираем древовидный массив вида [
            id_проекта => [
              name => имя_проекта,
              products => [
                id_продукта => [
                  name => имя_прдукта,
                  modules => [
                    id_подсистемы => [
                      name => имя_подсистемы,
                      right => максимальный_доступ
                    ]
                  ]
                ]
              ]
            ] */
          $project_id = $item['module']['product']['project']['Project_ID'];
          $product_id = $item['module']['product']['Product_ID'];
          $module_id = $item['module']['Module_ID'];
          $right = $item['Level_Rights'];
          if (!isset($project_tree[$project_id])) {
            $project_tree[$project_id] = ['name' => $item['module']['product']['project']['Name'], 'products' => []];
          }
          if (!isset($project_tree[$project_id]['products'][$product_id])) {
            $project_tree[$project_id]['products'][$product_id] = ['name' => $item['module']['product']['Name'], 'modules' => []];
          }
          if (!isset($project_tree[$project_id]['products'][$product_id]['modules'][$module_id])) {
            $project_tree[$project_id]['products'][$product_id]['modules'][$module_id] = ['name' => $item['module']['Name'], 'right' => $right];
          }
          elseif ($project_tree[$project_id]['products'][$product_id]['modules'][$module_id]['right'] < $right) {
            $project_tree[$project_id]['products'][$product_id]['modules'][$module_id]['right'] = $right;
          }
        }
        
        
         
        return $this->render('view', [
            'project_tree' => $project_tree, 
            'model' => $this->findModel($id),
            'roles_this_user' => $roles_this_user, 
            'rolesArray' => $rolesArray,
            'department_name'=>$department_name,
            'company_name'=>$company_name,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate1()
    {
        \app\models\Access::isAdmin();
        
                
        $model = new Users();
        
        $roles = Roles::find()->all();
      foreach ($roles as $key=>$value){
        $key=$value->getAttribute('Role_ID');
        $rolesArray[$key]=$value->getAttribute('Name');
      }
      
       
      $companies_list=  array();
  $h=  \app\models\Companies::find()->all();
  foreach ($h as $key=>$value){
      $key=$value->getAttribute('Company_ID');
      $companies_list[$key]=$value->getAttribute('Name');
  }
      
      
         $departments_list=  array();
  $h=Departments::find()->all();
  foreach ($h as $key=>$value){
      $key=$value->getAttribute('Department_ID');
      $departments_list[$key]=$value->getAttribute('Name');
  }
        
        
        
        
        $h=$model->load(Yii::$app->request->post());
       $password_without_md5=\app\models\Access::generatePassword(8); //only for send in emal
        $model->setAttribute('password', md5($password_without_md5));
        $model->setAttribute('FD', date('Y-m-j H:i:s'));
        $model->setAttribute('TD', '0');
        $model->setAttribute('user_id', 99999999);
        if ($h && $model->save()) {
            
          // $user_id= $model->getAttribute('user_id');
            //$connection=Yii::$app->db; 
           //$connection->createCommand("delete from users_roles where user_id=$user_id")->query();
            $user_id =$model->getAttribute('id')+1000;
              $model->setAttribute('user_id', $user_id);
              $model->save();
           if (isset(Yii::$app->request->post()['roles'])){
             foreach (Yii::$app->request->post()['roles'] as $key=>$value){
            $connection=Yii::$app->db; 
            $connection->createCommand("insert into users_roles (user_id, role_id) values ($user_id, $key)" )->query();
             }
           }
            
              $array_of_emails=explode(";", $model->getAttribute('email'));
              $email=$array_of_emails[0];
              $login=$model->getAttribute('username');
              $fio=  $model->getAttribute('name');
              
              
          $message ="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio! </p>
<p>Вы получили это письмо, потому что для вашего e-mail была запрошена регистрация на портале support.someproject.by
Сообщаем вам, что процедура регистрации завершена успешно. </p>

<p>Данные для доступа:</p>
<p>Логин: $login</p>
<p>Пароль: $password_without_md5</p>
<p>
Чтобы авторизоваться на портале перейдите по ссылке:
http://support.someproject.by/</p>

<p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

<p>С уважением, 
Администрация сайта support.someproject.by</p></body></html>";
            mail($email, '=?UTF-8?B?'.base64_encode('Регистрация на support.someproject.by').'?=', $message, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for user
            
            $email_responsible=$model->getAttribute('email_responsible');
            if ($model->getAttribute('email_responsible')!=''){
                $fio_respobsible=$model->getAttribute('responsible');
                $message_responsible="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio_respobsible !
По вашей заявке успешно был зарегистрирован пользователь '$fio'. </p><p>Данные для авторизации были направлены на email '$email'. </p>

<p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

<p>С уважением, 
Администрация сайта support.someproject.by</p></body></html>";
                mail($email_responsible, '=?UTF-8?B?'.base64_encode('Регистрация на support.someproject.by').'?=', $message_responsible, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for responsible
            }
            
          
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'project_tree'=>$project_tree,
                'model' => $model,
                'departments_list'=>$departments_list,
                'companies_list'=>$companies_list,
                'rolesArray' => $rolesArray,
            ]);
        }
    }

    
     public function actionCreate()
    {
        \app\models\Access::isAdmin();
        
             
        $model = new Users();
        
       $_SESSION['user_create']=1;
        
       $time=time();
       
       $password_without_md5=\app\models\Access::generatePassword(8); //only for send in emal
        $model->setAttribute('password', md5($password_without_md5));
        $model->setAttribute('FD', date('Y-m-j H:i:s'));
        $model->setAttribute('TD', '0');
        $model->setAttribute('user_id', 99999999);
        $model->setAttribute('realname', 'new');
        $model->setAttribute('surname', 'new');
        $model->setAttribute('second_name', 'new');
         $model->setAttribute('username', 'newlogin-'.$time);
        $model->setAttribute('email', '1453453454@someproject.by');
         $model->setAttribute('phone', '123');
         $model->setAttribute('status', 2);
        $model->setAttribute('department_id', 1);
        $model->setAttribute('position', 'должность');
       
       
        
        
       
        if ($model->save()) {
             $user_id =$model->getAttribute('id')+1000;
             $model->setAttribute('user_id', $user_id);
             $login=$model->getAttribute('username');
             $model->save();
        $personal_role=new Roles();
        
        $personal_role->setAttribute('Name', 'newlogin-'.$time);
        $personal_role->setAttribute('Description', 'Персональная роль');
        $personal_role->setAttribute('is_own', $user_id);
       
     
        
        if ($personal_role->save())
           // echo "dsfsdfdsfsdf";
            $role_id=$personal_role->getAttribute ('Role_ID');
        
        $personal_role_to_user=new UsersRoles();
        $personal_role_to_user->setAttribute('user_id', $user_id);
        $personal_role_to_user->setAttribute('role_id', $role_id);
        
             $personal_role_to_user->save();
           
            return $this->redirect(['update', 'id' => $model->id]);
        
    }

    }
    
    
    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionUpdate($id)
    {
         \app\models\Access::isAdmin();
         //var_dump($_SESSION['one_role']);
        // var_dump(Yii::$app->request->get()['one_role']);
         //var_dump(isset(Yii::$app->request->get()['one_role']));
         if ($_SESSION['user_create']==1){ //первое редактирование после создания
             $_SESSION['first_edit']=1;
             $_SESSION['user_create']=0;    
         }
        $model = $this->findModel($id);
        $user_id= $model->getAttribute('user_id');
       
         if (Yii::$app->request->post()['delete_avatar']==1){
           //echo "sdfsdfsdfsdfsdfsdf";
           $connection=Yii::$app->db; 
           $connection->createCommand("update users set imageFile='' where user_id='$user_id'")->query();
            return $this->redirect(['update', 'id' => $model->id]);
        }
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        
        $rolesArray1 = ArrayHelper::getColumn($roles, 'Role_ID');
        
        if (isset(Yii::$app->request->post()['one_role']) &&  (Yii::$app->request->post()['one_role']!='all') ){ //view right for one role
            unset($rolesArray1);
            $rolesArray1[]=Yii::$app->request->post()['one_role'];
        }
        if (!isset(Yii::$app->request->post()['one_role'])){
           $one_role='all';
        }
        else{
          $one_role = Yii::$app->request->post()['one_role'];
        }
       
        
        $rights = Access::find()->where(['Role_ID' => $rolesArray1])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();
        $personal_role_id=Roles::findOne(['is_own'=>$user_id])->Role_ID;
      $personal_role_name=Roles::findOne(['is_own'=>$user_id])->Name;
      
      
      
        
        
       
        
       
       
          $rolesThisUser = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
         
         
         // $roles = Roles::find()->where(['Role_ID' => $rolesArray])->all();
        $roles = Roles::find()->where(['Role_ID'=>$rolesThisUser, 'is_own'=> Null])->all();
        
      foreach ($roles as $key=>$value){
        $key=$value->getAttribute('Role_ID');
        $rolesArray[$key]=$value->getAttribute('Name');
      }
      
      
     
      
      $rolesArray[$personal_role_id]=$personal_role_name;
      $rolesArray['all']='Общий список прав по всем ролям';
      
        $model = $this->findModel($id);
        $user_id= $model->getAttribute('user_id');
        
        

        
       // $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
       // $roles_this_user = ArrayHelper::getColumn($roles, 'Role_ID');
       
          
         
        $h=$model->load(Yii::$app->request->post());
         
       
         
         if (Yii::$app->request->post()['generate_password']==1){
           
        $password_without_md5=\app\models\Access::generatePassword(8);
        $model->setAttribute('password', md5($password_without_md5));
        $array_of_emails=explode(";", $model->getAttribute('email'));
         $email=$array_of_emails[0];
         $login=$model->getAttribute('username');
         $fio=  $model->getAttribute('name');
         $message="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio!</p>
<p>Вы получили это письмо, потому что для вашего e-mail была запрошена смена пароля на веб-портале support.someproject.by.</p>

<p>Данные для доступа:</p>
<p>Логин: $login</p>
<p>Пароль: $password_without_md5</p>

<p>Чтобы авторизоваться на портале перейдите по ссылке:
http://support.someproject.by</p>

<p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

<p>С уважением,
Администрация сайта support.someproject.by</p></body></html>";
         mail($email, '=?UTF-8?B?'.base64_encode('Смена пароля на support.someproject.by').'?=', $message, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for user
         }
        
        
        $model->setAttribute('FD', date('Y-m-j H:i:s'));
        $model->setAttribute('TD', '0');
        $user_id = Yii::$app->user->getIdentity()->user_id;
        $surname=$model->getAttribute('surname');
         $login=$model->getAttribute('username');
        $realname=$model->getAttribute('realname');
        $second_name=$model->getAttribute('second_name');
        $name=$surname.' '.$realname.' '.$second_name;
        $model->setAttribute('name', $name);
        if ( $_SESSION['first_edit']==1) {
           // echo "аirst";
            $password_without_md5=\app\models\Access::generatePassword(8); //only for send in emal
        $model->setAttribute('password', md5($password_without_md5));
        }
        if ($h && $model->save()) {
           // echo 'save';
             if ($_SESSION['first_edit']==1){
           // echo 'create_user';
       $_SESSION['first_edit']=0;
             $array_of_emails=explode(";", $model->getAttribute('email'));
              $email=$array_of_emails[0];
              $login=$model->getAttribute('username');
              $fio=  $model->getAttribute('name');
              
              
          $message ="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio! </p>
<p>Вы получили это письмо, потому что для вашего e-mail была запрошена регистрация на портале support.someproject.by
Сообщаем вам, что процедура регистрации завершена успешно. </p>

<p>Данные для доступа:</p>
<p>Логин: $login</p>
<p>Пароль: $password_without_md5</p>
<p>
Чтобы авторизоваться на портале перейдите по ссылке:
http://support.someproject.by/</p>

<p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

<p>С уважением, 
Администрация сайта support.someproject.by</p></body></html>";
            mail($email, '=?UTF-8?B?'.base64_encode('Регистрация на support.someproject.by').'?=', $message, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for user
            
            $email_responsible=$model->getAttribute('email_responsible');
            if ($model->getAttribute('email_responsible')!=''){
                $fio_respobsible=$model->getAttribute('responsible');
                $message_responsible="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio_respobsible !
По вашей заявке успешно был зарегистрирован пользователь '$fio'. </p><p>Данные для авторизации были направлены на email '$email'. </p>

<p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

<p>С уважением, 
Администрация сайта support.someproject.by</p></body></html>";
                mail($email_responsible, '=?UTF-8?B?'.base64_encode('Регистрация на support.someproject.by').'?=', $message_responsible, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for responsible
            }
             }
            
             $role_id=$personal_role_id;
            $user_id= $model->getAttribute('user_id');
            $connection=Yii::$app->db; 
           //$connection->createCommand("delete from Access where role_id=$role_id")->query();
          
           if (!empty(Yii::$app->request->post()['access'])){
                $connection=Yii::$app->db; 
               $connection->createCommand("delete from Access where Role_id=$role_id")->query();
              
           foreach (Yii::$app->request->post()['access'] as $key=>$value){
            
            $connection=Yii::$app->db; 
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ($role_id, $key, $value)" )->query();
            
}
           }        
             
 $connection=Yii::$app->db; 
             $connection->createCommand("update roles set Name='$login' where is_own='$user_id'")->query();
}

if (isset($_SESSION['one_role'])){
           
            $one_role=$_SESSION['one_role'];
            
        }
        else{
          $connection=Yii::$app->db; 
         $connection->createCommand("delete from Access where Level_Rights=0")->query();
       //return $this->redirect(['update', 'id' => $model->id]);
        }

 if($personal_role_id==Yii::$app->request->post()['one_role'] || $personal_role_id==$_SESSION['one_role'] ){
           if (isset($_SESSION['one_role'])){
               unset($rolesArray1);
           $rolesArray1=$_SESSION['one_role'];
           $one_role=$_SESSION['one_role'];
           unset($_SESSION['one_role']);
           }
           else {
           unset($rolesArray1);
           $rolesArray1=$personal_role_id;
           $one_role=$personal_role_id;
            
           }
           
           
          $rights = Access::find()->where(['Role_ID' => $rolesArray1])->andWhere(['Level_Rights' => [0,1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();  
        }
        else if(Yii::$app->request->post()['one_role']=='all'){
           
          $rights = Access::find()->where(['Role_ID' => $rolesArray1])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();  
        }
        
        $project_tree = [];
       
        foreach ($rights as $item) {
          /* пропускаем ошибочные доступы, которым не соответствуют никакие реальные подсистемы */
          if (empty($item['module'])) continue;
          /* собираем древовидный массив вида [
            id_проекта => [
              name => имя_проекта,
              products => [
                id_продукта => [
                  name => имя_прдукта,
                  modules => [
                    id_подсистемы => [
                      name => имя_подсистемы,
                      right => максимальный_доступ
                    ]
                  ]
                ]
              ]
            ] */
          $project_active =$item['module']['product']['project']['Active'];
          $product_active = $item['module']['product']['Active'];
          $module_active = $item['module']['Active'];
          $project_id = $item['module']['product']['project']['Project_ID'];
          $product_id = $item['module']['product']['Product_ID'];
          $module_id = $item['module']['Module_ID'];
          $right = $item['Level_Rights'];
          if (!isset($project_tree[$project_id]) && ($project_active==1)) {
            $project_tree[$project_id] = ['name' => $item['module']['product']['project']['Name'], 'active' => $item['module']['product']['project']['Active'], 'products' => []];
          }
          if (!isset($project_tree[$project_id]['products'][$product_id]) && ($product_active==1)) {
            $project_tree[$project_id]['products'][$product_id] = ['name' => $item['module']['product']['Name'], 'active' => $item['module']['product']['Active'], 'modules' => []];
          }
          if (!isset($project_tree[$project_id]['products'][$product_id]['modules'][$module_id]) && ($module_active==1)) {
            $project_tree[$project_id]['products'][$product_id]['modules'][$module_id] = ['name' => $item['module']['Name'], 'active' => $item['module']['Active'], 'right' => $right];
          }
          elseif ($project_tree[$project_id]['products'][$product_id]['modules'][$module_id]['right'] < $right) {
            $project_tree[$project_id]['products'][$product_id]['modules'][$module_id]['right'] = $right;
          }
        }
            $connection=Yii::$app->db; 
           $connection->createCommand("update roles set name='$login' where is_own='$user_id'")->query(); // personalrolename same as login
           
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
           
            return $this->render('update', [
                'model' => $model,
                'rolesArray' => $rolesArray,
                'roles_this_user'=>$roles_this_user,
                'project_tree'=>$project_tree,
                'personal_role_id'=>$personal_role_id,
                'one_role'=>$one_role,
            ]);
        }  
    
     public function actionEditrights($id)
    {
         
         \app\models\Access::isAdmin();
         $a=  Access::show_tree_access1();
         $model1 = new Roles();

         $model = $this->findModel($id);
        
        $user_id= $model->getAttribute('user_id');
        if ($model1->load(Yii::$app->request->post()) && $model1->save()) {
         $role_id=  $model1->getAttribute('Role_ID');
           if (!empty(Yii::$app->request->post()['access'])){
              
           foreach (Yii::$app->request->post()['access'] as $key=>$value){
            $connection=Yii::$app->db; 
            
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ($role_id, $key, $value)" )->query();
            
}
 $connection=Yii::$app->db; 
         $connection->createCommand("insert into users_roles (user_id, role_id) values ($user_id, $role_id)" )->query();
           }
          return $this->redirect(['view', 'id' => $model->id]);
        }    
    
         
       
        
         $roles = Roles::find()->all();
       
      foreach ($roles as $key=>$value){
        $key=$value->getAttribute('Role_ID');
        $rolesArray[$key]=$value->getAttribute('Name');
      }
          
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $roles_this_user = ArrayHelper::getColumn($roles, 'Role_ID');
        
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $rolesArray1 = ArrayHelper::getColumn($roles, 'Role_ID');
        //$rights = Access::find()->leftJoin('module')->with('module.product')->with('module.product.project')->asArray()->all();
       $rights = Access::find()->where(['Role_ID' => $rolesArray1])->andWhere(['Level_Rights' => [0,1,2,3]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();
//echo "<pre>";
//var_dump($rights);
//echo "</pre>";
        $project_tree = [];

        foreach ($rights as $item) {
          /* пропускаем ошибочные доступы, которым не соответствуют никакие реальные подсистемы */
          if (empty($item['module'])) continue;
          /* собираем древовидный массив вида [
            id_проекта => [
              name => имя_проекта,
              products => [
                id_продукта => [
                  name => имя_прдукта,
                  modules => [
                    id_подсистемы => [
                      name => имя_подсистемы,
                      right => максимальный_доступ
                    ]
                  ]
                ]
              ]
            ] */
          $project_id = $item['module']['product']['project']['Project_ID'];
          $product_id = $item['module']['product']['Product_ID'];
          $module_id = $item['module']['Module_ID'];
          $right = $item['Level_Rights'];
          if (!isset($project_tree[$project_id])) {
            $project_tree[$project_id] = ['name' => $item['module']['product']['project']['Name'], 'products' => []];
          }
          if (!isset($project_tree[$project_id]['products'][$product_id])) {
            $project_tree[$project_id]['products'][$product_id] = ['name' => $item['module']['product']['Name'], 'modules' => []];
          }
          if (!isset($project_tree[$project_id]['products'][$product_id]['modules'][$module_id])) {
            $project_tree[$project_id]['products'][$product_id]['modules'][$module_id] = ['name' => $item['module']['Name'], 'right' => $right];
          }
          elseif ($project_tree[$project_id]['products'][$product_id]['modules'][$module_id]['right'] < $right) {
            $project_tree[$project_id]['products'][$product_id]['modules'][$module_id]['right'] = $right;
          }
        }
      
        return $this->render('editrights', 
        [
            'model' => $model,
            'model1' => $model1,
            'rolesArray' => $rolesArray,
            'roles_this_user' =>  $roles_this_user,
            'project_tree' => $project_tree,
            'a'=>$a,
        ]
                );
    }
    
    
    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         \app\models\Access::isAdmin();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
      public function actionPhotofile() {
      {
                
      $user_id=$_POST['ui'];
      $dir = Yii::$app->basePath.'\\web\\uploads\\photos\\'.$user_id;
      $files = UploadedFile::getInstancesByName('photoFile');
      @mkdir($dir, 0744);

      $filenames = [];

      // prevent duplicating names
      $already_saved = [];

      foreach($files as $file) {
        $filename = SiteController::sanitizeFilename($file->name);
        if (isset($already_saved[$filename])) {
          $filename = preg_replace('/^(.+?)(\..+)?$/', "$1 (" . ($already_saved[$filename]++) . ")$2", $filename);
        }
        else $already_saved[$filename] = 1;

        $uploaded = $file->saveAs( $dir . '\\' . $filename );
        $user= $this->findModel($user_id);
        
        $user->imageFile= $user_id . '/' . $filename ;
        $user->update();

      }

      return $this->redirect(['update', 'id' => $user_id]);
    }
    }
    
      public function actionSendpassword() {
      {
        
      
          
     if (!empty(Yii::$app->request->post()['mail'])){
        $gotValue=Yii::$app->request->post()['mail'];
        $pos = strpos($gotValue, '@');
        if ($pos===false){ // login got
            
            $usersforfind=[];
            $usergroup=  \app\models\Usergroup::find()->where(['Group_ID' =>0])->select(['User_ID'])->asArray()->all();
            $usersforfind=ArrayHelper::getColumn($usergroup, 'User_ID');
           
            $user=Users::findOne(['username'=>$gotValue, 'status'=>2, 'user_id'=>$usersforfind ]);  
         
                    if (!isset($user)){
                        $error_message='Указанного пользователя не существует';
                         return $this->render('sendpassword', 
                            [
                                'error_message'=>$error_message
                            ]
                );
                    }
                    $mail=$user->email;
                    $login=$user->username;
                    $fio=$user->name;
                    $new_password=\app\models\Access::generatePassword(8);
                    $user->password=md5($new_password);
                    $user->update();
                    $message="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio!</p>
                                <p>Вы получили это письмо, потому что для вашего e-mail была запрошена смена пароля на веб-портале support.someproject.by.</p>

                                <p>Данные для доступа:</p>
                                <p>Логин: $login</p>
                                <p>Пароль: $new_password</p>

                                <p>Чтобы авторизоваться на портале перейдите по ссылке:
                                http://support.someproject.by</p>

                                <p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

                                <p>С уважением,
                                Администрация сайта support.someproject.by</p></body></html>";

                      mail($mail, '=?UTF-8?B?'.base64_encode('Восстановление пароля на support.someproject.by').'?=', $message, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for user
        }
        else{ //mail got
            $usersforfind=[];
            $usergroup=  \app\models\Usergroup::find()->where(['Group_ID' =>0])->select(['User_ID'])->asArray()->all();
            $usersforfind=ArrayHelper::getColumn($usergroup, 'User_ID');
            $user=Users::findOne(['email'=>$gotValue, 'status'=>2, 'user_id'=>$usersforfind ]);  
            if (!isset($user)){
                        $error_message='Указанного почтового ящика не существует';
                         return $this->render('sendpassword', 
                            [
                                'error_message'=>$error_message
                            ]
                );
                    }
                    $mail=$gotValue;
                    $login=$user->username;
                    $fio=$user->name;
                    $new_password=\app\models\Access::generatePassword(8);
                    $user->password=md5($new_password);
                    $user->update();
                    $message="<html><head><style>blockquote { border-left: #ddd solid 2px; margin-left: .5em; padding-left: 2em; }</style></head><body> <p>Здравствуйте, $fio!</p>
                                <p>Вы получили это письмо, потому что для вашего e-mail была запрошена смена пароля на веб-портале support.someproject.by.</p>

                                <p>Данные для доступа:</p>
                                <p>Логин: $login</p>
                                <p>Пароль: $new_password</p>

                                <p>Чтобы авторизоваться на портале перейдите по ссылке:
                                http://support.someproject.by</p>

                                <p>Пожалуйста, не отвечайте на это письмо, оно было сгенерировано системой автоматически.</p>

                                <p>С уважением,
                                Администрация сайта support.someproject.by</p></body></html>";

                      mail($mail, '=?UTF-8?B?'.base64_encode('Восстановление пароля на support.someproject.by').'?=', $message, "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n"); //mail for user
        }
     }
      return $this->render('sendpassword', 
        [
            'error_message'=>$error_message
        ]
                );
    }
    
    }
   
}
