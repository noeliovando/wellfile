<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $division;
    public $cedula;
    public $id_organizacion;
    public $departamento;
    public $id_division;
    public $nombre;
    public $apellido;
    public $id_empresa;
    public $id_distrito;
    public $password_repeat;
    public $telefono;
    public $id_proceso;
    public $id_supervisor;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya existe.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Contraseña no coincide"],

            ['cedula', 'required'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuario ya existe.'],
            ['cedula', 'integer'],

            //['supervisor', 'required'],
            //['supervisor', 'string'],

            //['id_organizacion', 'required'],
            //['id_organizacion', 'integer'],

            ['id_division', 'required'],
            ['id_division', 'integer'],

            //['id_distrito', 'required'],
            //['id_distrito', 'integer'],

            ['id_proceso', 'required'],
            ['id_proceso', 'integer'],

            ['id_supervisor', 'required'],
            ['id_supervisor', 'integer'],

            ['nombre', 'required'],
            ['nombre', 'string'],

            //['departamento', 'required'],
            //['departamento', 'string'],

            ['telefono', 'required'],
            ['telefono', 'string'],

            //['id_empresa', 'required'],
            //['id_empresa', 'integer'],

            ['apellido', 'required'],
            ['apellido', 'string']

        ];
    }

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
            'id_proceso' => 'Departamento/Proceso',
            'id_supervisor' => 'Supervisor',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'password_repeat' => 'Repita Contraseña',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        if ($this->validate()) {
            $user = new User();
            $user->nombre = $this->nombre;
            $user->apellido = $this->apellido;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->cedula = $this->cedula;
            $user->id_division = $this->id_division;
            $user->id_proceso = $this->id_proceso;
            $user->id_supervisor = $this->id_supervisor;
            $user->telefono = $this->telefono;
            $user->status =10;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            
            return $user->save();
        }

        return null;
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
    public function getEmpresas()
    {
        $datos = Empresa::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getAplicaciones()
    {
        $datos = AplicacionesDb::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getDistritos()
    {
        $datos = Distrito::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getProcesos()
    {
        $datos = Proceso::find()->asArray()->all();
        return ArrayHelper::map($datos, 'id', 'nombre');
    }
    public function getSupervisores()
    {
        $datos = User::find()
        ->asArray()
        ->andWhere(['or',
            ['rol_id' => 4],
            ['rol_id' => 5]
        ])
        ->andWhere(['and',
            ['status' => 10],
        ])
        ->orderBy([
            'username' => SORT_ASC //specify sort order ASC for ascending DESC for descending      
            ])
        ->all();
        return ArrayHelper::map($datos, 'id', 'username');
    }

}
