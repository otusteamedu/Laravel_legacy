<?php

namespace app\controllers;

use Yii;
use app\models\Favorite;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FavoriteController implements the CRUD actions for Favorite model.
 */
class FavoriteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                ],
            ],
        ];
    }

 
    public function actionUpdate() {
      $this->layout = 'ajaxlist';
      $err = '';
      $result = 0;
      
      $model = new Favorite();
      
      if (!$model->load(Yii::$app->request->post())) $err = 'Bad data submitted';
      
      if (Yii::$app->request->post('add')) {
        $op = 'create';
        if ($model->save()) {
          $result = 1;
        }
        else {
          $err = 'Nothing created';
        }
      }
      else {
        $op = 'delete';
        if ($this->findModel($model->User_ID, $model->Ticket_ID)->delete()) {
          $result = 1;
        }
        else {
          $err = 'Nothing deleted';
        }
      }

      return $this->render('result', [
          'data' => '{"op":"'.$op.'","result":"'.$result.'","err":"'.$err.'"}',
      ]);

    }

    /**
     * Finds the Favorite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $User_ID
     * @param string $Ticket_ID
     * @return Favorite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($User_ID, $Ticket_ID)
    {
        if (($model = Favorite::findOne(['User_ID' => $User_ID, 'Ticket_ID' => $Ticket_ID])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
