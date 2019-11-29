<?php

namespace app\controllers;

use Yii;
use app\models\Departments;
use app\models\DepartmentsQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Companies;
use app\models\CompaniesQuery;

/**
 * DepartmentsController implements the CRUD actions for Departments model.
 */
class DepartmentsController extends Controller
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
     * Lists all Departments models.
     * @return mixed
     */
    public function actionIndex()
    {
         \app\models\Access::isAdmin();
        $searchModel = new DepartmentsQuery();    
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
  
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departments model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
         \app\models\Access::isAdmin();
         $model=$this->findModel($id);
       $company_id=$model->Company_ID;
       $company= Companies::findOne($company_id);
       $company_name=$company->Name;
       if (!is_null($model->IsSubdivisionOf)){
       $sub_dep=  $this->findModel($model->IsSubdivisionOf);
       $name_sub_dep= $sub_dep->Name;
       }
       else 
       {
           $name_sub_dep="нет головного отдела";
       }
        return $this->render('view', [
            'name_sub_dep' =>$name_sub_dep,
            'company_name' =>  $company_name,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Departments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         \app\models\Access::isAdmin();
        $model = new Departments();
 $a=  array();
  $h=Companies::find()->all();
  foreach ($h as $key=>$value){
      $key=$value->getAttribute('Company_ID');
      $a[$key]=$value->getAttribute('Name');
  }
 $k=$h[0]->getAttribute('Name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Department_ID]);
        } else {
            return $this->render('create', [
                'model' => $model, 'a'=>$a
            ]);
        }
    }

    /**
     * Updates an existing Departments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         \app\models\Access::isAdmin();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Department_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Departments model.
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
     * Finds the Departments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Departments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Departments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
