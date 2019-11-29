<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersQuery represents the model behind the search form about `app\models\Users`.
 */
class UsersQuery extends Users
{
  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'department_id', 'role_id', 'status'], 'integer'],
            [['name', 'username', 'company', 'department', 'surname', 'role_id', 'password', 'email', 'phone', 'position', 'additionalData', 'FD', 'TD', 'imageFile', 'responsible', 'email_responsible'], 'safe'],
        ];
    }
   
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        //$query = Users::find()->join('LEFT JOIN', 'departments', 'users.department_id=departments.Department_ID')->join('LEFT JOIN', 'companies', 'departments.Company_ID = companies.Company_ID');
         $search_array=$params['UsersQuery'];
        if (isset($search_array)){
        $withand=0;//flag for start part of request with "and"
        $query = Users::find()->with('department')->with('department.company');
        if ($search_array['company']!=''){
        
            $request="users.company like ".'"%'.$search_array['company'].'%"';
            $withand=1;
        }
        if ($search_array['department']!=''){
         if ($withand==1){ $request.=" and "; }
            $request="users.department like ".'"%'.$search_array['department'].'%"';
            $withand=1;
        }
         if ($search_array['surname']!=''){
         if ($withand==1){ $request.=" and "; }
            $request="users.surname like ".'"%'.$search_array['surname'].'%"';
            $withand=1;
        }
        if ($search_array['status']!=''){
         if ($withand==1){ $request.=" and "; }
            $request="users.status = ".$search_array['status'];
            $withand=1;
        }
        if ($search_array['email']!=''){
            if ($withand==1){ $request.=" and "; }
            
        $request.="users.email like ".'"%'.$search_array['email'].'%"';
         $withand=1;
        }
        if ($search_array['name']!=''){
             if ($withand==1){ $request.=" and "; }
             $request.="users.name  like ".'"%'.$search_array['name'].'%"';
              $withand=1;
        }
        if ($search_array['username']!=''){
             if ($withand==1){ $request.=" and "; }
              $request.="users.username like ".'"%'.$search_array['username'].'%"';
               $withand=1;
        }
         if ($search_array['position']!=''){ 
             if ($withand==1){ $request.=" and "; }
              $request.="users.position like ".'"%'.$search_array['position'].'%"';
               $withand=1;
        
         }
         if ($search_array['phone']!=''){
             if ($withand==1){ $request.=" and "; }
         
              $request.="users.phone like ".'"%'.$search_array['phone'].'%"';
              
        }
        $query->where($request);
        }
        else
        {
            $query = Users::find()->with('department')->with('department.company');
        }
        
        //$query="SELECT users.name as name, users.email as email, users.phone as phone, users.position as position, users.`status` as status , users.username as username , departments.`Name` as department, companies.`Name` as company FROM users join departments on (users.department_id=departments.Department_ID) join companies on (departments.Company_ID=companies.Company_ID)";
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
      $dataProvider->sort->attributes['department.Name'] = [
      'asc' => ['departments.Name' => SORT_ASC],
      'desc' => ['departments.Name' => SORT_DESC],
       ];
       
      $dataProvider->sort->attributes['department.company.Name'] = [
      'asc' => ['companies.Name' => SORT_ASC],
      'desc' => ['companies.Name' => SORT_DESC],
       ];
      
      

       $query->joinWith(['department']); 
       $query->joinWith(['department.company']); 
      
       
        $models = $dataProvider->getModels();
        $this->load($params);

        if (!$this->validate()) {
           
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
       
        
        $query->where("status=".$search_array['status']);
       
        $query->andFilterWhere([
            'users.id' => $this->id,
            'users.user_id' => $this->user_id,
            'users.department_id' => $this->department_id,
            'users.role_id' => $this->role_id,
            'users.FD' => $this->FD,
            'users.TD' => $this->TD,
            'status' => $search_array['status'],
            'users.responsible' => $this->responsible,
            'users.email_responsible' => $this->email_responsible,
        ]);
       $query->andFilterWhere(['like','departments.Name',$this->getAttribute('departments.Name')]);
       $query->andFilterWhere(['like','companies.Name',$this->getAttribute('companies.Name')]);
        $query->andFilterWhere(['like', 'name', $search_array['name']])
            ->andFilterWhere(['like', 'username', $search_array['username']])
            ->andFilterWhere(['like', 'users.password', $this->password])
            ->andFilterWhere(['like', 'users.email', $this->email])
            ->andFilterWhere(['like', 'users.phone', $this->phone])
            ->andFilterWhere(['like', 'users.position', $this->position])
            ->andFilterWhere(['like', 'users.additionalData', $this->additionalData]);

        return $dataProvider;
    }
    
     public function search1($params)
    {
        $query = Users::find();
        
        $count = Yii::$app->db->createCommand('
    SELECT COUNT(*) FROM users ')->queryScalar();
       // echo $count;
        
        
     $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT users.id as id ,users.name as name, users.email as email, users.phone as phone, users.position as position, users.`status` as status , users.username as username , departments.`Name` as department, companies.`Name` as company FROM users join departments on (users.department_id=departments.Department_ID) join companies on (departments.Company_ID=companies.Company_ID)',
    'params' => [],
    'totalCount' => $count,
    'sort' => [
        'attributes' => [
            'id',
            'email',
            'username',
            'status',
            'name',
            'phone',
            'position',
            'company',
            'department',
        ],
    ],
    'pagination' => [
       
        'pageSize' => 20,
    ],
]);
 
// get the user records in the current page
//$models = $dataProvider->getModels();
    
        $this->load($params);
         

        if (!$this->validate()) {
            
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'department_id' => $this->department_id,
            'role_id' => $this->role_id,
            'FD' => $this->FD,
            'TD' => $this->TD,
            'status' => $this->status,
            'responsible' => $this->responsible,
            'email_responsible' => $this->email_responsible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
                 ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'additionalData', $this->additionalData]);
      
        return $dataProvider;
    }
}
