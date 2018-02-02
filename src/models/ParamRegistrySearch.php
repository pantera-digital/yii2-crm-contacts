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
            [['id', 'client_id', 'param_id', 'value_int', 'user_id'], 'integer'],
            [['value_varchar', 'value_date', 'value_binary', 'value_text', 'created_at', 'updated_at'], 'safe'],
            [['value_decimal'], 'number'],
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
            'value_int' => $this->value_int,
            'value_decimal' => $this->value_decimal,
            'value_date' => $this->value_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'value_varchar', $this->value_varchar])
            ->andFilterWhere(['like', 'value_binary', $this->value_binary])
            ->andFilterWhere(['like', 'value_text', $this->value_text]);

        return $dataProvider;
    }
}
