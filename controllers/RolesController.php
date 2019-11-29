<?php

namespace app\controllers;

use Yii;
use app\models\Roles;
use app\models\RolesQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Access;
use app\models\AccessQuery;
use app\models\Projects;
use app\models\Products;


/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RolesController extends Controller
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
     * Lists all Roles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolesQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Roles model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
     
        $a=Access::show_tree_access1(NULL, $id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'a'=>$a,
        ]);
    }

    /**
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate1()
    {
        $a=Access::show_tree_access1();
        $model = new Roles();
  
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
   $role_id=  $model->getAttribute('Role_ID');
  
           foreach (Yii::$app->request->post()['access'] as $key=>$value){
            $connection=Yii::$app->db; 
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ($role_id, $key, $value)" )->query();

}
            return $this->redirect(['view', 'id' => $model->Role_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'a'=>$a,
            ]);
        }
    }

   public function actionCreate(){
       \app\models\Access::isAdmin();
      $model = new Roles();
     
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
         
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
   $role_id=  $model->getAttribute('Role_ID');
  
           foreach (Yii::$app->request->post()['access'] as $key=>$value){
            $connection=Yii::$app->db; 
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ($role_id, $key, $value)" )->query();

}
            return $this->redirect(['update', 'id' => $model->Role_ID]);
        } else {
        
          return $this->render('create', [
                'projects_tree' => $projects_tree,
                'model'=>$model,
            ]);
        }
   } 
    /**
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $role_id=$model->Role_ID;
        
     // echo $role_id;
        
     
       
        $rights = Access::find()->where(['Role_ID' => $role_id])->andWhere(['Level_Rights' => [0,1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();
       // var_dump($rights);
         $project_tree = [];
       
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

        
        
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $role_id= $model->getAttribute('Role_ID');
    $connection=Yii::$app->db; 
           $connection->createCommand("delete from  Access where Role_ID=$role_id")->query();
             foreach (Yii::$app->request->post()['access'] as $key=>$value){
            $connection=Yii::$app->db; 
            $connection->createCommand("insert into Access (Role_id, Module_ID, Level_Rights) values ($role_id, $key, $value)" )->query();

}
            return $this->redirect(['update', 'id' => $model->Role_ID]);
        } else {
          
            return $this->render('update', [
                'model' => $model,
                'projects_tree'=>$project_tree,
            ]);
        }
    }

    /**
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)           
    {
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
       public function actionDeletem($id)
    {
         \app\models\Access::isAdmin();
         $role_id=$id;
        
         $userroles = \app\models\UsersRoles::find()->where(['user_id'=>$user_id])->all();






      if(count($userroles)>0){
          
           return $this->render('deletem', [
            'model' => $this->findModel($id),
           
        ]);
        }
        else{
            //$connection=Yii::$app->db; 
            //$connection->createCommand("update modules set Active=0 where Module_ID=$id" )->query();
          
            //$this->findModel($id)->delete();
          return $this->redirect(['roles/index']);
          
        
        
        }
        
    }
    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Roles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
