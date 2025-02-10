<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user".
 * @return \yii\db\ActiveRelation
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
 * @property integer $id_supervisor
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $telefono
 * @property integer $id_division
 * @property string $nombreCompleto
 * @property AplicacionUsuario[] $aplicacionUsuarios
 * @property AplicacionesDb[] $idAplicacions
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public $password;
    public $password_repeat;
    public $aplicaciones;
   // public $nombreCompleto;
    /**
     * @inheritdoc
     */
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

                ['apellido', 'required','message' => 'No puede estar en blanco.'],
                ['apellido', 'string'],

                ['aplicaciones', 'safe'],

                ['nombreCompleto','safe']
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
            'Id_supervisor' => 'Indicador de Supervisor',
            'id_division' => 'Division',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'id_Proceso' => 'Departamento/Proceso',
            'password_repeat' => 'Repita Contraseña',
        ];
    }

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

    public function actualizar()
    {
        $user = new User();
            $user->nombre = $this->nombre;
            $user->apellido = $this->apellido;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->cedula = $this->cedula;
            $user->id_supervisor = $this->id_supervisor;
            $user->id_division = $this->id_division;
            $user->id_proceso = $this->id_proceso;
            $user->telefono = $this->telefono;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
                echo "<script>console.log('Debug save: entré en if de save' );</script>";
                return $user;
        if ($this->validate()) {
            $user = new User();
            $user->nombre = $this->nombre;
            $user->apellido = $this->apellido;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->cedula = $this->cedula;
            $user->id_supervisor = $this->id_supervisor;
            $user->id_division = $this->id_division;
            $user->id_proceso = $this->id_proceso;
            $user->telefono = $this->telefono;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
                echo "<script>console.log('Debug save: entré en if de save' );</script>";
                return $user;
            
        }

        return null;
    }
    public function setPassword()
    {
        
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        echo "<script>console.log('Debug password: " . $this->password . "' );</script>";
        echo "<script>console.log('Debug password_hash: " . $this->password_hash . "' );</script>";
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
        echo "<script>console.log('Debug auth_key: " . $this->auth_key . "' );</script>";
    }
    public function getAplicacionUsuario()
    {
        return $this->hasMany(AplicacionUsuario::className(), ['id_usuario' => 'id']);
    }


    public function getAplicacionesPermitidasList()
    {
        return $this->getAplicacionesPermitidas()->asArray();
    }
    public function afterSave($insert, $changedAttributes){
        \Yii::$app->db->createCommand()->delete('aplicacion_usuario', 'id_usuario = '.(int) $this->id)->execute();

        foreach ($this->aplicaciones as $id) {
            $usrapp = new AplicacionUsuario();
            $usrapp->id_usuario = $this->id;
            $usrapp->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
