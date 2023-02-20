<?php

namespace app\controllers;

use Yii;
use app\models\Companies;
use app\models\CompaniesQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Departments;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
     * Lists all Companies models.
     * @return mixed
     */
    
     public function actionCompaniesdepartments()
    {
           \app\models\Access::isAdmin();
         $companies=Companies::find()->all();
          foreach ($companies as $key=>$value){
            $key=$value->getAttribute('Company_ID');
            $companies_list[$key]=$value->getAttribute('Name');
          }
         
         $departments=  Departments::find()->all();
          foreach ($departments as $key=>$value){
            $key=$value->getAttribute('Department_ID');
            $departments_list[$key]['name']=$value->getAttribute('Name');
            $departments_list[$key]['company_id']=$value->getAttribute('Company_ID');
            $departments_list[$key]['issubdivisionof']=$value->getAttribute('IsSubdivisionOf');
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
          
        /* foreach ($companies_list as $company_id=>$value){
             $companies_tree[$company_id]=['name' =>$value, 'departments' => []];
             foreach ($departments_list as $department_id=>$value1){
               
                 if ($company_id==$value1['company_id'])
                 {
                  $companies_tree[$company_id]['departments'][$department_id]=['name'=>$value1['name']];
              
                 }
                   
              
             }
             
         }
         */
         
          foreach ($companies_list as $company_id=>$value){
             $companies_tree[$company_id]=['name' =>$value, 'departments'=>[]];
             foreach ($departments_list as $department_id=>$value1){
              
                 if (($company_id==$value1['company_id']) && (is_null($value1['issubdivisionof'])))
                 {
                     
                   
                  $companies_tree[$company_id]['departments'][$department_id]=['name'=>$value1['name'], 'departments_level' => []];
              
                 }
                 elseif(($company_id==$value1['company_id'])) {
                    
                     $companies_tree[$company_id]['departments'][$value1['issubdivisionof']]['departments_level'][$department_id]=['name'=>$value1['name']];
                 }
                   
              
             }
             
         }
       
   
         $dataProvider=6;
         
        return $this->render('companiesdepartments', [
            'companies_tree'=>$companies_tree,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndex()
    {
         \app\models\Access::isAdmin();
        $searchModel = new CompaniesQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
         \app\models\Access::isAdmin();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionViewcomdep($id)
    {
         \app\models\Access::isAdmin();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         \app\models\Access::isAdmin();
        $model = new Companies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Company_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    
    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         \app\models\Access::isAdmin();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Company_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         \app\models\Access::isAdmin();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
