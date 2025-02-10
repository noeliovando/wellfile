<?php

namespace frontend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "carpeta_registro".
 *
 * @property int $id
 * @property string $nombre
 * @property int $id_pozo
 *
 * @property Pozo $pozo
 */
class CarpetaRegistro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carpeta_registro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'id_pozo'], 'required'],
            [['id_pozo'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_pozo'], 'exist', 'skipOnError' => true, 'targetClass' => Pozo::class, 'targetAttribute' => ['id_pozo' => 'id']],
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
            'id_pozo' => 'Pozo',
        ];
    }

    /**
     * Gets query for [[Pozo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPozo()
    {
        return $this->hasOne(Pozo::class, ['id' => 'id_pozo']);
    }

    public function getPozos()
    {
        $datos = Pozo::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre_oficial');
    }
}
