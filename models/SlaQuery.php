<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sla;

/**
 * SlaQuery represents the model behind the search form about `app\models\sla`.
 */
class SlaQuery extends sla
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'product_id', 'module_id', 'priority_id', 'status_id', 'active', 'type_id'], 'integer'],
            [['sla', 'interval'], 'number'],
            [['last_send', 'message'], 'safe'],
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
        $query = sla::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
      
         $dataProvider->sort->attributes['project.Name'] = [
      'asc' => ['projects.Name' => SORT_ASC],
      'desc' => ['projects.Name' => SORT_DESC],
       ];
        $dataProvider->sort->attributes['product.Name'] = [
      'asc' => ['products.Name' => SORT_ASC],
      'desc' => ['products.Name' => SORT_DESC],
       ];
         $dataProvider->sort->attributes['module.Name'] = [
      'asc' => ['modules.Name' => SORT_ASC],
      'desc' => ['modules.Name' => SORT_DESC],
       ];
          $dataProvider->sort->attributes['type.Name'] = [
      'asc' => ['types.Name' => SORT_ASC],
      'desc' => ['types.Name' => SORT_DESC],
       ];
           $dataProvider->sort->attributes['priority.Name'] = [
      'asc' => ['priorities.Name' => SORT_ASC],
      'desc' => ['priorities.Name' => SORT_DESC],
       ];
            $dataProvider->sort->attributes['status.Name'] = [
      'asc' => ['statuses.Name' => SORT_ASC],
      'desc' => ['statuses.Name' => SORT_DESC],
       ];
        $query->joinWith(['project']);
        $query->joinWith(['product']);
        $query->joinWith(['module']);
        $query->joinWith(['type']);
        $query->joinWith(['priority']);
        $query->joinWith(['status']);
        $models = $dataProvider->getModels();
        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'product_id' => $this->product_id,
            'module_id' => $this->module_id,
            'priority_id' => $this->priority_id,
            'status_id' => $this->status_id,
            'sla' => $this->sla,
            'interval' => $this->interval,
            'last_send' => $this->last_send,
            'active' => $this->active,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        foreach ($dataProvider->models as $key=>$value){
            if($value->active==0){
                $value->active='Неактивен';
            }
            if($value->active==1){
            $value->active='Активен';
            }
        }
        return $dataProvider;
    }
}
