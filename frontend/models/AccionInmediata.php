<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "accion_inmediata".
 *
 * @property int $id
 * @property string $accion_inmediata
 *
 * @property Expediente[] $expedientes
 */
class AccionInmediata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accion_inmediata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accion_inmediata'], 'required'],
            [['accion_inmediata'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accion_inmediata' => 'Accion Inmediata',
        ];
    }

    /**
     * Gets query for [[Expedientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpedientes()
    {
        return $this->hasMany(Expediente::class, ['accion_inmediata' => 'id']);
    }
}
