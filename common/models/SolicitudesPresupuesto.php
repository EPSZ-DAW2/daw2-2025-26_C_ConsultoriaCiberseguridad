<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "solicitudes_presupuesto".
 *
 * @property int $id
 * @property int|null $servicio_id Servicio de interés (FK a servicios), NULL si es consulta general
 * @property string $nombre_contacto Nombre completo
 * @property string $email_contacto Email para responder
 * @property string|null $telefono_contacto Teléfono (opcional)
 * @property string $empresa Nombre de la empresa
 * @property string|null $nif_cif NIF/CIF fiscal (opcional)
 * @property int|null $num_empleados Tamaño de la empresa
 * @property string|null $sector_actividad Sector (ej: Banca, Salud, Industrial)
 * @property string $descripcion_necesidad Qué necesita el cliente
 * @property string|null $alcance_solicitado Alcance específico (opcional)
 * @property float|null $presupuesto_estimado Presupuesto máximo del cliente (opcional)
 * @property string|null $fecha_inicio_deseada Cuándo desea empezar
 * @property string $estado_solicitud Estado del proceso comercial
 * @property int $prioridad Prioridad: 1=Baja, 2=Media, 3=Alta, 4=Urgente
 * @property string $fecha_solicitud Cuándo se recibió
 * @property string|null $fecha_contacto Cuándo se contactó al cliente
 * @property int|null $usuario_asignado_id Usuario de ventas asignado (FK a usuarios)
 * @property string|null $notas_comerciales Notas del equipo de ventas
 * @property string $origen_solicitud Origen: Web, Teléfono, Email, Referido, Evento
 *
 * @property Servicios $servicio
 * @property Usuarios $usuarioAsignado
 */
class SolicitudesPresupuesto extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_SOLICITUD_PENDIENTE = 'Pendiente';
    const ESTADO_SOLICITUD_EN_REVISION = 'En Revisión';
    const ESTADO_SOLICITUD_CONTACTADO = 'Contactado';
    const ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO = 'Presupuesto Enviado';
    const ESTADO_SOLICITUD_NEGOCIACION = 'Negociación';
    const ESTADO_SOLICITUD_CONTRATADO = 'Contratado';
    const ESTADO_SOLICITUD_RECHAZADO = 'Rechazado';
    const ESTADO_SOLICITUD_CANCELADO = 'Cancelado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitudes_presupuesto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['servicio_id', 'telefono_contacto', 'nif_cif', 'num_empleados', 'sector_actividad', 'alcance_solicitado', 'presupuesto_estimado', 'fecha_inicio_deseada', 'fecha_contacto', 'usuario_asignado_id', 'notas_comerciales'], 'default', 'value' => null],
            [['estado_solicitud'], 'default', 'value' => 'Pendiente'],
            [['prioridad'], 'default', 'value' => 1],
            [['origen_solicitud'], 'default', 'value' => 'Web'],
            [['servicio_id', 'num_empleados', 'prioridad', 'usuario_asignado_id'], 'integer'],
            [['nombre_contacto', 'email_contacto', 'empresa', 'descripcion_necesidad'], 'required'],
            [['descripcion_necesidad', 'alcance_solicitado', 'estado_solicitud', 'notas_comerciales'], 'string'],
            [['presupuesto_estimado'], 'number'],
            [['fecha_inicio_deseada', 'fecha_solicitud', 'fecha_contacto'], 'safe'],
            [['nombre_contacto'], 'string', 'max' => 150],
            [['email_contacto'], 'string', 'max' => 255],
            [['telefono_contacto', 'nif_cif'], 'string', 'max' => 20],
            [['empresa'], 'string', 'max' => 200],
            [['sector_actividad'], 'string', 'max' => 100],
            [['origen_solicitud'], 'string', 'max' => 50],
            ['estado_solicitud', 'in', 'range' => array_keys(self::optsEstadoSolicitud())],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::class, 'targetAttribute' => ['servicio_id' => 'id']],
            [['usuario_asignado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_asignado_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicio_id' => 'Servicio ID',
            'nombre_contacto' => 'Nombre Contacto',
            'email_contacto' => 'Email Contacto',
            'telefono_contacto' => 'Telefono Contacto',
            'empresa' => 'Empresa',
            'nif_cif' => 'Nif Cif',
            'num_empleados' => 'Num Empleados',
            'sector_actividad' => 'Sector Actividad',
            'descripcion_necesidad' => 'Descripcion Necesidad',
            'alcance_solicitado' => 'Alcance Solicitado',
            'presupuesto_estimado' => 'Presupuesto Estimado',
            'fecha_inicio_deseada' => 'Fecha Inicio Deseada',
            'estado_solicitud' => 'Estado Solicitud',
            'prioridad' => 'Prioridad',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_contacto' => 'Fecha Contacto',
            'usuario_asignado_id' => 'Usuario Asignado ID',
            'notas_comerciales' => 'Notas Comerciales',
            'origen_solicitud' => 'Origen Solicitud',
        ];
    }

    /**
     * Gets query for [[Servicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::class, ['id' => 'servicio_id']);
    }

    /**
     * Gets query for [[UsuarioAsignado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAsignado()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_asignado_id']);
    }


    /**
     * column estado_solicitud ENUM value labels
     * @return string[]
     */
    public static function optsEstadoSolicitud()
    {
        return [
            self::ESTADO_SOLICITUD_PENDIENTE => 'Pendiente',
            self::ESTADO_SOLICITUD_EN_REVISION => 'En Revisión',
            self::ESTADO_SOLICITUD_CONTACTADO => 'Contactado',
            self::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO => 'Presupuesto Enviado',
            self::ESTADO_SOLICITUD_NEGOCIACION => 'Negociación',
            self::ESTADO_SOLICITUD_CONTRATADO => 'Contratado',
            self::ESTADO_SOLICITUD_RECHAZADO => 'Rechazado',
            self::ESTADO_SOLICITUD_CANCELADO => 'Cancelado',
        ];
    }

    /**
     * @return string
     */
    public function displayEstadoSolicitud()
    {
        return self::optsEstadoSolicitud()[$this->estado_solicitud];
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudPendiente()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_PENDIENTE;
    }

    public function setEstadoSolicitudToPendiente()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_PENDIENTE;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudEnRevision()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_EN_REVISION;
    }

    public function setEstadoSolicitudToEnRevision()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_EN_REVISION;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudContactado()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_CONTACTADO;
    }

    public function setEstadoSolicitudToContactado()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_CONTACTADO;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudPresupuestoEnviado()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO;
    }

    public function setEstadoSolicitudToPresupuestoEnviado()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudNegociacion()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_NEGOCIACION;
    }

    public function setEstadoSolicitudToNegociacion()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_NEGOCIACION;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudContratado()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_CONTRATADO;
    }

    public function setEstadoSolicitudToContratado()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_CONTRATADO;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudRechazado()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_RECHAZADO;
    }

    public function setEstadoSolicitudToRechazado()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_RECHAZADO;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudCancelado()
    {
        return $this->estado_solicitud === self::ESTADO_SOLICITUD_CANCELADO;
    }

    public function setEstadoSolicitudToCancelado()
    {
        $this->estado_solicitud = self::ESTADO_SOLICITUD_CANCELADO;
    }
}
