<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Reporte;
use frontend\models\Organizacion;
use frontend\models\ActividadDetallada;
use frontend\models\ActividadMacro;
use yii\helpers\ArrayHelper;

/**
 * ReporteSearch represents the model behind the search form about `frontend\models\Reporte`.
 */
class ReporteSearch extends Reporte
{
    public $mes;
    public $anio;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad', 'id_usuario', 'id_bd', 'id_organizacion', 'id_empresa', 'id_proyecto', 'id_proy_ep', 'id_dato_cargado', 'id_macro', 'id_detallada'], 'integer'],
            [['codigo_caso', 'id_analista', 'fecha_atencion', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'detalle'], 'safe'],
            [['HH'], 'number'],
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
        $query = Reporte::find();

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
            'id_actividad' => $this->id_actividad,
            'id_usuario' => $this->id_usuario,
            'id_bd' => $this->id_bd,
            'id_organizacion' => $this->id_organizacion,
            'id_empresa' => $this->id_empresa,
            'id_proyecto' => $this->id_proyecto,
            'id_proy_ep' => $this->id_proy_ep,
            'id_dato_cargado' => $this->id_dato_cargado,
            'id_macro' => $this->id_macro,
            'id_detallada' => $this->id_detallada,
            'fecha_atencion' => $this->fecha_atencion,
            'hora_requerimiento' => $this->hora_requerimiento,
            'fecha_atencion' => $this->fecha_atencion,
            'hora_ini' => $this->hora_ini,
            'hora_fin' => $this->hora_fin,
            'HH' => $this->HH,
        ]);

        $query->andFilterWhere(['like', 'codigo_caso', $this->codigo_caso])
            ->andFilterWhere(['like', 'id_analista', $this->id_analista])
            ->andFilterWhere(['like', 'detalle', $this->detalle]);

        return $dataProvider;
    }

    public function getNumeroEEII($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';

        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1 AND fecha_atencion =>".$anio."-".$mes."-01 AND fecha_atencion <=".$anio."-".$mes."-31";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '1'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }

    public function getNumeroDY($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 2";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '2'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroOP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 3";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '3'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroCMP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 4";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '4'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNumeroOOGG($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 6 OR id_organizacion = 5";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->andwhere(['or','id_organizacion=6','id_organizacion=5'])
            ->count();
        return $count;
    }
    public function getNroPSF($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '1'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroPJ($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '2'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroPC($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '3'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroPM($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '4'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroPMI($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '5'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroPU($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '6'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroINDO($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '7'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroPA($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '8'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getNroAP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 7";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_empresa', '9'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->count();
        return $count;
    }
    public function getHHEEII($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';

        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1 AND fecha_atencion =>".$anio."-".$mes."-01 AND fecha_atencion <=".$anio."-".$mes."-31";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '1'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }

    public function getHHDY($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 2";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '2'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getHHOP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        //$sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 3";
        //$count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '3'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getHHCMP($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 4";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['=', 'id_organizacion', '4'])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getHHOOGG($mes)
    {
        $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 1)
            $proceso='MD';
        if(Yii::$app->user->identity->id_proceso == 2)
            $proceso='MC';
        if(Yii::$app->user->identity->id_proceso == 3)
            $proceso='SFT';

        $division ='Junin';
        if(Yii::$app->user->identity->id_division == 1)
            $division='Junin';
        if(Yii::$app->user->identity->id_division == 2)
            $division='Ayacucho';
        if(Yii::$app->user->identity->id_division == 3)
            $division='Carabobo';
        if(Yii::$app->user->identity->id_division == 4)
            $division='Boyaca';
        $anio=date('Y');
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 6 OR id_organizacion = 5";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        $count = $this::find()
            ->andwhere(['>=', 'fecha_atencion', $desde])
            ->andwhere(['<=', 'fecha_atencion', $hasta])
            ->andwhere(['like','codigo_caso',$proceso])
            ->andWhere(['like','codigo_caso',$division])
            ->andwhere(['or','id_organizacion=6','id_organizacion=5'])
            ->sum('HH');
        return number_format($count,2);
    }
    public function getOrganizaciones()
    {
        return $this->hasOne(Organizacion::className(),['id' =>'id_organizacion']);
    }
    public function getOrganizacionesNombres(){
        $datos = Organizacion::find()
            ->asArray()
            ->orderBy(['orden' => SORT_ASC])
            ->all();
        return ArrayHelper::map($datos,'id','abreviacion');
    }
    public function getOrganizacionNombre(){
        $nombre = Organizacion::find()
            ->asArray()
            ->one();
        return ArrayHelper::getValue($nombre,'nombre');
    }
    public function getOrganizacionesId(){
        $datos = Organizacion::find()
            ->asArray()
            ->orderBy(['orden' => SORT_ASC])
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getCantidadCursos($id_organizacion){
        if(date('d')>25&&date('d')<=31)
            $fecha=date('m')+1;
        else
            $fecha=date('m')+0;
        for($i=0;$i<$fecha;$i++) {
            $mes=$i+1;
            $anio=date('Y');
            if(($mes-1)<1)
                $desde = ($anio-1).'-'.'12'.'-26';
            else
                $desde = $anio.'-'.($mes-1).'-26';
            $hasta = $anio.'-'.$mes.'-25';
            $count = $this::find()
                ->andWhere(['id_organizacion'=> $id_organizacion])
                ->andwhere(['>=', 'fecha_atencion', $desde])
                ->andwhere(['<=', 'fecha_atencion', $hasta])
                ->count();
            $cantidadCursos[$i]=$count+0;
        }
        return $cantidadCursos;
    }
    public function getCantidadHH($id_organizacion){
        if(date('d')>25&&date('d')<=31)
            $fecha=date('m')+1;
        else
            $fecha=date('m')+0;
        for($i=0;$i<$fecha;$i++) {
            $mes=$i+1;
            $anio=date('Y');
            if(($mes-1)<1)
                $desde = ($anio-1).'-'.'12'.'-26';
            else
                $desde = $anio.'-'.($mes-1).'-26';
            $hasta = $anio.'-'.$mes.'-25';
            $count = $this::find()
                ->andWhere(['id_organizacion'=> $id_organizacion])
                ->andwhere(['>=', 'fecha_atencion', $desde])
                ->andwhere(['<=', 'fecha_atencion', $hasta])
                ->sum('HH');
            $cantidadCursos[$i]=$count+0;
        }
        return $cantidadCursos;
    }
    public function getActividades()
    {
        return $this->hasOne(Actividades::className(),['id' =>'id_organizacion']);
    }
    public function getActividadesNombres(){
        $datos = ActividadDetallada::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos,'id','nombre');
    }
    public function getActividadNombre(){
        $nombre = ActividadDetallada::find()
            ->asArray()
            ->one();
        return ArrayHelper::getValue($nombre,'nombre');
    }
    public function getActividadesId(){
        $datos = ActividadDetallada::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getNumeroServicios(){
        
        if(date('d')>25&&date('d')<=31)
            $fecha=date('m')+1;
        else
            $fecha=date('m')+0;
        $mes= $fecha;
        $anio=date('Y');
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';
        echo 'desde: '.$desde.'</br>';
        echo 'hasta: '.$hasta.'</br>';
        //$desde = '2024-01-27'; 
        //$hasta = '2024-02-23';    
        $organizacionesid = $this->getOrganizacionesId();
        $organizacionesNombre = $this->getOrganizacionesNombres();
        $actividadesId = $this->getActividadesId();
        $actividadesNombre = $this->getActividadesNombres();
        $i=1;
        $j=1;
        foreach ($actividadesId as $actividad) {
            $j=1;
            //echo 'Organización: '.$organizacionesNombre[$organizacion].'</br>';
             $resultDataActividad = [
                'actividad' => $actividadesNombre[$actividad],
             ];
            foreach($organizacionesid as $organizacion){
                $count = $this::find()
                ->andWhere(['id_organizacion' => $organizacion])
                ->andWhere(['id_detallada'=> $actividad])
                ->andwhere(['>=', 'fecha_atencion', $desde])
                ->andwhere(['<=', 'fecha_atencion', $hasta])
                ->count();
                $resultDataActividad[$organizacionesNombre[$organizacion]]  = $count+0;
                ;
                    //echo '  -> Actividad: '. $actividadesNombre[$actividad].'='.$count.'</br>';
                //echo '<pre>'; print_r($count); echo '</pre>';
            }
            $resultData [] = $resultDataActividad;
            //echo '<pre>'; print_r($actividades); echo '</pre>';  
            $j++;
        }
        //echo '<pre>'; print_r($resultData); echo '</pre>';
        return $resultData;
    }
    public function getActividadesNombresMAD(){
        $datos = ActividadDetallada::find()
            ->asArray()
            ->andWhere(['>=','id_macro', 1])
            ->andWhere(['<=','id_macro', 7])
            ->all();
        return ArrayHelper::map($datos,'id','nombre');
    }
    public function getActividadesIdMAD(){
        $datos = ActividadDetallada::find()
            ->asArray()
            ->andWhere(['>=','id_macro', 1])
            ->andWhere(['<=','id_macro', 7])
            ->all();
        return ArrayHelper::map($datos,'id','id');
    }
    public function getNumeroServiciosMAD(){
        if(date('d')>25&&date('d')<=31)
            $fecha=date('m')+1;
        else
            $fecha=date('m')+0;
        $mes= $fecha;
        $anio=date('Y');
        if(($mes-1)<1)
            $desde = ($anio-1).'-'.'12'.'-26';
        else
            $desde = $anio.'-'.($mes-1).'-26';
        $hasta = $anio.'-'.$mes.'-25';

        $organizacionesid = $this->getOrganizacionesId();
        $organizacionesNombre = $this->getOrganizacionesNombres();
        $actividadesId = $this->getActividadesIdMAD();
        $actividadesNombre = $this->getActividadesNombresMAD();
        $i=1;
        $j=1;
        foreach ($actividadesId as $actividad) {
            $j=1;
            
             $resultDataActividad = [
                'actividad' => $actividadesNombre[$actividad],
             ];
            foreach($organizacionesid as $organizacion){
                $count = $this::find()
                ->andWhere(['id_organizacion' => $organizacion])
                ->andWhere(['id_detallada'=> $actividad])
                ->andWhere(['>=','id_macro', 1])
                ->andWhere(['<=','id_macro', 7])
                ->andwhere(['>=', 'fecha_atencion', $desde])
                ->andwhere(['<=', 'fecha_atencion', $hasta])
                ->count();
                $resultDataActividad[$organizacionesNombre[$organizacion]]  = $count+0;
                //echo '  -> Actividad: '. $actividadesNombre[$actividad].'='.$count.'</br>';
                //echo '<pre>'; print_r($count); echo '</pre>';
            }
            $resultData [] = $resultDataActividad;
            //echo '<pre>'; print_r($actividades); echo '</pre>';  
            $j++;
        }
        //echo '<pre>'; print_r($resultData); echo '</pre>';
        return $resultData;
    }

}
