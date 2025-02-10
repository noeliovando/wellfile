<?php

namespace frontend\models;

use common\models\User;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $rol_id
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property integer $id_division
 * @property integer $id_proceso
 * @property integer $id_suproceso
 * @property string $gerencia
 * @property string $telefono
 * @property integer $id_supervisor
 *
 * @property AplicacionUsuario[] $aplicacionUsuarios
 * @property AplicacionesDb[] $idAplicacions
 */
class Analista extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;
    public $password_repeat;
    public $aplicaciones;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message' => 'No puede estar en blanco.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','message' => 'No puede estar en blanco.'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya existe.'],

            ['password', 'required','message' => 'No puede estar en blanco.'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Contraseña no coincide"],

            ['cedula', 'required','message' => 'No puede estar en blanco.'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['cedula', 'integer'],

            ['id_supervisor', 'required','message' => 'No puede estar en blanco.'],
            ['id_supervisor', 'string'],

            ['id_division', 'required','message' => 'No puede estar en blanco.'],
            ['id_division', 'integer'],

            ['nombre', 'required','message' => 'No puede estar en blanco.'],
            ['nombre', 'string'],

            ['id_proceso', 'required','message' => 'No puede estar en blanco.'],
            ['id_proceso', 'string'],

            ['telefono', 'required','message' => 'No puede estar en blanco.'],
            ['telefono', 'string'],

            ['id_empresa', 'required','message' => 'No puede estar en blanco.'],
            ['id_empresa', 'integer'],

            ['apellido', 'required','message' => 'No puede estar en blanco.'],
            ['apellido', 'string'],
            ['aplicaciones', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Indicador',
            'email' => 'Correo PDVSA',
            'password' => 'Contraseña',
            'cedula' => 'Cedula',
            'telefono' => 'Celular/Extension',
            'id_supervisor' => 'Indicador de Supervisor',
            'id_division' => 'Division',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'id_proceso' => 'Departamento/Proceso',
            'password_repeat' => 'Repita Contraseña',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */

    public function getNombreCompleto()
    {
        return $this->nombre.' '.$this->apellido;
    }
    public function getRol()
    {
        return $this->hasOne(Rol::className(),['id' =>'rol_id']);
    }
    public function getDivision()
    {
        return $this->hasOne(Division::className(),['id' =>'id_division']);
    }
    public function getOrganizacionNombre()
    {
        return $this->organizacion? $this->organizacion->nombre: 'Vacio';
    }
    public function getAplicacionNombre()
    {
        return $this->aplicacion? $this->aplicacion->nombre: 'Vacio';
    }
    public function getDivisionNombre()
    {
        return $this->division? $this->division->nombre: 'Vacio';
    }
    public function getDistritoNombre()
    {
        return $this->distrito? $this->distrito->nombre: 'Vacio';
    }
    public function getEmpresaNombre()
    {
        return $this->empresa? $this->empresa->nombre: 'Vacio';
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
        $datos = Empresa::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getDistritos()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getUsers()

    {
        return $this->hasMany(User::className(), ['rol_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes){
        \Yii::$app->db->createCommand()->delete('aplicacion_usuario', 'id_usuario = '.(int) $this->id)->execute();

        foreach ($this->aplicaciones as $id) {
            $usrapp = new AplicacionUsuario();
            $usrapp->id_usuario = $this->id;
            $usrapp->save();
        }
    }
    public function modificarApp(){
        \Yii::$app->db->createCommand()->delete('aplicacion_usuario', 'id_usuario = '.(int) $this->id)->execute();

        foreach ($this->aplicaciones as $id) {
            $usrapp = new AplicacionUsuario();
            $usrapp->id_usuario = $this->id;
            $usrapp->save();
        }
    }

    public function getAplicacionUsuario()
    {
        return $this->hasMany(AplicacionUsuario::className(), ['id_usuario' => 'id']);
    }

    public function getAplicacionesPermitidasList()
    {
        return $this->getAplicacionesPermitidas()->asArray();
    }
    public function setPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
