<?php

namespace app\controllers;

use Yii;
use app\models\Modules;
use app\models\ModulesQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Products;
use app\models\ProductsQuery;
use app\models\Access;
use yii\helpers\ArrayHelper;
use app\models\UsersRoles;
use app\models\Users;

/**
 * ModulesController implements the CRUD actions for Modules model.
 */
class ModulesController extends Controller
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
     * Lists all Modules models.
     * @return mixed
     */
    public function actionIndex()
    {
         \app\models\Access::isAdmin();
        $searchModel = new ModulesQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Modules model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
         \app\models\Access::isAdmin();
         
         $model=$this->findModel($id);
       $product_id=$model->Product_ID;
       $product= Products::findOne($product_id);
       $product_name=$product->Name;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'product_name' =>$product_name,
        ]);
    }

    /**
     * Creates a new Modules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         \app\models\Access::isAdmin();
        $model = new Modules();
        
        
$a=  array();
  $h=  Products::find()->all();
  foreach ($h as $key=>$value){
      $key=$value->getAttribute('Product_ID');
      $a[$key]=$value->getAttribute('Name');
  }

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
  
  
       
        $module_id=$id;
        
   

$ar_users=array();

$users=$this->availableUsers([$module_id], [1,2,3,4]);
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
     * Updates an existing Modules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         \app\models\Access::isAdmin();
         
        $model = $this->findModel($id);
$tickets =  \app\models\Ticket::find()->where(['TD'=>null, 'Module_ID'=>$id, 'Status_ID'=>[1,2,3,4,9,10]])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            
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
     * Deletes an existing Modules model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeletem($id)
    {
         \app\models\Access::isAdmin();
         $module_id=$id;
        
$tickets =  \app\models\Ticket::find()->where(['TD'=>null, 'Module_ID'=>$id, 'Status_ID'=>[1,2,3,4,9,10]])->all();






      if(count($tickets)>0){
          
           return $this->render('deletem', [
            'model' => $this->findModel($id),
            'tickets' => $tickets,
        ]);
        }
        else{
            $connection=Yii::$app->db; 
            $connection->createCommand("update modules set Active=0 where Module_ID=$id" )->query();
          
            //$this->findModel($id)->delete();
          return $this->redirect(['projects/projectsproducts']);
          
        
        
        }
        
    }

    /**
     * Finds the Modules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Modules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Modules::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
