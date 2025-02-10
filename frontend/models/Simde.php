<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "simde".
 *
 * @property int $id
 * @property string $nombre_simde
 * @property int $cant_documentos
 * @property int $id_formato
 *
 * @property Formato $formato
 */
class Simde extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'simde';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_simde', 'cant_documentos', 'id_formato'], 'required'],
            [['cant_documentos', 'id_formato'], 'integer'],
            [['nombre_simde'], 'string', 'max' => 60],
            [['id_formato'], 'exist', 'skipOnError' => true, 'targetClass' => Formato::class, 'targetAttribute' => ['id_formato' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_simde' => 'Nombre Simde',
            'cant_documentos' => 'Cant Documentos',
            'id_formato' => 'Id Formato',
        ];
    }

    /**
     * Gets query for [[Formato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormato()
    {
        return $this->hasOne(Formato::class, ['id' => 'id_formato']);
    }
}
