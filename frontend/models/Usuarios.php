<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $indicador
 * @property integer $id_division
 * @property integer $id_organizacion
 * @property integer $id_empresa
 * @property string $departamento
 * @property string $telefono
 * @property string $supervisor
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'indicador', 'supervisor', 'telefono'], 'string', 'max' => 50],
            [['departamento'], 'string', 'max' => 100],
            ['indicador', 'filter', 'filter' => 'trim'],
            ['indicador', 'required', 'message' => 'No puede estar en blanco.'],
            ['indicador', 'unique', 'targetClass' => '\frontend\models\Usuarios', 'message' => 'Este usuario ya existe.'],
            ['indicador', 'string', 'min' => 2, 'max' => 255],

            ['id_organizacion', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_organizacion', 'integer'],

            ['id_division', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_division', 'integer'],

            ['nombre', 'required', 'message' => 'No puede estar en blanco.'],
            ['nombre', 'string'],

            ['departamento', 'required', 'message' => 'No puede estar en blanco.'],
            ['departamento', 'string'],

            ['telefono', 'required', 'message' => 'No puede estar en blanco.'],
            ['telefono', 'string'],

            ['id_empresa', 'required', 'message' => 'No puede estar en blanco.'],
            ['id_empresa', 'integer'],

            ['apellido', 'required', 'message' => 'No puede estar en blanco.'],
            ['apellido', 'string'],

            ['aplicaciones', 'safe'],

            ['nombreCompleto', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'indicador' => 'Indicador',
            'password' => 'Contraseña',
            'telefono' => 'Celular/Extension',
            'id_organizacion' => 'Organizacion',
            'id_empresa' => 'Empresa',
            'id_division' => 'Division',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'supervisor' => 'Indicador de Supervisor',
            'departamento' => 'Departamento/Proceso',
            'password_repeat' => 'Repita Contraseña',
        ];
    }

    public function getNombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    public function getOrganizacion()
    {
        return $this->hasOne(Organizacion::className(), ['id' => 'id_organizacion']);
    }

    public function getDistrito()
    {
        return $this->hasOne(Distrito::className(), ['id' => 'id_distrito']);
    }

    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'id_division']);
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'id_empresa']);
    }

    public function getOrganizacionNombre()
    {
        return $this->organizacion ? $this->organizacion->nombre : 'Vacio';
    }

    public function getAplicacionNombre()
    {
        return $this->aplicacion ? $this->aplicacion->nombre : 'Vacio';
    }

    public function getDivisionNombre()
    {
        return $this->division ? $this->division->nombre : 'Vacio';
    }

    public function getDistritoNombre()
    {
        return $this->distrito ? $this->distrito->nombre : 'Vacio';
    }

    public function getEmpresaNombre()
    {
        return $this->empresa ? $this->empresa->nombre : 'Vacio';
    }

    public function getOrganizaciones()
    {
        $datos = Organizacion::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getDivisiones()
    {
        $datos = Division::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getAplicaciones()
    {
        $datos = AplicacionesDb::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getEmpresas()
    {
        $datos = Empresa::find()->orderBy(['orden' => SORT_ASC])->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function getDistritos()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }

    public function actualizar()
    {
        if ($this->validate()) {
            $usuario = new Usuarios();
            $usuario->nombre = $this->nombre;
            $usuario->apellido = $this->apellido;
            $usuario->indicador = $this->indicador;
            $usuario->id_division = $this->id_division;
            $usuario->id_empresa = $this->id_empresa;
            $usuario->departamento = $this->departamento;
            $usuario->telefono = $this->telefono;
            $usuario->setPassword($this->password);
            $usuario->generateAuthKey();
            if ($usuario->save()) {
                return $usuario;
            }
        }

        return null;
    }

    public function setPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    }

    public function setPasswordHasch()
    {
        $this->password_hash = $this->password_hash;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAplicacionUsuario()
    {
        return $this->hasMany(AplicacionUsuario::className(), ['id_usuario' => 'id']);
    }

    public function getAplicacionesPermitidasList()
    {
        return $this->getAplicacionesPermitidas()->asArray();
    }

    public function setNombre(){
        $this->nombre = strtoupper(substr($this->nombre,0,1)) .strtolower(substr($this->nombre,1));
    }
    public function setApellido(){
        $this->apellido = strtoupper(substr($this->apellido,0,1)) .strtolower(substr($this->apellido,1));
    }
    public function setIndicador(){
        $this->indicador = strtolower($this->indicador);
    }
    public function setCorreo(){
        $this->correo = strtolower($this->correo);
    }
    public function setDepartamento(){
        $this->departamento = strtoupper(substr($this->departamento,0,1)) .strtolower(substr($this->departamento,1));
    }
    public function setSupervisor(){
        $this->supervisor = strtolower($this->supervisor);
    }
}