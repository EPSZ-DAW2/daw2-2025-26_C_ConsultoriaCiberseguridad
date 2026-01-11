<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "eventos_calendario".
 *
 * @property int $id
 * @property int $proyecto_id Proyecto relacionado (FK a proyectos)
 * @property int|null $auditor_id Auditor responsable (FK a usuarios con rol=auditor)
 * @property string $titulo Título del evento (ej: "Auditoría ISO 27001 - Fase 1")
 * @property string|null $descripcion Descripción detallada
 * @property string $fecha Fecha del evento
 * @property string $hora_inicio Hora de inicio
 * @property string|null $hora_fin Hora de finalización (puede no estar definida)
 * @property string $tipo_evento Tipo de evento
 * @property string|null $ubicacion Lugar (dirección o "Virtual - Zoom")
 * @property string $estado_evento Estado actual
 * @property int $recordatorio_enviado Si ya se envió recordatorio: 0=No, 1=Sí
 * @property string|null $notas Notas adicionales
 * @property int|null $creado_por Quién creó el evento
 * @property string $fecha_creacion
 * @property int|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Usuarios $auditor
 * @property Usuarios $creadoPor
 * @property Usuarios $modificadoPor
 * @property Proyectos $proyecto
 */
class EventosCalendario extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_EVENTO_AUDITORIA_INTERNA = 'Auditoría Interna';
    const TIPO_EVENTO_AUDITORIA_DE_CERTIFICACION = 'Auditoría de Certificación';
    const TIPO_EVENTO_AUDITORIA_DE_SEGUIMIENTO = 'Auditoría de Seguimiento';
    const TIPO_EVENTO_REUNION_CLIENTE = 'Reunión Cliente';
    const TIPO_EVENTO_REVISION_DOCUMENTAL = 'Revisión Documental';
    const TIPO_EVENTO_ENTREGA_RESULTADOS = 'Entrega Resultados';
    const TIPO_EVENTO_OTROS = 'Otros';
    const ESTADO_EVENTO_PROGRAMADO = 'Programado';
    const ESTADO_EVENTO_CONFIRMADO = 'Confirmado';
    const ESTADO_EVENTO_EN_CURSO = 'En curso';
    const ESTADO_EVENTO_COMPLETADO = 'Completado';
    const ESTADO_EVENTO_POSPUESTO = 'Pospuesto';
    const ESTADO_EVENTO_CANCELADO = 'Cancelado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos_calendario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auditor_id', 'descripcion', 'hora_fin', 'ubicacion', 'notas', 'creado_por', 'modificado_por', 'fecha_modificacion'], 'default', 'value' => null],
            [['tipo_evento'], 'default', 'value' => 'Otros'],
            [['estado_evento'], 'default', 'value' => 'Programado'],
            [['recordatorio_enviado'], 'default', 'value' => 0],
            [['proyecto_id', 'titulo', 'fecha', 'hora_inicio'], 'required'],
            [['proyecto_id', 'auditor_id', 'recordatorio_enviado', 'creado_por', 'modificado_por'], 'integer'],
            [['descripcion', 'tipo_evento', 'estado_evento', 'notas'], 'string'],
            [['fecha', 'hora_inicio', 'hora_fin', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['titulo'], 'string', 'max' => 200],
            [['ubicacion'], 'string', 'max' => 255],
            ['tipo_evento', 'in', 'range' => array_keys(self::optsTipoEvento())],
            ['estado_evento', 'in', 'range' => array_keys(self::optsEstadoEvento())],
            [['auditor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['auditor_id' => 'id']],
            [['creado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['creado_por' => 'id']],
            [['modificado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['modificado_por' => 'id']],
            [['proyecto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proyectos::class, 'targetAttribute' => ['proyecto_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'fecha_creacion',
                'updatedAtAttribute' => 'fecha_modificacion',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::class,
                'createdByAttribute' => 'creado_por',
                'updatedByAttribute' => 'modificado_por',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proyecto_id' => 'Proyecto',
            'auditor_id' => 'Auditor',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'tipo_evento' => 'Tipo Evento',
            'ubicacion' => 'Ubicacion',
            'estado_evento' => 'Estado Evento',
            'recordatorio_enviado' => 'Recordatorio Enviado',
            'notas' => 'Notas',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * Gets query for [[Auditor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuditor()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'auditor_id']);
    }

    /**
     * Gets query for [[CreadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreadoPor()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'creado_por']);
    }

    /**
     * Gets query for [[ModificadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModificadoPor()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'modificado_por']);
    }

    /**
     * Gets query for [[Proyecto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyectos::class, ['id' => 'proyecto_id']);
    }


    /**
     * column tipo_evento ENUM value labels
     * @return string[]
     */
    public static function optsTipoEvento()
    {
        return [
            self::TIPO_EVENTO_AUDITORIA_INTERNA => 'Auditoría Interna',
            self::TIPO_EVENTO_AUDITORIA_DE_CERTIFICACION => 'Auditoría de Certificación',
            self::TIPO_EVENTO_AUDITORIA_DE_SEGUIMIENTO => 'Auditoría de Seguimiento',
            self::TIPO_EVENTO_REUNION_CLIENTE => 'Reunión Cliente',
            self::TIPO_EVENTO_REVISION_DOCUMENTAL => 'Revisión Documental',
            self::TIPO_EVENTO_ENTREGA_RESULTADOS => 'Entrega Resultados',
            self::TIPO_EVENTO_OTROS => 'Otros',
        ];
    }

    /**
     * column estado_evento ENUM value labels
     * @return string[]
     */
    public static function optsEstadoEvento()
    {
        return [
            self::ESTADO_EVENTO_PROGRAMADO => 'Programado',
            self::ESTADO_EVENTO_CONFIRMADO => 'Confirmado',
            self::ESTADO_EVENTO_EN_CURSO => 'En curso',
            self::ESTADO_EVENTO_COMPLETADO => 'Completado',
            self::ESTADO_EVENTO_POSPUESTO => 'Pospuesto',
            self::ESTADO_EVENTO_CANCELADO => 'Cancelado',
        ];
    }

    /**
     * @return string
     */
    public function displayTipoEvento()
    {
        return self::optsTipoEvento()[$this->tipo_evento];
    }

    /**
     * @return bool
     */
    public function isTipoEventoAuditoriaInterna()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_AUDITORIA_INTERNA;
    }

    public function setTipoEventoToAuditoriaInterna()
    {
        $this->tipo_evento = self::TIPO_EVENTO_AUDITORIA_INTERNA;
    }

    /**
     * @return bool
     */
    public function isTipoEventoAuditoriaDeCertificacion()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_AUDITORIA_DE_CERTIFICACION;
    }

    public function setTipoEventoToAuditoriaDeCertificacion()
    {
        $this->tipo_evento = self::TIPO_EVENTO_AUDITORIA_DE_CERTIFICACION;
    }

    /**
     * @return bool
     */
    public function isTipoEventoAuditoriaDeSeguimiento()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_AUDITORIA_DE_SEGUIMIENTO;
    }

    public function setTipoEventoToAuditoriaDeSeguimiento()
    {
        $this->tipo_evento = self::TIPO_EVENTO_AUDITORIA_DE_SEGUIMIENTO;
    }

    /**
     * @return bool
     */
    public function isTipoEventoReunionCliente()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_REUNION_CLIENTE;
    }

    public function setTipoEventoToReunionCliente()
    {
        $this->tipo_evento = self::TIPO_EVENTO_REUNION_CLIENTE;
    }

    /**
     * @return bool
     */
    public function isTipoEventoRevisionDocumental()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_REVISION_DOCUMENTAL;
    }

    public function setTipoEventoToRevisionDocumental()
    {
        $this->tipo_evento = self::TIPO_EVENTO_REVISION_DOCUMENTAL;
    }

    /**
     * @return bool
     */
    public function isTipoEventoEntregaResultados()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_ENTREGA_RESULTADOS;
    }

    public function setTipoEventoToEntregaResultados()
    {
        $this->tipo_evento = self::TIPO_EVENTO_ENTREGA_RESULTADOS;
    }

    /**
     * @return bool
     */
    public function isTipoEventoOtros()
    {
        return $this->tipo_evento === self::TIPO_EVENTO_OTROS;
    }

    public function setTipoEventoToOtros()
    {
        $this->tipo_evento = self::TIPO_EVENTO_OTROS;
    }

    /**
     * @return string
     */
    public function displayEstadoEvento()
    {
        return self::optsEstadoEvento()[$this->estado_evento];
    }

    /**
     * @return bool
     */
    public function isEstadoEventoProgramado()
    {
        return $this->estado_evento === self::ESTADO_EVENTO_PROGRAMADO;
    }

    public function setEstadoEventoToProgramado()
    {
        $this->estado_evento = self::ESTADO_EVENTO_PROGRAMADO;
    }

    /**
     * @return bool
     */
    public function isEstadoEventoConfirmado()
    {
        return $this->estado_evento === self::ESTADO_EVENTO_CONFIRMADO;
    }

    public function setEstadoEventoToConfirmado()
    {
        $this->estado_evento = self::ESTADO_EVENTO_CONFIRMADO;
    }

    /**
     * @return bool
     */
    public function isEstadoEventoEnCurso()
    {
        return $this->estado_evento === self::ESTADO_EVENTO_EN_CURSO;
    }

    public function setEstadoEventoToEnCurso()
    {
        $this->estado_evento = self::ESTADO_EVENTO_EN_CURSO;
    }

    /**
     * @return bool
     */
    public function isEstadoEventoCompletado()
    {
        return $this->estado_evento === self::ESTADO_EVENTO_COMPLETADO;
    }

    public function setEstadoEventoToCompletado()
    {
        $this->estado_evento = self::ESTADO_EVENTO_COMPLETADO;
    }

    /**
     * @return bool
     */
    public function isEstadoEventoPospuesto()
    {
        return $this->estado_evento === self::ESTADO_EVENTO_POSPUESTO;
    }

    public function setEstadoEventoToPospuesto()
    {
        $this->estado_evento = self::ESTADO_EVENTO_POSPUESTO;
    }

    /**
     * @return bool
     */
    public function isEstadoEventoCancelado()
    {
        return $this->estado_evento === self::ESTADO_EVENTO_CANCELADO;
    }

    public function setEstadoEventoToCancelado()
    {
        $this->estado_evento = self::ESTADO_EVENTO_CANCELADO;
    }
}
