<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Projects;
use app\models\ProjectsQuery;
use app\models\Modules;
use app\models\Access;
use yii\helpers\ArrayHelper;
use app\models\UsersRoles;
use app\models\Users;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
         \app\models\Access::isAdmin();
        $searchModel = new ProductsQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
         \app\models\Access::isAdmin();
         $model=$this->findModel($id);
       $project_id=$model->Project_ID;
       $project= Projects::findOne($project_id);
       $project_name=$project->Name;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'project_name'=>$project_name,
        ]);
    }

      private function allModules($product_id = null) {
      $query = Modules::find();
      $modules = $query->where(['Product_ID' => $product_id])->all();
      return $modules;
    }
    
    
    private function availableUsers($modules, $access_levels, $filter = [], $onlyActive = false) {
      $roles = Access::find()->where(['Level_Rights' => $access_levels])->andWhere(['Module_ID' => $modules])->select(['Role_ID'])->asArray();
      $rolesArray = ArrayHelper::getColumn($roles->all(), 'Role_ID');
      $userRoles = UsersRoles::find()->where(['Role_ID' => $rolesArray])->select(['User_ID'])->asArray();
      $usersArray = ArrayHelper::getColumn($userRoles->all(), 'User_ID');
      $usersCriteria = ['user_id' => $usersArray, 'TD' => null];
      if ($onlyActive) $usersCriteria['status'] = 2;
      $users = Users::find()->where($usersCriteria)->andFilterWhere(['not in', 'user_id', $filter])->distinct()->orderBy('name')->all();
      return $users;
    }
    
    public function actionUsers($id)
    {
      
    
      $ar_modules=array();
      

    
    $modules=$this->allModules($id);
   
    
    foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
        $ar_modules[]=$module_id;
    }
   

$ar_users=array();

$users=$this->availableUsers($ar_modules, [1,2,3,4]);
foreach ($users as $keyu=>$valueu){
    $department_id=$valueu->getAttribute('department_id');
     $department= \app\models\Departments::findOne($department_id);
       $department_name=$department->Name;
       $company_id=$department->Company_ID;
       $company=  \app\models\Companies::findOne($company_id);
       $company_name=$company->Name;
    $user_id =$valueu->getAttribute('id');
    $user_name=$valueu->getAttribute('name');
$ar_users[$user_id]['name']=$user_name;
$ar_users[$user_id]['position']=$valueu->getAttribute('position');
$ar_users[$user_id]['company_name']=$company_name;
}

        return $this->render('users', [
            'model' => $this->findModel($id),
            'ar_users' => $ar_users,
        ]);
    }
    
    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         \app\models\Access::isAdmin();
        $model = new Products();
$a=  array();
  $h=  Projects::find()->all();
  foreach ($h as $key=>$value){
      $key=$value->getAttribute('Project_ID');
      $a[$key]=$value->getAttribute('Name');
  }
 $k=$h[0]->getAttribute('Name');
 $h1=$model->load(Yii::$app->request->post());
        $model->setAttribute('Active', '1');
        if (($h1) && $model->save()) {
             return $this->redirect(['projects/projectsproducts']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'a'=>$a,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         \app\models\Access::isAdmin();
        $model = $this->findModel($id);
         $modules=$this->allModules($id);
         
         
         $active_notactive=Yii::$app->request->post()['Products']['Active'];

         
         foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
        $ar_modules[]=$module_id;
    }
         
$tickets =  \app\models\Ticket::find()->where(['TD'=>null, 'Module_ID'=>$ar_modules, 'Status_ID'=>[1,2,3,4,9,10]])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ((count($tickets)==0)){
             $connection=Yii::$app->db; 
              if (!empty($ar_modules)){
        foreach ($ar_modules as $key=>$value){
            
            $connection->createCommand("update modules set Active=$active_notactive where Module_ID=$value" )->query();
        } 
        }
            }
            return $this->redirect(['projects/projectsproducts']);
        } elseif(!$model->load(Yii::$app->request->post()) && (count($tickets)==0)) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        elseif(!$model->load(Yii::$app->request->post()) && (count($tickets)>0)){
            return $this->render('update', [
                'model' => $model,
                'blocked'=>1,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeletem($id)
    {
         \app\models\Access::isAdmin();
         $modules=$this->allModules($id);
         foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
        $ar_modules[]=$module_id;
    }
   

$ar_users=array();


$tickets =  \app\models\Ticket::find()->where(['TD'=>null, 'Module_ID'=>[$ar_modules], 'Status_ID'=>[1,2,3,4,9,10]])->all();

        if(count($tickets)>0){
           return $this->render('deletem', [
            'model' => $this->findModel($id),
            'tickets' => $tickets,
        ]);
        }
        else{
            $connection=Yii::$app->db; 
       
            
           
          
        if (!empty($ar_modules)){
        foreach ($ar_modules as $key=>$value){
            
            $connection->createCommand("update modules set Active=0 where Module_ID=$value" )->query();
        } 
        }
         $connection->createCommand("update from products set Active=0 where Product_ID=$id" )->query();
        return $this->redirect(['projects/projectsproducts']);
        }
       
         
        

     
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
