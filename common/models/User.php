<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model adaptado a la tabla 'usuarios'
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $password  
 * @property string $auth_key
 * @property integer $activo 
 * @property string $fecha_registro
 * @property string $rol
 * @property string $empresa
 * @property string $telefono

 * @property string $direccion
 * @property string|null $email_recuperacion
 * @property string|null $totp_secret
 * @property integer $totp_activo
 */
class User extends ActiveRecord implements IdentityInterface
{
    // Definimos los estados según tu base de datos (0 y 1)
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    // Roles
    const ROL_ADMIN = 'admin';
    const ROL_CLIENTE_USER = 'cliente_user';
    const ROL_CLIENTE_ADMIN = 'cliente_admin';
    const ROL_MANAGER = 'manager';
    const ROL_CONSULTOR = 'consultor';
    const ROL_AUDITOR = 'auditor';
    const ROL_COMERCIAL = 'comercial';
    const ROL_ANALISTA_SOC = 'analista_soc';

    /**
     * @return bool Si el usuario debe acceder al backend
     */
    public function isBackendUser()
    {
        return in_array($this->rol, [
            self::ROL_ADMIN,
            self::ROL_MANAGER,
            self::ROL_CONSULTOR,
            self::ROL_AUDITOR,
            self::ROL_COMERCIAL,
            self::ROL_ANALISTA_SOC
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usuarios}}';
    }

    /**
     * Quitamos TimestampBehavior porque tu tabla usa 'fecha_registro' manual
     * y no 'created_at' / 'updated_at' automáticos.
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * Reglas de validación adaptadas a tus columnas
     */
    public function rules()
    {
        return [
            ['activo', 'default', 'value' => self::STATUS_ACTIVE],
            ['activo', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['rol', 'empresa', 'telefono', 'direccion'], 'string'],
            [['email_recuperacion'], 'email'],
            [['totp_secret'], 'string'],
            [['totp_activo'], 'integer'],
        ];
    }

    public function getUsername()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // Buscamos por ID y que esté 'activo'
        return static::findOne(['id' => $id, 'activo' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Busca usuario por nombre de usuario (Usaremos el EMAIL como login)
     *
     * @param string $username (En realidad recibiremos el email)
     * @return static|null
     */
    public static function findByUsername($email)
    {
        // Mapeamos: Yii busca 'username', nosotros buscamos en la columna 'email'
        return static::findOne(['email' => $email, 'activo' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'activo' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'activo' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * {@inheritdoc}
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
     * Valida la contraseña
     *
     * @param string $password contraseña a validar
     * @return bool si es válida
     */
    public function validatePassword($password)
    {
        // IMPORTANTE: Usamos $this->password (tu columna) en vez de password_hash
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Genera el hash de la contraseña y lo guarda
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        // IMPORTANTE: Guardamos en 'password'
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Genera la auth_key (necesaria para cookies)
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Instancia de Google2FA
     */
    public function getGoogle2fa()
    {
        return new \PragmaRX\Google2FA\Google2FA();
    }

    /**
     * Valida el código TOTP proporcionado
     */
    public function verifyTotp($code, $secret = null)
    {
        $secret = $secret ?? $this->totp_secret;
        if (!$secret) {
            return false;
        }
        return $this->getGoogle2fa()->verifyKey($secret, $code);
    }
}