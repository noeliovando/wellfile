<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "expediente".
 *
 * @property string $nombre_expediente
 * @property string|null $finder
 * @property int|null $cant_historias
 * @property int|null $cant_carp_perfiles
 * @property int|null $id_status
 * @property int|null $accion_inmediata
 * @property string|null $observacion
 *
 * @property AccionInmediata $accionInmediata
 * @property Status $status
 */
class Expediente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expediente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_expediente'], 'required'],
            [['cant_historias', 'cant_carp_perfiles', 'id_status', 'accion_inmediata'], 'integer'],
            [['nombre_expediente', 'observacion'], 'string', 'max' => 100],
            [['finder'], 'string', 'max' => 5],
            [['nombre_expediente'], 'unique'],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_status' => 'id']],
            [['accion_inmediata'], 'exist', 'skipOnError' => true, 'targetClass' => AccionInmediata::class, 'targetAttribute' => ['accion_inmediata' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombre_expediente' => 'Nombre Expediente',
            'finder' => 'Finder',
            'cant_historias' => 'Cantidad Historias',
            'cant_carp_perfiles' => 'Cantidad Carpetas Perfiles',
            'id_status' => 'Status',
            'accion_inmediata' => 'Accion Inmediata',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * Gets query for [[AccionInmediata]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccionInmediata()
    {
        return $this->hasOne(AccionInmediata::class, ['id' => 'accion_inmediata']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'id_status']);
    }
    public function getStatusNombre()
    {
        return $this->status? $this->status->status: 'Vacio';
    }

     /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Lógica para actualizar el id_status basado en cant_historias y cant_carp_perfiles
            if ($this->cant_historias == 0 && $this->cant_carp_perfiles == 0) {
                $this->id_status = 5;
            } elseif ($this->cant_historias == 0 && $this->cant_carp_perfiles > 0) {
                $this->id_status = 2;
            } elseif ($this->cant_historias > 0 && $this->cant_carp_perfiles == 0) {
                $this->id_status = 3;
            } elseif ($this->cant_historias > 0 && $this->cant_carp_perfiles > 0) {
            $this->id_status = 1;
        }
            return true;
        } else {
            return false;
        }
    }
}
