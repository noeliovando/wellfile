<?php

namespace frontend\models\search;

use frontend\models\ActividadDetallada;
use frontend\models\ActividadMacro;
use frontend\models\AplicacionesDb;
use frontend\models\Empresa;
use frontend\models\Organizacion;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Actividad;
use frontend\models\Division;
use frontend\models\Proceso;
use frontend\models\User;
use frontend\models\Usuarios;
use yii\helpers\ArrayHelper;

/**
 * ActividadSearch represents the model behind the search form about `frontend\models\Actividad`.
 */

class ActividadSearch extends Actividad
{
    public $macroNombre;
    public $empresaNombre;
    public $analistaUsername;
    public $organizacionNombre;
    public $aplicacionNombre;
    public $detalladaNombre;
    public $procesoNombre;
    public $divisionNombre;
    public $usuarioNombre;
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_actividad', 'id_proceso', 'id_usuario', 'id_division', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_proy_ep', 'id_dato_cargado', 'id_macro', 'id_detallada'], 'integer'],
            [['codigo_caso', 'id_analista', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'detalle'], 'safe'],
            [['HH'], 'number'],
            [['macroNombre'], 'safe'],
            [['empresaNombre'], 'safe'],
            [['analistaUsername'], 'safe'],
            [['organizacionNombre'], 'safe'],
            [['aplicacionNombre'], 'safe'],
            [['detalladaNombre'], 'safe'],
            [['divisionNombre'], 'safe'],
            [['usuarioNombre'], 'safe'],



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
     *
     */

    public function search($params)
    {
        $query = Actividad::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(Yii::$app->user->identity->rol_id=='3')
            $query->andFilterWhere([
                'actividad.id_actividad' => $this->id_actividad,
                'actividad.id_proceso' => $this->id_proceso,
                'actividad.id_analista' => Yii::$app->user->identity->id,
                'actividad.id_usuario' => $this->id_usuario,
                'actividad.id_bd' => $this->id_bd,
                'actividad.id_division' => $this->id_division,
                'actividad.id_organizacion' => $this->id_organizacion,
                'actividad.id_empresa' => $this->id_empresa,
                'actividad.id_proceso' => $this->id_proceso,
                'actividad.id_proyecto' => $this->id_proyecto,
                'actividad.id_proy_ep' => $this->id_proy_ep,
                'actividad.id_dato_cargado' => $this->id_dato_cargado,
                'actividad.id_macro' => $this->id_macro,
                'actividad.id_detallada' => $this->id_detallada,
                'actividad.fecha_requerimiento' => $this->fecha_requerimiento,
                'actividad.hora_requerimiento' => $this->hora_requerimiento,
                'actividad.fecha_atencion' => $this->fecha_atencion,
                'actividad.hora_ini' => $this->hora_ini,
                'actividad.hora_fin' => $this->hora_fin,
                'actividad.HH' => $this->HH,
                'actividad.detalle' => $this->detalle
            ])
                ->orderBy(['actividad.fecha_atencion' => SORT_DESC,'actividad.hora_ini' => SORT_DESC]);
                if(Yii::$app->user->identity->rol_id=='5')
                $query->andFilterWhere([
                    'actividad.id_actividad' => $this->id_actividad,
                    'actividad.id_proceso' => $this->id_proceso,
                    'actividad.id_analista' => $this->id_analista,
                    'actividad.id_usuario' => $this->id_usuario,
                    'actividad.id_bd' => $this->id_bd,
                    'actividad.id_division' => $this->id_division,
                    'actividad.id_organizacion' => $this->id_organizacion,
                    'actividad.id_empresa' => $this->id_empresa,
                    'actividad.id_proceso' => $this->id_proceso,
                    'actividad.id_proyecto' => $this->id_proyecto,
                    'actividad.id_proy_ep' => $this->id_proy_ep,
                    'actividad.id_dato_cargado' => $this->id_dato_cargado,
                    'actividad.id_macro' => $this->id_macro,
                    'actividad.id_detallada' => $this->id_detallada,
                    'actividad.fecha_requerimiento' => $this->fecha_requerimiento,
                    'actividad.hora_requerimiento' => $this->hora_requerimiento,
                    'actividad.fecha_atencion' => $this->fecha_atencion,
                    'actividad.hora_ini' => $this->hora_ini,
                    'actividad.hora_fin' => $this->hora_fin,
                    'actividad.HH' => $this->HH,
                    'actividad.detalle' => $this->detalle
                ])
                    ->orderBy(['actividad.fecha_atencion' => SORT_DESC,'actividad.hora_ini' => SORT_DESC]);

        //$query->joinWith(['analistaid']);

        if(Yii::$app->user->identity->rol_id=='4') {
            $query->joinWith(['analistaid' => function ($q) {
                $q->where('user.id_supervisor LIKE "%' . Yii::$app->user->identity->id . '%" OR user.id ='. Yii::$app->user->identity->id);
            }]);
            $query->andFilterWhere([
                'actividad.id_actividad' => $this->id_actividad,
                'actividad.id_proceso' => $this->id_proceso,
                'actividad.id_analista' => $this->id_analista,
                'actividad.id_usuario' => $this->id_usuario,
                'actividad.id_bd' => $this->id_bd,
                'actividad.id_division' => $this->id_division,
                'actividad.id_organizacion' => $this->id_organizacion,
                'actividad.id_proceso' => $this->id_proceso,
                'actividad.id_empresa' => $this->id_empresa,
                'actividad.id_proyecto' => $this->id_proyecto,
                'actividad.id_proy_ep' => $this->id_proy_ep,
                'actividad.id_dato_cargado' => $this->id_dato_cargado,
                'actividad.id_macro' => $this->id_macro,
                'actividad.id_detallada' => $this->id_detallada,
                'actividad.fecha_requerimiento' => $this->fecha_requerimiento,
                'actividad.hora_requerimiento' => $this->hora_requerimiento,
                'actividad.fecha_atencion' => $this->fecha_atencion,
                'actividad.hora_ini' => $this->hora_ini,
                'actividad.hora_fin' => $this->hora_fin,
                'actividad.HH' => $this->HH,
                'actividad.detalle' => $this->detalle
            ])
                ->orderBy(['actividad.fecha_atencion' => SORT_DESC,'actividad.hora_ini' => SORT_DESC]);

        }
        $query->andFilterWhere(['like', 'codigo_caso', $this->codigo_caso]);

        $query->joinWith(['macro' => function ($q) {
            $q->where('actividad_macro.nombre LIKE "%' . $this->macroNombre . '%"');
        }]);
        $query->joinWith(['empresaid' => function ($q) {
            $q->where('empresa.nombre LIKE "%' . $this->empresaNombre . '%"');
        }]);
        $query->joinWith(['analistaid' => function ($q) {
            $q->where('user.username LIKE "%' . $this->analistaUsername . '%"');
        }]);
        $query->joinWith(['organizacionid' => function ($q) {
            $q->where('organizacion.nombre LIKE "%' . $this->organizacionNombre . '%"');
        }]);
        $query->joinWith(['aplicdbid' => function ($q) {
            $q->where('aplicaciones_db.nombre LIKE "%' . $this->aplicacionNombre . '%"');
        }]);
        $query->joinWith(['detalladaid' => function ($q) {
            $q->where('actividad_detallada.nombre LIKE "%' . $this->detalladaNombre . '%"');
        }]);
        $query->joinWith(['procesoid' => function ($q) {
            $q->where('proceso.nombre LIKE "%' . $this->procesoNombre . '%"');
        }]);
        $query->joinWith(['divisionid' => function ($q) {
            $q->where('division.nombre LIKE "%' . $this->divisionNombre . '%"');
        }]);
        $query->joinWith(['usuarioid' => function ($q) {
            $q->where('usuarios.nombre LIKE "%' . $this->usuarioNombre . '%"');
        }]);
        return $dataProvider;
    }
    public function getMacroNombre()
    {
        return $this->macros? $this->macros->nombre: 'Vacio';
    }

    public function getMacros()
    {
        return $this->hasOne(ActividadMacro::className(),['id' =>'id_macro']);
    }
    public function getActividadesMacro()
    {
        return ArrayHelper::map(ActividadMacro::find()->asArray()->all(), 'id', 'nombre');
    }
    public function getActividadMacro()
    {
        $datos = ActividadMacro::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getEmpresa()
    {
        $datos = Empresa::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getAnalista()
    {
        $datos = User::find()->andwhere(['rol_id' =>'3' ])->andwhere('user.username LIKE "%' . Yii::$app->user->identity->username . '%"')->all();
        if(Yii::$app->user->identity->rol_id=='4'){
            $datos = User::find()->orwhere(['rol_id' =>'3' ])->orwhere(['rol_id' =>'4' ])->all();
        }
        return ArrayHelper::map($datos, 'id', 'username');
    }
    public function getOrganizacion()
    {
        $datos = Organizacion::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getAplicacion()
    {
        $datos = AplicacionesDb::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    
    public function getProceso()
    {
        $datos = Proceso::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getActividadDetallada()
    {
        $datos = ActividadDetallada::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getDivision()
    {
        $datos = Division::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getProcesoid()
    {
        return $this->hasOne(Proceso::className(),['id' =>'id_proceso']);
    }


}
