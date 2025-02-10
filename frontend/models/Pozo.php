<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pozo".
 *
 * @property string $nombre_finder
 * @property int $id_campo
 * @property int|null $id_unidad_exp
 * @property int $id_division
 * @property string|null $spud_date
 * @property string|null $nombre_simde
 * @property string|null $observacion
 * @property int $id_distrito
 *
 * @property Campo $campo
 * @property Distrito $distrito
 * @property Division $division
 * @property UnidadExplotacion $unidadExp
 */
class Pozo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pozo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_finder', 'id_campo', 'id_division', 'id_distrito'], 'required'],
            [['id_campo', 'id_unidad_exp', 'id_division', 'id_distrito'], 'integer'],
            [['spud_date'], 'safe'],
            [['nombre_finder'], 'string', 'max' => 100],
            [['nombre_simde'], 'string', 'max' => 50],
            [['observacion'], 'string', 'max' => 250],
            [['nombre_finder'], 'unique'],
            [['id_campo'], 'exist', 'skipOnError' => true, 'targetClass' => Campo::class, 'targetAttribute' => ['id_campo' => 'id']],
            [['id_division'], 'exist', 'skipOnError' => true, 'targetClass' => Division::class, 'targetAttribute' => ['id_division' => 'id']],
            [['id_unidad_exp'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadExplotacion::class, 'targetAttribute' => ['id_unidad_exp' => 'id']],
            [['id_distrito'], 'exist', 'skipOnError' => true, 'targetClass' => Distrito::class, 'targetAttribute' => ['id_distrito' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombre_finder' => 'Nombre finder',
            'id_campo' => 'Campo',
            'id_unidad_exp' => 'Unidad de Explotación',
            'id_division' => 'División',
            'spud_date' => 'Spud Date',
            'nombre_simde' => 'Nombre Simde',
            'observacion' => 'Observacion',
            'id_distrito' => 'Distrito',
        ];
    }

    /**
     * Gets query for [[Campo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampo()
    {
        return $this->hasOne(Campo::className(), ['id' => 'id_campo']);
    }
    public function getCampoNombre()
    {
        return $this->campo? $this->campo->nombre_campo: 'Vacio';
    }

    /**
     * Gets query for [[Distrito]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrito()
    {
        return $this->hasOne(Distrito::class, ['id' => 'id_distrito']);
    }
    public function getDistritoNombre()
    {
        return $this->distrito? $this->distrito->nombre: 'Vacio';
    }

    /**
     * Gets query for [[Division]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::class, ['id' => 'id_division']);
    }
    public function getDivisionNombre()
    {
        return $this->division? $this->division->nombre: 'Vacio';
    }

    /**
     * Gets query for [[UnidadExp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadExp()
    {
        return $this->hasOne(UnidadExplotacion::class, ['id' => 'id_unidad_exp']);
    }
    public function getUnidadexpNombre()
    {
        return $this->unidadExp? $this->unidadExp->nombre: 'Vacio';
    }
    
    
    
}
