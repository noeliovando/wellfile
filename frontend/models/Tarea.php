<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tarea".
 *
 * @property int $id
 * @property int $id_analista
 * @property int $descripcion
 * @property string $fecha_creacion
 * @property string $fecha_asignacion
 * @property string $fecha_inicio
 * @property string $fecha_completada
 * @property int $id_estatus
 *
 * @property User $analista
 * @property Status $estatus
 */
class Tarea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_analista', 'descripcion', 'fecha_creacion', 'fecha_asignacion', 'fecha_inicio', 'fecha_completada', 'id_estatus'], 'required'],
            [['id_analista', 'descripcion', 'id_estatus'], 'integer'],
            [['fecha_creacion', 'fecha_asignacion', 'fecha_inicio', 'fecha_completada'], 'safe'],
            [['id_estatus'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_estatus' => 'id']],
            [['id_analista'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_analista' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_analista' => 'Id Analista',
            'descripcion' => 'Descripcion',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_asignacion' => 'Fecha Asignacion',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_completada' => 'Fecha Completada',
            'id_estatus' => 'Id Estatus',
        ];
    }

    /**
     * Gets query for [[Analista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnalista()
    {
        return $this->hasOne(User::class, ['id' => 'id_analista']);
    }

    /**
     * Gets query for [[Estatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus()
    {
        return $this->hasOne(Status::class, ['id' => 'id_estatus']);
    }
}
