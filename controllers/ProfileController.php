<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Access;
use app\models\AccessQuery;
use app\models\UsersRoles;
use yii\web\UploadedFile;
use app\controllers\SiteController;

/**
 * ProfileController implements the CRUD actions for Users model.
 */
class ProfileController extends Controller
{
    
    private function currentUser() {
      $identity = Yii::$app->user->getIdentity();
      if (!$identity)
        return $this->redirect(['site/login']);
      return $identity;
    }
    
    
    
    
     private function checkRights($module_id, $user_id) {
      $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
      $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
      $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Module_ID' => $module_id])->select(['Level_Rights'])->asArray()->all();
      return ArrayHelper::getColumn($rights,'Level_Rights');
    }

    private function listModulesByAccessLevel()
    {
      $identity = $this->currentUser();

      $roles = UsersRoles::find()->where(['user_id' => $identity->user_id])->select(['Role_ID'])->asArray()->all();
      $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
      $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->asArray()->all();

      $access = [
        'view' => [],
        'create' => [],
        'edit' => [],
      ];
      foreach ($rights as $right) {
        if ($right['Level_Rights'] == 3 || $right['Level_Rights'] == 4) $access['edit'][] = $right['Module_ID'];
        if ($right['Level_Rights'] == 2 || $right['Level_Rights'] == 4) $access['create'][] = $right['Module_ID'];
        if ($right['Level_Rights'] > 0)                                 $access['view'][] = $right['Module_ID'];
      }

      return $access;
    }

    private function availableModules($avail_list, $product_id = null) {
      $query = Modules::find();
      $condition = ['Product_ID' => $product_id];
      $modules = $query->where(['Module_ID' => $avail_list])->andFilterWhere($condition)->all();
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        if(!empty(Yii::$app->request->post()['new_password'])){
          $new_password=Yii::$app->request->post()['new_password'];
           $user=Users::findOne(['id'=>$id]); 
           
                    $user->password=md5($new_password);
                    $user->update();
      }
        
        
       $identity = $this->currentUser();
       
       $department_id=$this->findModel($id)->department_id;
       $department= \app\models\Departments::findOne($department_id);
       $department_name=$department->Name;
       $company_id=$department->Company_ID;
       $company=  \app\models\Companies::findOne($company_id);
       $company_name=$company->Name;
       $model=$this->findModel($id);
      // $model->setAttribute("department_id", $department);
         $user_id= $this->findModel($id)->user_id;
if($identity->user_id!=$user_id){
            throw new NotFoundHttpException('The requested page does not exist.');
            
       }
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
        $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();

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
        
          //$a=Access::show_tree_access1($user_id, NULL);
        return $this->render('view', [
            'model' => $model,
            'project_tree' => $project_tree,
            'department_name'=>$department_name,
            'company_name'=>$company_name,
        ]);
    }
    
     public function actionAlien($id)
    {
      
        
       $model=$this->findModel($id);
      // $model->setAttribute("department_id", $department);
         $user_id= $this->findModel($id)->user_id;
         
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
        $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();

        $project_tree = [];
        $own_modules=array();
        $alien_modules=array();
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
          
          array_push($own_modules, $module_id);
         // echo $module_id;
          
        }
       
         
         
         
        // var_dump($project_tree);
         
         $identity = $this->currentUser();
         
         $user_id=$identity->user_id;
         
        $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
        $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
        $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->with('module')->with('module.product')->with('module.product.project')->asArray()->all();

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
          array_push($alien_modules, $module_id);
           
         //echo $module_id;
         
        }
       
       if (count(array_uintersect($own_modules, $alien_modules, "strcasecmp"))==0){
           throw new \yii\web\ForbiddenHttpException('У вас нет доступа к данной странице');

       }
       $department_id=$this->findModel($id)->department_id;
       $department= \app\models\Departments::findOne($department_id);
       $department_name=$department->Name;
       $company_id=$department->Company_ID;
       $company=  \app\models\Companies::findOne($company_id);
       $company_name=$company->Name;
       $model=$this->findModel($id);
           $user_id= $this->findModel($id)->user_id;

        return $this->render('alien', [
            'model' => $model,
            'department_name'=>$department_name,
            'company_name'=>$company_name,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
     public function actionChangepassword()
    {
         
         
         if(!empty(Yii::$app->request->post()['new_password'])){
          $new_password=Yii::$app->request->post()['new_password'];
         
          return $this->render('view', 
                            [
                                'error_message'=>$error_message
                            ]);
      }
        return $this->render('changepassword', [
           
        ]); 
    }

    /**
     * Updates an existing Users model.
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
     * Deletes an existing Users model.
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

      return $this->redirect(['view', 'id' => $user_id]);
    }
    }
}
