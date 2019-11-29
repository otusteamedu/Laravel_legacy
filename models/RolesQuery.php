<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Roles;

/**
 * RolesQuery represents the model behind the search form about `app\models\Roles`.
 */
class RolesQuery extends Roles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Role_ID'], 'integer'],
            [['Name'], 'safe'],
            [['Description'], 'safe'],
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
        $query = Roles::find();

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
            'Role_ID' => $this->Role_ID,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name]);
        $query->andFilterWhere(['like', 'Description', $this->Description]);
        return $dataProvider;
    }
}
