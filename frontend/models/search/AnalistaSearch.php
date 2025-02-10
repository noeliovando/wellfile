<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Analista;

/**
 * AnalistaSearch represents the model behind the search form about `frontend\models\Analista`.
 */
class AnalistaSearch extends Analista
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'rol_id', 'id_division', 'id_proceso', 'id_suproceso', 'id_supervisor'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'id_supervisor', 'nombre', 'apellido', 'cedula', 'departamento', 'gerencia', 'telefono'], 'safe'],
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
        $query = Analista::find();

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
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'rol_id' => $this->rol_id,
            'id_division' => Yii::$app->user->identity->rol_id=='2'? $this->id_division : Yii::$app->user->identity->id_division,
            'id_proceso' => $this->id_proceso,//Yii::$app->user->identity->rol_id=='2'? $this->id_proceso : Yii::$app->user->identity->id_proceso,
            'id_suproceso' => $this->id_suproceso,
            'id_supervisor' => $this->id_supervisor,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'id_supervisor', $this->id_supervisor])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'id_proceso', $this->id_proceso])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
