<?php

namespace pantera\crm\contacts\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pantera\crm\contacts\models\Contact;
use yii\helpers\ArrayHelper;

/**
 * ContactSearch represents the model behind the search form about `pantera\crm\contacts\models\Contact`.
 */
class ContactSearch extends Contact
{
    public $tags = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['id'], 'integer'],

            [['tags'],'each', 'rule' => ['integer']],
            [['first_name', 'last_name', 'middle_name', 'phone', 'email', 'birth_date', 'created_at', 'comment', 'gender'], 'safe'],
        ];
        return $rules;
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
        $query = Contact::find();

        $query->orderBy('id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ]
        ]);

        $this->load($params);
        $applyCustomParams = false;
        if(!empty($this->tags)) {
            //Найдем всех клиентов по параметрам
            $registryQuery = ParamRegistry::find()->select('contact_id');
            $applyCustomParams = true;
            foreach ($this->tags as $tag) {
                $registryQuery->andWhere(['param_id' => $tag]);
            }
//            $registryQuery->andFilterWhere(['AND','param_id', $this->tags]);
            $clientIds = $registryQuery->column();
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'birth_date' => $this->birth_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
              ->andFilterWhere(['like', 'last_name', $this->last_name])
              ->andFilterWhere(['like', 'middle_name', $this->middle_name])
              ->andFilterWhere(['like', 'phone', $this->phone])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'comment', $this->comment])
              ->andFilterWhere(['like', 'gender', $this->gender]);
        if($applyCustomParams) {
            $query->andWhere(['id' => $clientIds]);
        }


        return $dataProvider;
    }
}
