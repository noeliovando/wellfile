<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "actividad".
 *
 * @property integer $id_actividad
 * @property string $codigo_caso
 * @property string $id_analista
 * @property integer $id_subproceso
 * @property integer $id_usuario
 * @property integer $id_via
 * @property integer $id_bd
 * @property integer $id_organizacion
 * @property integer $id_distrito
 * @property integer $id_empresa
 * @property integer $id_proyecto
 * @property integer $id_proy_ep
 * @property integer $id_dato_cargado
 * @property integer $ndlis
 * @property integer $nlis
 * @property integer $nlas
 * @property integer $ntiff
 * @property integer $npdf
 * @property integer $npds
 * @property integer $id_anio_pozo
 * @property integer $id_macro
 * @property integer $id_detallada
 * @property string $fecha_requerimiento
 * @property string $hora_requerimiento
 * @property string $fecha_ini_aten
 * @property string $hora_ini
 * @property string $fecha_fin_aten
 * @property string $hora_fin
 * @property double $HH
 * @property integer $id_status
 * @property string $detalle
 * @property string $pozo
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_caso', 'id_analista', 'id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_distrito', 'id_empresa', 'id_proyecto', 'id_proy_ep', 'id_dato_cargado', 'id_macro', 'id_detallada', 'fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin', 'HH', 'id_status', 'detalle'], 'required'],
            [['id_subproceso', 'id_usuario', 'id_via', 'id_bd', 'id_organizacion', 'id_distrito', 'id_empresa', 'id_proyecto', 'id_proy_ep', 'id_dato_cargado', 'ndlis', 'nlis', 'nlas', 'ntiff', 'npdf', 'npds', 'id_anio_pozo', 'id_macro', 'id_detallada', 'id_status'], 'integer'],
            [['fecha_requerimiento', 'hora_requerimiento', 'fecha_atencion', 'hora_ini', 'hora_fin'], 'safe'],
            [['HH'], 'number'],
            [['detalle'], 'string'],
            [['codigo_caso'], 'string', 'max' => 25],
            [['id_analista'], 'string', 'max' => 20],
            [['pozo'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_actividad' => 'Id Actividad',
            'codigo_caso' => 'Codigo Caso',
            'id_analista' => 'Id Analista',
            'id_subproceso' => 'Id Subproceso',
            'id_usuario' => 'Id Usuario',
            'id_via' => 'Id Via',
            'id_bd' => 'Id Bd',
            'id_organizacion' => 'Id Organizacion',
            'id_distrito' => 'Id Distrito',
            'id_empresa' => 'Id Empresa',
            'id_proyecto' => 'Id Proyecto',
            'id_proy_ep' => 'Id Proy Ep',
            'id_dato_cargado' => 'Id Dato Cargado',
            'ndlis' => 'Ndlis',
            'nlis' => 'Nlis',
            'nlas' => 'Nlas',
            'ntiff' => 'Ntiff',
            'npdf' => 'Npdf',
            'npds' => 'Npds',
            'id_anio_pozo' => 'Id Anio Pozo',
            'id_macro' => 'Id Macro',
            'id_detallada' => 'Id Detallada',
            'fecha_requerimiento' => 'Fecha Requerimiento',
            'hora_requerimiento' => 'Hora Requerimiento',
            'fecha_atencion' => 'Fecha Atencion',
            'hora_ini' => 'Hora Ini',
            'hora_fin' => 'Hora Fin',
            'HH' => 'Hh',
            'id_status' => 'Id Status',
            'detalle' => 'Detalle',
            'pozo' => 'Pozo',
        ];
    }

    public function getNumeroEEII($mes)
    {
        $sql = "SELECT COUNT(*) FROM actividad WHERE id_organizacion = 1";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        return $count;
    }
}
