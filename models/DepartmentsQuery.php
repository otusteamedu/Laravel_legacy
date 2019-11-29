<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Departments;

/**
 * DepartmentsQuery represents the model behind the search form about `app\models\Departments`.
 */
class DepartmentsQuery extends Departments
{
    /**
     * @inheritdoc
     */
    
    public function attributes()
{
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['companies.Name']);
}
    public function rules()
    {
        return [
            [['Department_ID', 'IsSubdivisionOf', 'Company_ID'], 'integer'],
            [['Name', 'companies.Name'], 'safe'],
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
        $query = Departments::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        
        $dataProvider->sort->attributes['company.Name'] = [
      'asc' => ['companies.Name' => SORT_ASC],
      'desc' => ['companies.Name' => SORT_DESC],
       ];

       $query->joinWith(['company']); 
       

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
                        return $dataProvider;
        }

        $query->andFilterWhere([
            'Department_ID' => $this->Department_ID,
            'IsSubdivisionOf' => $this->IsSubdivisionOf,
            'Company_ID' => $this->Company_ID,
        ]);
       
        $query->andFilterWhere(['like', 'Name', $this->Name]);
        $query->andFilterWhere(['like','comapnies.Name',$this->getAttribute('companies.Name')]);
        return $dataProvider;
    }
}
