<?php

namespace app\controllers;

use Yii;
use app\models\Projects;
use app\models\Products;
use app\models\ProjectsQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Modules;
use app\models\Access;
use yii\helpers\ArrayHelper;
use app\models\UsersRoles;
use app\models\Users;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
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
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new ProjectsQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projects model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    private function allProducts($project_id = null) {
      $query = Products::find();
    

      $products = $query->where(['Project_ID' => $project_id])->all();

      return $products;
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
       $products=$this->allProducts($id);
    
      $ar_modules=array();
      
foreach ($products as $key=>$value){
   
    $product_id=$value->getAttribute('Product_ID');
    
    $modules=$this->allModules($product_id);
   
    
    foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
        $ar_modules[]=$module_id;
    }
   
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
    
    
     public function actionProjectsproducts()
    {
       \app\models\Access::isAdmin();
      
         $projects=Projects::find()->orderBy(['Active' => SORT_DESC, 'Name' => SORT_ASC])->all();
          foreach ($projects as $key=>$value){
            $key=$value->getAttribute('Project_ID');
            $projects_list[$key]['name']=$value->getAttribute('Name');
            $projects_list[$key]['active']=$value->getAttribute('Active');
          }
         
         $products=  Products::find()->orderBy(['Active' => SORT_DESC, 'Name' => SORT_ASC])->all();
          foreach ($products as $key=>$value){
            $key=$value->getAttribute('Product_ID');
            $products_list[$key]['name']=$value->getAttribute('Name');
            $products_list[$key]['project_id']=$value->getAttribute('Project_ID');
            $products_list[$key]['active']=$value->getAttribute('Active');
          }
          
           $modules= \app\models\Modules::find()->orderBy(['Active' => SORT_DESC, 'Name' => SORT_ASC])->all();
          foreach ($modules as $key=>$value){
            $key=$value->getAttribute('Module_ID');
            $modules_list[$key]['name']=$value->getAttribute('Name');
            $modules_list[$key]['product_id']=$value->getAttribute('Product_ID');
            $modules_list[$key]['active']=$value->getAttribute('Active');
          }
      
     
        // echo "<pre>";
        // var_dump( $companies_list);
        // echo "</pre>";
       //  echo "<pre>";
        // var_dump( $departments_list);
        // echo "</pre>";
        //  echo "<pre>";
        // var_dump( $users_list);
        // echo "</pre>";
          
         foreach ($projects_list as $project_id=>$value){
             $projects_tree[$project_id]=['name' =>$value['name'], 'active'=>$value['active'], 'products' => []];
             foreach ($products_list as $product_id=>$value1){
               
                 if ($project_id==$value1['project_id'])
                 {
                  $projects_tree[$project_id]['products'][$product_id]=['name'=>$value1['name'], 'active'=>$value1['active'], 'modules'=>[] ];
                    foreach ($modules_list as $module_id=>$value2){
                     
                      if($product_id==$value2['product_id']){
                          $projects_tree[$project_id]['products'][$product_id]['modules'][$module_id]=['name'=>$value2['name'], 'active'=>$value2['active'], 'product_id'=>$value2['product_id']];
                      }
                  }
                 }
                   
              
             }
             
         }

         $dataProvider=6;       
        return $this->render('projectsproducts', [
            'projects_tree'=>$projects_tree,
            
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
        $h=$model->load(Yii::$app->request->post());
        $model->setAttribute('Active', '1');
        if (($h) && $model->save()) {
           
             return $this->redirect(['projectsproducts', 'id' => $model->Project_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         $products=$this->allProducts($id);
    
      $ar_modules=array();
      $ar_products=array();
       
      $active_notactive=Yii::$app->request->post()['Projects']['Active'];
foreach ($products as $key=>$value){
   
    $product_id=$value->getAttribute('Product_ID');
    $ar_products[]=$product_id;
    $modules=$this->allModules($product_id);
   
    
    foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
        $ar_modules[]=$module_id;
    }
   
}
      $tickets =  \app\models\Ticket::find()->where(['TD'=>null, 'Module_ID'=>$ar_modules, 'Status_ID'=>[1,2,3,4,9,10]])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ((count($tickets)==0)){
             $connection=Yii::$app->db; 
              foreach ($ar_products as $key=>$value){
            
            $connection->createCommand("update  products set Active=$active_notactive  where Product_ID=$value" )->query();
        }   
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
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeletem($id)
    {
        
         $products=$this->allProducts($id);
    
      $ar_modules=array();
      $ar_products=array();
       
      
foreach ($products as $key=>$value){
   
    $product_id=$value->getAttribute('Product_ID');
    $ar_products[]=$product_id;
    $modules=$this->allModules($product_id);
   
    
    foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
        $ar_modules[]=$module_id;
    }
   
}
$ar_users=array();

$users=$this->availableUsers($ar_modules, [1,2,3,4]);
foreach ($users as $keyu=>$valueu){
    $user_id =$valueu->getAttribute('user_id');
    $user_name=$valueu->getAttribute('name');
$ar_users[$user_id]=$user_name;
}

        
        if(count($ar_users)!=0){
           return $this->render('deletem', [
            'model' => $this->findModel($id),
            'ar_users' => $ar_users,
        ]);
        }
        else{
            $connection=Yii::$app->db; 
        foreach ($ar_products as $key=>$value){
            
            $connection->createCommand("delete from products where Product_ID=$value" )->query();
        }   
        
        foreach ($ar_modules as $key=>$value){
            
            $connection->createCommand("delete from modules where Module_ID=$value" )->query();
        } 
         $connection->createCommand("delete from projects where Project_ID=$id" )->query();
         return $this->redirect(['projects/projectsproducts']);
        }
       
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionUpdatemodule()
    {
        $this->layout = 'ajaxlist';

        //var_dump($_POST);
        $data=Yii::$app->request->post()['value'];
        
        
        return $this->render('ajaxlist', [
            'data' => $data,
            'fieldid' => 'Product_ID',
            'parent_fieldid' => 'Project_ID',
            'fieldid_str' => 'product_id',
            'label' => 'Продукт'
        ]);
    }
}
