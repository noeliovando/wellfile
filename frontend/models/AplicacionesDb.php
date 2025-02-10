<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "aplicaciones_db".
 *
 * @property integer $id
 * @property string $nombre
 */
class AplicacionesDb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aplicaciones_db';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }
    public function getUsuarioAplicacion()
    {
        return $this->hasMany(AplicacionUsuario::className(), ['id_aplicacion' => 'id']);
    }
}
