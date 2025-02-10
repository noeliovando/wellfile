<?php

namespace frontend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "documentos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha
 * @property int $id_subcarpeta
 *
 * @property Subcarpeta $subcarpeta
 */
class Documentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha', 'id_subcarpeta'], 'required'],
            [['fecha'], 'safe'],
            [['id_subcarpeta'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_subcarpeta'], 'exist', 'skipOnError' => true, 'targetClass' => Subcarpeta::class, 'targetAttribute' => ['id_subcarpeta' => 'id']],
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
            'fecha' => 'Fecha',
            'id_subcarpeta' => 'Subcarpeta',
        ];
    }

    /**
     * Gets query for [[Subcarpeta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcarpeta()
    {
        return $this->hasOne(Subcarpeta::class, ['id' => 'id_subcarpeta']);
    }

    public function getSubcarpetas()
    {
        $datos = Subcarpeta::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
}
