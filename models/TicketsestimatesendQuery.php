<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ticketsestimatesend;

/**
 * TicketsestimatesendQuery represents the model behind the search form about `app\models\Ticketsestimatesend`.
 */
class TicketsestimatesendQuery extends Ticketsestimatesend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Ticket_ID'], 'integer'],
            [['esttime', 'last_send'], 'safe'],
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
        $query = Ticketsestimatesend::find();

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
            'id' => $this->id,
            'Ticket_ID' => $this->Ticket_ID,
            'esttime' => $this->esttime,
            'last_send' => $this->last_send,
        ]);

        return $dataProvider;
    }
}
