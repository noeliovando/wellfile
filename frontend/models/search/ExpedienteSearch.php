<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Expediente;

/**
 * ExpedienteSearch represents the model behind the search form of `frontend\models\Expediente`.
 */
class ExpedienteSearch extends Expediente
{
    /**
     * {@inheritdoc}
     */
    public $statusNombre;
    public function rules()
    {
        return [
            [['nombre_expediente', 'finder', 'observacion'], 'safe'],
            [['cant_historias', 'cant_carp_perfiles', 'id_status', 'accion_inmediata'], 'integer'],
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
        $query = Expediente::find();

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
            'cant_historias' => $this->cant_historias,
            'cant_carp_perfiles' => $this->cant_carp_perfiles,
            'id_status' => $this->id_status,
            'accion_inmediata' => $this->accion_inmediata,
        ]);

        $query->andFilterWhere(['like', 'nombre_expediente', $this->nombre_expediente])
            ->andFilterWhere(['like', 'finder', $this->finder])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
