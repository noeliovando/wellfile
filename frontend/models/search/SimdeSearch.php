<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Simde;

/**
 * SimdeSearch represents the model behind the search form of `app\models\Simde`.
 */
class SimdeSearch extends Simde
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cant_documentos', 'id_formato'], 'integer'],
            [['nombre_simde'], 'safe'],
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
        $query = Simde::find();

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
            'cant_documentos' => $this->cant_documentos,
            'id_formato' => $this->id_formato,
        ]);

        $query->andFilterWhere(['like', 'nombre_simde', $this->nombre_simde]);

        return $dataProvider;
    }
}
