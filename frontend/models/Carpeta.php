<?php

namespace frontend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "carpeta".
 *
 * @property int $id
 * @property string $nombre
 * @property int $digital
 * @property int $fisico
 * @property string $vagon
 * @property string $nivel
 * @property int $id_pozo
 *
 * @property Pozo $pozo
 * @property Subcarpeta[] $subcarpetas
 */
class Carpeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carpeta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'digital', 'fisico', 'vagon', 'nivel', 'id_pozo'], 'required'],
            [['digital', 'fisico', 'id_pozo'], 'integer'],
            [['nombre', 'vagon', 'nivel'], 'string', 'max' => 100],
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
            'digital' => 'Digital',
            'fisico' => 'Fisico',
            'vagon' => 'vagon',
            'nivel' => 'Nivel',
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

    /**
     * Gets query for [[Subcarpetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcarpetas()
    {
        return $this->hasMany(Subcarpeta::class, ['id_carpeta' => 'id']);
    }

    public function getPozos()
    {
        $datos = Pozo::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre_oficial');
    }
}
