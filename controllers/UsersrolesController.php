<?php

namespace app\controllers;

use Yii;
use app\models\UsersRoles;
use app\models\UsersRolesQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Roles;
use app\models\Users;
use app\models\Projects;
use app\models\Products;
use app\models\Modules;

/**
 * UsersRolesController implements the CRUD actions for UsersRoles model.
 */
class UsersrolesController extends Controller
{
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
     * Lists all UsersRoles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersRolesQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersRoles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UsersRoles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersRoles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
      public function actionRemove($id)
    {
        
        $user=Users::find()->where(['user_id'=>$id])->all();
        foreach ($user as $key=>$value){
        $idForRedirect=$value->getAttribute('id');
        }
       
        $model = new UsersRoles();
        $rolesThisUser = UsersRoles::find()->where(['user_id' => $id])->select(['Role_ID'])->asArray()->all();
        //$allRoles=Roles::find()->select(['Role_ID'])->asArray()->all();
        //$rolesThisUserColumn=ArrayHelper::getColumn($rolesThisUser, 'Role_ID');
       // $allRolesColumn=ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesArray = ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesNotThisUser = array_diff($allRolesColumn, $rolesThisUserColumn);
         $roles = Roles::find()->where(['Role_ID'=>$rolesThisUser, 'is_own'=> Null])->all();
      foreach ($roles as $key=>$value){
        $key=$value->getAttribute('Role_ID');
        $rolesArray[$key]=$value->getAttribute('Name');
      }
    
        if (isset(Yii::$app->request->post()['roles']) && $model->save()) {
           
             if (isset(Yii::$app->request->post()['roles'])){
             foreach (Yii::$app->request->post()['roles'] as $key=>$value){
            $connection=Yii::$app->db; 
            $connection->createCommand("delete from users_roles where (user_id='$id' and role_id='$key')" )->query();
             }
           }
            return $this->redirect(['users/update', 'id' => $idForRedirect]);
        } else {
            return $this->render('remove', [
                'model' => $model,
                'rolesArray' => $rolesArray,
            ]);
        }
    }
    
    
    
     public function actionAdd($id)
    {
        
        $user=Users::find()->where(['user_id'=>$id])->all();
        foreach ($user as $key=>$value){
        $idForRedirect=$value->getAttribute('id');
        }
       
        $model = new UsersRoles();
        $rolesThisUser = UsersRoles::find()->where(['user_id' => $id])->select(['Role_ID'])->asArray()->all();
        $allRoles=Roles::find()->select(['Role_ID'])->asArray()->all();
        $rolesThisUserColumn=ArrayHelper::getColumn($rolesThisUser, 'Role_ID');
        $allRolesColumn=ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesArray = ArrayHelper::getColumn($allRoles, 'Role_ID');
        $rolesNotThisUser = array_diff($allRolesColumn, $rolesThisUserColumn);
         $roles = Roles::find()->where(['Role_ID'=>$rolesNotThisUser, 'is_own'=> Null])->all();
      foreach ($roles as $key=>$value){
        $key=$value->getAttribute('Role_ID');
        $rolesArray[$key]=$value->getAttribute('Name');
      }
    
        if (isset(Yii::$app->request->post()['roles']) && $model->save()) {
           
             if (isset(Yii::$app->request->post()['roles'])){
             foreach (Yii::$app->request->post()['roles'] as $key=>$value){
            $connection=Yii::$app->db; 
            $connection->createCommand("insert into users_roles (user_id, role_id) values ('$id', '$key')" )->query();
             }
           }
            return $this->redirect(['users/update', 'id' => $idForRedirect]);
        } else {
            return $this->render('add', [
                'model' => $model,
                'rolesArray' => $rolesArray,
            ]);
        }
    }
    
    
    
    
      public function actionAddproject($id)
    {
         
          $ar_added_projects=[];
          if (isset(Yii::$app->request->post()['projects'])){
          foreach (Yii::$app->request->post()['projects'] as $key=>$value){
                $ar_added_projects[]=$key;               
          }
          }
          
          
        $user=Users::find()->where(['user_id'=>$id])->all();
        foreach ($user as $key=>$value){
        $idForRedirect=$value->getAttribute('id');
        }
         $projects = Projects::find()->where(['Active'=>1])->all();
      foreach ($projects as $key=>$value){
        $key=$value->getAttribute('Project_ID');
        $projectsArray[$key]=$value->getAttribute('Name');
      }
      $personal_role_id=Roles::findOne(['is_own'=>$id])->Role_ID;
     $projects = Projects::find()->where(['Project_ID'=>$ar_added_projects])->all();
    
       $ar_modules=array();
      foreach ($projects as $keypj=>$valuepj){
          
          $project_id=$valuepj->getAttribute('Project_ID');
         
      $products=$this->allProducts($project_id);
      
     
      
foreach ($products as $key=>$value){
   
    $product_id=$value->getAttribute('Product_ID');
    
    $modules=$this->allModules($product_id);
   
   
    foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
      
        $ar_modules[]=$module_id;
       
    }
   
}
      }
      
   
      
      
     
        
        $model = new UsersRoles();
        
        //$allRoles=Roles::find()->select(['Role_ID'])->asArray()->all();
        //$rolesThisUserColumn=ArrayHelper::getColumn($rolesThisUser, 'Role_ID');
       // $allRolesColumn=ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesArray = ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesNotThisUser = array_diff($allRolesColumn, $rolesThisUserColumn);
        
     
    
        if (isset(Yii::$app->request->post()['projects'])) {
            session_start();
            $_SESSION['add_project']=1;
            $_SESSION['one_role']=$personal_role_id;
           
            $connection=Yii::$app->db; 
            foreach ($ar_modules as $key=>$value){
              
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ('$personal_role_id', '$value', '0')" )->query();
            }
            
            return $this->redirect(['users/update/', 'id' => $idForRedirect]);
        } else {
            return $this->render('addproject', [
                'model' => $model,
                'projectsArray' => $projectsArray,
                'personal_role_id;'=>$personal_role_id,
            ]);
        }
    }
    
    
     public function actionAddprojecttorole($id)
    {
         
          $ar_added_projects=[];
          if (isset(Yii::$app->request->post()['projects'])){
          foreach (Yii::$app->request->post()['projects'] as $key=>$value){
                $ar_added_projects[]=$key;               
          }
          }
          
          
       
        $idForRedirect=$id;
        
         $projects = Projects::find()->where(['Active'=>1])->all();
      foreach ($projects as $key=>$value){
        $key=$value->getAttribute('Project_ID');
        $projectsArray[$key]=$value->getAttribute('Name');
      }
     
     $projects = Projects::find()->where(['Project_ID'=>$ar_added_projects])->all();
    
       $ar_modules=array();
      foreach ($projects as $keypj=>$valuepj){
          
          $project_id=$valuepj->getAttribute('Project_ID');
         
      $products=$this->allProducts($project_id);
      
     
      
foreach ($products as $key=>$value){
   
    $product_id=$value->getAttribute('Product_ID');
    
    $modules=$this->allModules($product_id);
   
   
    foreach ($modules as $keym=>$valuem){
       
        $module_id=$valuem->getAttribute('Module_ID');
      
        $ar_modules[]=$module_id;
       
    }
   
}
      }
      
   
      
      
     
        
        $model = new UsersRoles();
        
        //$allRoles=Roles::find()->select(['Role_ID'])->asArray()->all();
        //$rolesThisUserColumn=ArrayHelper::getColumn($rolesThisUser, 'Role_ID');
       // $allRolesColumn=ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesArray = ArrayHelper::getColumn($allRoles, 'Role_ID');
       // $rolesNotThisUser = array_diff($allRolesColumn, $rolesThisUserColumn);
        
     
    
        if (isset(Yii::$app->request->post()['projects'])) {
            session_start();
            $_SESSION['add_project']=1;
            
           
            $connection=Yii::$app->db; 
            foreach ($ar_modules as $key=>$value){
              
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ('$id', '$value', '0')" )->query();
            }
            
            return $this->redirect(['roles/update/', 'id' => $idForRedirect]);
        } else {
            return $this->render('addproject', [
                'model' => $model,
                'projectsArray' => $projectsArray,
                'personal_role_id;'=>$personal_role_id,
            ]);
        }
    }
    
    /**
     * Updates an existing UsersRoles model.
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
     * Deletes an existing UsersRoles model.
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
     * Finds the UsersRoles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersRoles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersRoles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
