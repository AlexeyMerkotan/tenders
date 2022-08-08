<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tender;

/**
 * TenderSearch represents the model behind the search form of `app\models\Tender`.
 */
class TenderSearch extends Tender
{
    public $userName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tenderID', 'amount', 'dateModified'], 'integer'],
            [['description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Tender::find();

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
            'tenderID' => $this->tenderID,
            'amount' => $this->amount,
            'dateModified' => $this->dateModified,
        ]);


        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
