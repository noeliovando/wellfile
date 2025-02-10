<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Campo;

/**
 * CampoSearch represents the model behind the search form of `app\models\Campo`.
 */
class CampoSearch extends Campo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['codigo_campo', 'nombre_campo', 'ue_campo', 'county', 'district'], 'safe'],
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
        $query = Campo::find();

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
        ]);

        $query->andFilterWhere(['like', 'codigo_campo', $this->codigo_campo])
            ->andFilterWhere(['like', 'nombre_campo', $this->nombre_campo])
            ->andFilterWhere(['like', 'ue_campo', $this->ue_campo])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'district', $this->district]);

        return $dataProvider;
    }
}
