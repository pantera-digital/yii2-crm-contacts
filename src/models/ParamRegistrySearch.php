<?php

namespace pantera\crm\contacts\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ParamRegistrySearch represents the model behind the search form of `ParamRegistry`.
 */
class ParamRegistrySearch extends ParamRegistry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'param_id', 'user_id'], 'integer'],
            [['value'], 'safe'],
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
        $query = ParamRegistry::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'client_id' => $this->client_id,
            'param_id' => $this->param_id,
            'value' => $this->value,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'value_varchar', $this->value_varchar])
            ->andFilterWhere(['like', 'value_binary', $this->value_binary])
            ->andFilterWhere(['like', 'value_text', $this->value_text]);

        return $dataProvider;
    }
}
