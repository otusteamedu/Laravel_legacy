<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Messages;

/**
 * MessagesQuery represents the model behind the search form about `app\models\Messages`.
 */
class MessagesQuery extends Messages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Message_ID', 'Ticket_ID', 'InReplyTo', 'User_ID'], 'integer'],
            [['DateTime', 'ProtocolItem', 'Text'], 'safe'],
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
        $query = Messages::find();

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
            'Message_ID' => $this->Message_ID,
            'Ticket_ID' => $this->Ticket_ID,
            'InReplyTo' => $this->InReplyTo,
            'DateTime' => $this->DateTime,
            'User_ID' => $this->User_ID,
        ]);

        $query->andFilterWhere(['like', 'Text', $this->Text]);

        return $dataProvider;
    }
}
