<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "campo".
 *
 * @property int $id
 * @property string $codigo_campo
 * @property string $nombre_campo
 * @property string $ue_campo
 * @property string $county
 * @property string $district
 *
 * @property Pozo[] $pozos
 */
class Campo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_campo', 'nombre_campo', 'ue_campo', 'county', 'district'], 'required'],
            [['codigo_campo', 'nombre_campo', 'ue_campo', 'county', 'district'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_campo' => 'Codigo Campo',
            'nombre_campo' => 'Nombre Campo',
            'ue_campo' => 'Ue Campo',
            'county' => 'County',
            'district' => 'District',
        ];
    }

    /**
     * Gets query for [[Pozos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPozos()
    {
        return $this->hasMany(Pozo::class, ['id_campo' => 'id']);
    }
}
