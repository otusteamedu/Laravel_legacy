<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Companies;

/**
 * CompaniesQuery represents the model behind the search form about `app\models\Companies`.
 */
class CompaniesQuery extends Companies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Company_ID'], 'integer'],
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
        $query = Companies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Company_ID' => $this->Company_ID,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name]);

        return $dataProvider;
    }
}
