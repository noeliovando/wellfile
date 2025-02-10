<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "unidad_explotacion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 *
 * @property Pozo[] $pozos
 */
class UnidadExplotacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_explotacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'codigo'], 'required'],
            [['nombre', 'codigo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * Gets query for [[Pozos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPozos()
    {
        return $this->hasMany(Pozo::class, ['id_unidad_exp' => 'id']);
    }
}
