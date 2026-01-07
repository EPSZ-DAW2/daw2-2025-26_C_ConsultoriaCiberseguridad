<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $email Correo electrónico único del usuario
 * @property string $password Hash de la contraseña (usar bcrypt/Argon2)
 * @property string $nombre Nombre del usuario
 * @property string|null $apellidos Apellidos del usuario
 * @property string $rol Rol del usuario en el sistema RBAC
 * @property string|null $empresa Nombre de la empresa (solo para clientes)
 * @property string|null $telefono Teléfono de contacto
 * @property string|null $direccion Dirección completa
 * @property string $fecha_registro Fecha de alta en el sistema
 * @property string|null $ultimo_acceso Última vez que inició sesión
 * @property int $intentos_acceso Contador de intentos fallidos de login
 * @property int $bloqueado Si está bloqueado: 0=No, 1=Por intentos fallidos, 2=Por administrador
 * @property string|null $fecha_bloqueo Cuándo se bloqueó la cuenta
 * @property string|null $motivo_bloqueo Razón del bloqueo
 * @property int $activo Usuario activo: 0=Inactivo, 1=Activo
 * @property string $auth_key
 *
 * @property Cursos[] $cursos
 * @property Cursos[] $cursos0
 * @property Cursos[] $cursos1
 * @property Diapositivas[] $diapositivas
 * @property Diapositivas[] $diapositivas0
 * @property Documentos[] $documentos
 * @property EventosCalendario[] $eventosCalendarios
 * @property EventosCalendario[] $eventosCalendarios0
 * @property EventosCalendario[] $eventosCalendarios1
 * @property Incidencias[] $incidencias
 * @property Incidencias[] $incidencias0
 * @property PreguntasCuestionario[] $preguntasCuestionarios
 * @property PreguntasCuestionario[] $preguntasCuestionarios0
 * @property ProgresoUsuario[] $progresoUsuarios
 * @property Proyectos[] $proyectos
 * @property Proyectos[] $proyectos0
 * @property Proyectos[] $proyectos1
 * @property Proyectos[] $proyectos2
 * @property Proyectos[] $proyectos3
 * @property Servicios[] $servicios
 * @property Servicios[] $servicios0
 * @property SolicitudesPresupuesto[] $solicitudesPresupuestos
 */
class Usuarios extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ROL_INVITADO = 'invitado';
    const ROL_CLIENTE_USER = 'cliente_user';
    const ROL_CLIENTE_ADMIN = 'cliente_admin';
    const ROL_CONSULTOR = 'consultor';
    const ROL_AUDITOR = 'auditor';
    const ROL_ANALISTA_SOC = 'analista_soc';
    const ROL_MANAGER = 'manager';
    const ROL_COMERCIAL = 'comercial';
    const ROL_ADMIN = 'admin';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apellidos', 'empresa', 'telefono', 'direccion', 'ultimo_acceso', 'fecha_bloqueo', 'motivo_bloqueo'], 'default', 'value' => null],
            [['rol'], 'default', 'value' => 'invitado'],
            [['bloqueado'], 'default', 'value' => 0],
            [['activo'], 'default', 'value' => 1],
            [['auth_key'], 'default', 'value' => ''],
            [['email', 'password', 'nombre'], 'required'],
            [['rol', 'direccion', 'motivo_bloqueo'], 'string'],
            [['fecha_registro', 'ultimo_acceso', 'fecha_bloqueo'], 'safe'],
            [['intentos_acceso', 'bloqueado', 'activo'], 'integer'],
            [['email', 'password'], 'string', 'max' => 255],
            [['nombre'], 'string', 'max' => 100],
            [['apellidos'], 'string', 'max' => 150],
            [['empresa'], 'string', 'max' => 200],
            [['telefono'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            ['rol', 'in', 'range' => array_keys(self::optsRol())],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'rol' => 'Rol',
            'empresa' => 'Empresa',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'fecha_registro' => 'Fecha Registro',
            'ultimo_acceso' => 'Ultimo Acceso',
            'intentos_acceso' => 'Intentos Acceso',
            'bloqueado' => 'Bloqueado',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'motivo_bloqueo' => 'Motivo Bloqueo',
            'activo' => 'Activo',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Cursos::class, ['creado_por' => 'id']);
    }

    /**
     * Gets query for [[Cursos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos0()
    {
        return $this->hasMany(Cursos::class, ['modificado_por' => 'id']);
    }

    /**
     * Gets query for [[Cursos1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos1()
    {
        return $this->hasMany(Cursos::class, ['id' => 'curso_id'])->viaTable('progreso_usuario', ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Diapositivas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiapositivas()
    {
        return $this->hasMany(Diapositivas::class, ['creado_por' => 'id']);
    }

    /**
     * Gets query for [[Diapositivas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiapositivas0()
    {
        return $this->hasMany(Diapositivas::class, ['modificado_por' => 'id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::class, ['subido_por' => 'id']);
    }

    /**
     * Gets query for [[EventosCalendarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventosCalendarios()
    {
        return $this->hasMany(EventosCalendario::class, ['auditor_id' => 'id']);
    }

    /**
     * Gets query for [[EventosCalendarios0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventosCalendarios0()
    {
        return $this->hasMany(EventosCalendario::class, ['creado_por' => 'id']);
    }

    /**
     * Gets query for [[EventosCalendarios1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventosCalendarios1()
    {
        return $this->hasMany(EventosCalendario::class, ['modificado_por' => 'id']);
    }

    /**
     * Gets query for [[Incidencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidencias()
    {
        return $this->hasMany(Incidencias::class, ['analista_id' => 'id']);
    }

    /**
     * Gets query for [[Incidencias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidencias0()
    {
        return $this->hasMany(Incidencias::class, ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[PreguntasCuestionarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntasCuestionarios()
    {
        return $this->hasMany(PreguntasCuestionario::class, ['creado_por' => 'id']);
    }

    /**
     * Gets query for [[PreguntasCuestionarios0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntasCuestionarios0()
    {
        return $this->hasMany(PreguntasCuestionario::class, ['modificado_por' => 'id']);
    }

    /**
     * Gets query for [[ProgresoUsuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgresoUsuarios()
    {
        return $this->hasMany(ProgresoUsuario::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::class, ['auditor_id' => 'id']);
    }

    /**
     * Gets query for [[Proyectos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos0()
    {
        return $this->hasMany(Proyectos::class, ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[Proyectos1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos1()
    {
        return $this->hasMany(Proyectos::class, ['consultor_id' => 'id']);
    }

    /**
     * Gets query for [[Proyectos2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos2()
    {
        return $this->hasMany(Proyectos::class, ['creado_por' => 'id']);
    }

    /**
     * Gets query for [[Proyectos3]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos3()
    {
        return $this->hasMany(Proyectos::class, ['modificado_por' => 'id']);
    }

    /**
     * Gets query for [[Servicios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicios::class, ['creado_por' => 'id']);
    }

    /**
     * Gets query for [[Servicios0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicios0()
    {
        return $this->hasMany(Servicios::class, ['modificado_por' => 'id']);
    }

    /**
     * Gets query for [[SolicitudesPresupuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudesPresupuestos()
    {
        return $this->hasMany(SolicitudesPresupuesto::class, ['usuario_asignado_id' => 'id']);
    }


    /**
     * column rol ENUM value labels
     * @return string[]
     */
    public static function optsRol()
    {
        return [
            self::ROL_INVITADO => 'invitado',
            self::ROL_CLIENTE_USER => 'cliente_user',
            self::ROL_CLIENTE_ADMIN => 'cliente_admin',
            self::ROL_CONSULTOR => 'consultor',
            self::ROL_AUDITOR => 'auditor',
            self::ROL_ANALISTA_SOC => 'analista_soc',
            self::ROL_MANAGER => 'manager',
            self::ROL_COMERCIAL => 'comercial',
            self::ROL_ADMIN => 'admin',
        ];
    }

    /**
     * @return string
     */
    public function displayRol()
    {
        return self::optsRol()[$this->rol];
    }

    /**
     * @return bool
     */
    public function isRolInvitado()
    {
        return $this->rol === self::ROL_INVITADO;
    }

    public function setRolToInvitado()
    {
        $this->rol = self::ROL_INVITADO;
    }

    /**
     * @return bool
     */
    public function isRolCliente()
    {
        return $this->rol === self::ROL_CLIENTE;
    }

    public function setRolToCliente()
    {
        $this->rol = self::ROL_CLIENTE;
    }

    /**
     * @return bool
     */
    public function isRolConsultor()
    {
        return $this->rol === self::ROL_CONSULTOR;
    }

    public function setRolToConsultor()
    {
        $this->rol = self::ROL_CONSULTOR;
    }

    /**
     * @return bool
     */
    public function isRolAuditor()
    {
        return $this->rol === self::ROL_AUDITOR;
    }

    public function setRolToAuditor()
    {
        $this->rol = self::ROL_AUDITOR;
    }

    /**
     * @return bool
     */
    public function isRolAnalistasoc()
    {
        return $this->rol === self::ROL_ANALISTA_SOC;
    }

    public function setRolToAnalistasoc()
    {
        $this->rol = self::ROL_ANALISTA_SOC;
    }

    /**
     * @return bool
     */
    public function isRolAdmin()
    {
        return $this->rol === self::ROL_ADMIN;
    }

    public function setRolToAdmin()
    {
        $this->rol = self::ROL_ADMIN;
    }
}
