<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsQuery represents the model behind the search form about `app\models\Products`.
 */
class ProductsQuery extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Product_ID', 'Project_ID'], 'integer'],
            [['Name'], 'safe'],
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
        $query = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
         
        $dataProvider->sort->attributes['project.Name'] = [
      'asc' => ['projects.Name' => SORT_ASC],
      'desc' => ['projects.Name' => SORT_DESC],
       ];
        
        $query->joinWith(['project']);  
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Product_ID' => $this->Product_ID,
            'products.Project_ID' => $this->Project_ID,
        ]);

        $query->andFilterWhere(['like', 'products.Name', $this->Name]);
        $query->andFilterWhere(['like', 'projects.Name', $this->project]);
        return $dataProvider;
    }
}
