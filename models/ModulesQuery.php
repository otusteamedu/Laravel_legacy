<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Modules;

/**
 * ModulesQuery represents the model behind the search form about `app\models\Modules`.
 */
class ModulesQuery extends Modules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Module_ID', 'Product_ID'], 'integer'],
            [['Name', 'product'], 'safe'],
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
        $query = Modules::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        
        $dataProvider->sort->attributes['product.Name'] = [
      'asc' => ['products.Name' => SORT_ASC],
      'desc' => ['products.Name' => SORT_DESC],
       ];
        
        $query->joinWith(['product']); 
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Module_ID' => $this->Module_ID,
            'modules.Product_ID' => $this->Product_ID,
        ]);

        $query->andFilterWhere(['like', 'modules.Name', $this->Name]);
         $query->andFilterWhere(['like', 'products.Name', $this->product]);
        return $dataProvider;
    }
}
