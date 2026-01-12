<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use PragmaRX\Google2FA\Google2FA;

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
 * @property string|null $verification_token
 * @property string|null $password_reset_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    // Definimos los estados según tu base de datos (0 y 1)
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 0;
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
     * Get primary role from RBAC system
     * @return string|null
     */
    public function getRoleName()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        $rolePriority = [
            'admin', 'manager', 'comercial', 'consultor',
            'auditor', 'analista_soc', 'cliente_admin', 'cliente_user'
        ];

        foreach ($rolePriority as $role) {
            if (isset($roles[$role])) {
                return $role;
            }
        }
        return null;
    }

    /**
     * Check if user has specific RBAC role
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        return isset($roles[$roleName]);
    }

    /**
     * Get all RBAC roles for user
     * @return array
     */
    public function getAllRoles()
    {
        return array_keys(Yii::$app->authManager->getRolesByUser($this->id));
    }

    /**
     * Filter query by RBAC role(s)
     * @param \yii\db\ActiveQuery $query
     * @param string|array $roles Role name(s) to filter by
     * @return \yii\db\ActiveQuery
     */
    public static function byRole($query, $roles)
    {
        $roles = (array)$roles;
        $userIds = [];

        $auth = Yii::$app->authManager;
        foreach ($roles as $roleName) {
            $roleUserIds = $auth->getUserIdsByRole($roleName);
            $userIds = array_merge($userIds, $roleUserIds);
        }

        $userIds = array_unique($userIds);

        if (empty($userIds)) {
            // Return empty query
            return $query->where('1=0');
        }

        return $query->where(['id' => $userIds]);
    }

    /**
     * @return bool Si el usuario debe acceder al backend
     */
    public function isBackendUser()
    {
        $backendRoles = [
            self::ROL_ADMIN,
            self::ROL_MANAGER,
            self::ROL_CONSULTOR,
            self::ROL_AUDITOR,
            self::ROL_COMERCIAL,
            self::ROL_ANALISTA_SOC
        ];
        return !empty(array_intersect($this->getAllRoles(), $backendRoles));
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
        return new Google2FA();
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

    /**
     * Comprueba si el usuario tiene contratado un servicio de cierta categoría
     * @param string|array $categoria Categoría(s) a verificar (ej: 'Defensa', ['Gobernanza', 'Auditoría'])
     * @return bool
     */
    public function hasContratoActivo($categoria)
    {
        // Si el usuario es el propio dueño de la plataforma o admin total, quizas dar acceso total?
        // De momento lo ceñimos a contratos reales.
        
        $categorias = (array)$categoria;
        
        // Buscamos proyectos donde:
        // 1. El cliente sea este usuario (o su empresa, si quisieramos extenderlo a nivel empresa)
        // 2. El estado no sea Cancelado/Suspendido
        // 3. El servicio asociado sea de la categoría requerida
        
        // Si queremos nivel EMPRESA (si uno compra, todos tienen):
        // $userIds = User::find()->select('id')->where(['empresa' => $this->empresa])->column();
        // Pero el requerimiento dice "vinculando el id_cliente". Lo haremos personal o por empresa segun rol?
        // Asumiremos PERSONAL por 'cliente_id' del proyecto, pero si el admin compra, ¿los users acceden?
        // REQUERIMIENTO: "Vinculando el id_cliente"... "Si hay un registro... el módulo se abre"
        // Para simplificar y cumplir con la lógica anterior de que 'cliente_admin' gestiona, 
        // asumiremos que si la EMPRESA tiene contrato, los empleados acceden.
        
        $query = \common\models\Proyectos::find()
            ->alias('p')
            ->joinWith(['servicio' => function ($q) {
                $q->alias('s');
            }])
            ->where(['s.categoria' => $categorias])
            ->andWhere(['NOT IN', 'p.estado', [\common\models\Proyectos::ESTADO_CANCELADO, \common\models\Proyectos::ESTADO_SUSPENDIDO]]);
            
        // Si tiene empresa, verificamos proyectos de cualquiera de la empresa (o al menos del admin de esa empresa)
        if (!empty($this->empresa)) {
            // Buscamos usuarios de la misma empresa
            $userIds = User::find()->select('id')->where(['empresa' => $this->empresa])->column();
            $query->andWhere(['p.cliente_id' => $userIds]);
        } else {
            // Si no tiene empresa (ej. particular), solo su ID
            $query->andWhere(['p.cliente_id' => $this->id]);
        }
            
        return $query->exists();
    }
}