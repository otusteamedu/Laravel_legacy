<?php

namespace app\controllers;

use Yii;
use app\models\Access;
use app\models\AccessQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Modules;
use app\models\ModulesQuery;
use app\models\Roles;
use app\models\RolesQuery;

    

/**
 * AccessController implements the CRUD actions for Access model.
 */
class AccessController extends Controller
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
     * Lists all Access models.
     * @return mixed
     */
    
   
    
    public function actionIndex()
    {
       $a=Access::show_tree_access1();
        $searchModel = new AccessQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'a'=>$a,
        ]);
    }

    /**
     * Displays a single Access model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
$a=Access::show_tree_access1();
 
        return $this->render('view', [
            'model' => $this->findModel($id),
            'a'=>$a,
           
        ]);
    }

    /**
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Access();
        $a=  array();
  $h= Modules::find()->all();
  foreach ($h as $key=>$value){
      $key=$value->getAttribute('Module_ID');
      $a[$key]=$value->getAttribute('Name');
  }
 $k=$h[0]->getAttribute('Name');
  $a1=  array();
 $h1= Roles::find()->all();
  foreach ($h1 as $key1=>$value1){
      $key1=$value1->getAttribute('Role_ID');
      $a1[$key1]=$value1->getAttribute('Name');
  }
 $k1=$h1[0]->getAttribute('Name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 
                 'a' => $a,
                'a1'=>$a1
                ]);
        }
    } 

    /**
     * Updates an existing Access model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Access model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Access model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Access the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Access::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
