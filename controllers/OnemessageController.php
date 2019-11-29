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
use app\models\Companies;
use app\models\Departments;
use app\models\AccessQuery;
use app\models\UsersRoles;
use yii\web\UploadedFile;
use app\controllers\SiteController;


class OnemessageController extends Controller{
    
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
     public function actionIndex()
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
          }
          $users=  Users::find()->where(['status'=>2])->all();
          foreach ($users as $key=>$value){
            $key=$value->getAttribute('user_id');
            $users_list[$key]['department_id']=$value->getAttribute('department_id');
            $users_list[$key]['name']=$value->getAttribute('name');
            $users_list[$key]['email']=$value->getAttribute('email');
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
          
         foreach ($companies_list as $company_id=>$value){
             $companies_tree[$company_id]=['name' =>$value, 'departments' => []];
             foreach ($departments_list as $department_id=>$value1){
               
                 if ($company_id==$value1['company_id'])
                 {
                  $companies_tree[$company_id]['departments'][$department_id]=['name'=>$value1['name'], 'users'=>[]];
                  foreach ($users_list as $user_id=>$value2){
                     
                      if($department_id==$value2['department_id']){
                          $companies_tree[$company_id]['departments'][$department_id]['users'][$user_id]=['name'=>$value2['name'], 'email'=>$value2['email'], 'department_id'=>$value2['department_id']];
                      }
                  }
                 }
                   
              
             }
             
         }

         $dataProvider=6;
          return $this->render('index', [
              'companies_tree'=>$companies_tree,
            'dataProvider' => $dataProvider,
        ]);
     }
    
}