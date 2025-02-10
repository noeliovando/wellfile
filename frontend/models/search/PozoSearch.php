<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Pozo;

/**
 * PozoSearch represents the model behind the search form of `frontend\models\Pozo`.
 */
class PozoSearch extends Pozo
{
    /**
     * {@inheritdoc}
     */
    public $campoNombre;
    public function rules()
    {
        return [
            [['nombre_finder', 'spud_date', 'nombre_simde', 'observacion'], 'safe'],
            [['id_campo', 'id_unidad_exp', 'id_division', 'id_distrito'], 'integer'],
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
        $query = Pozo::find();

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
            'id_campo' => $this->id_campo,
            'id_unidad_exp' => $this->id_unidad_exp,
            'id_division' => $this->id_division,
            'spud_date' => $this->spud_date,
            'id_distrito' => $this->id_distrito,
        ]);

        $query->andFilterWhere(['like', 'nombre_finder', $this->nombre_finder])
            ->andFilterWhere(['like', 'nombre_simde', $this->nombre_simde])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);


        return $dataProvider;
    }
}
