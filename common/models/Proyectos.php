<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyectos".
 *
 * @property int $id
 * @property string $nombre Nombre descriptivo (ej: "Implantación ENS para Empresa X")
 * @property string|null $descripcion Descripción detallada del alcance
 * @property int $cliente_id ID del cliente que contrató (FK a usuarios con rol=cliente)
 * @property int $servicio_id ID del servicio contratado (FK a servicios)
 * @property int|null $consultor_id ID del consultor asignado (FK a usuarios con rol=consultor)
 * @property int|null $auditor_id ID del auditor asignado (FK a usuarios con rol=auditor)
 * @property string $fecha_inicio Fecha de inicio del proyecto
 * @property string|null $fecha_fin_prevista Fecha estimada de finalización
 * @property string|null $fecha_fin_real Fecha real de cierre (NULL si no ha finalizado)
 * @property string $estado Estado actual del proyecto
 * @property float|null $presupuesto Presupuesto acordado en euros
 * @property string|null $notas_internas Notas del equipo (no visibles para el cliente)
 * @property int|null $creado_por Quién creó el proyecto
 * @property string $fecha_creacion
 * @property int|null $modificado_por Quién lo modificó por última vez
 * @property string|null $fecha_modificacion
 *
 * @property Usuarios $auditor
 * @property Usuarios $cliente
 * @property Usuarios $consultor
 * @property Usuarios $creadoPor
 * @property Documentos[] $documentos
 * @property EventosCalendario[] $eventosCalendarios
 * @property Usuarios $modificadoPor
 * @property Servicios $servicio
 */
class Proyectos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_PLANIFICACION = 'Planificación';
    const ESTADO_EN_CURSO = 'En curso';
    const ESTADO_EN_REVISION = 'En revisión';
    const ESTADO_FINALIZADO = 'Finalizado';
    const ESTADO_CANCELADO = 'Cancelado';
    const ESTADO_SUSPENDIDO = 'Suspendido';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'consultor_id', 'auditor_id', 'fecha_fin_prevista', 'fecha_fin_real', 'presupuesto', 'notas_internas', 'creado_por', 'modificado_por', 'fecha_modificacion'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'Planificación'],
            [['nombre', 'cliente_id', 'servicio_id', 'fecha_inicio'], 'required'],
            [['descripcion', 'estado', 'notas_internas'], 'string'],
            [['cliente_id', 'servicio_id', 'consultor_id', 'auditor_id', 'creado_por', 'modificado_por'], 'integer'],
            [['fecha_inicio', 'fecha_fin_prevista', 'fecha_fin_real', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['presupuesto'], 'number'],
            [['nombre'], 'string', 'max' => 250],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['auditor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['auditor_id' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['consultor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['consultor_id' => 'id']],
            [['creado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['creado_por' => 'id']],
            [['modificado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['modificado_por' => 'id']],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::class, 'targetAttribute' => ['servicio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'cliente_id' => 'Cliente',
            'servicio_id' => 'Servicio',
            'consultor_id' => 'Consultor',
            'auditor_id' => 'Auditor',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin_prevista' => 'Fecha Fin Prevista',
            'fecha_fin_real' => 'Fecha Fin Real',
            'estado' => 'Estado',
            'presupuesto' => 'Presupuesto',
            'notas_internas' => 'Notas Internas',
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
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Consultor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultor()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'consultor_id']);
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
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documentos::class, ['proyecto_id' => 'id']);
    }

    /**
     * Gets query for [[EventosCalendarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventosCalendarios()
    {
        return $this->hasMany(EventosCalendario::class, ['proyecto_id' => 'id']);
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
     * Gets query for [[Servicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicios::class, ['id' => 'servicio_id']);
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_PLANIFICACION => 'Planificación',
            self::ESTADO_EN_CURSO => 'En curso',
            self::ESTADO_EN_REVISION => 'En revisión',
            self::ESTADO_FINALIZADO => 'Finalizado',
            self::ESTADO_CANCELADO => 'Cancelado',
            self::ESTADO_SUSPENDIDO => 'Suspendido',
        ];
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoPlanificacion()
    {
        return $this->estado === self::ESTADO_PLANIFICACION;
    }

    public function setEstadoToPlanificacion()
    {
        $this->estado = self::ESTADO_PLANIFICACION;
    }

    /**
     * @return bool
     */
    public function isEstadoEnCurso()
    {
        return $this->estado === self::ESTADO_EN_CURSO;
    }

    public function setEstadoToEnCurso()
    {
        $this->estado = self::ESTADO_EN_CURSO;
    }

    /**
     * @return bool
     */
    public function isEstadoEnRevision()
    {
        return $this->estado === self::ESTADO_EN_REVISION;
    }

    public function setEstadoToEnRevision()
    {
        $this->estado = self::ESTADO_EN_REVISION;
    }

    /**
     * @return bool
     */
    public function isEstadoFinalizado()
    {
        return $this->estado === self::ESTADO_FINALIZADO;
    }

    public function setEstadoToFinalizado()
    {
        $this->estado = self::ESTADO_FINALIZADO;
    }

    /**
     * @return bool
     */
    public function isEstadoCancelado()
    {
        return $this->estado === self::ESTADO_CANCELADO;
    }

    public function setEstadoToCancelado()
    {
        $this->estado = self::ESTADO_CANCELADO;
    }

    /**
     * @return bool
     */
    public function isEstadoSuspendido()
    {
        return $this->estado === self::ESTADO_SUSPENDIDO;
    }

    public function setEstadoToSuspendido()
    {
        $this->estado = self::ESTADO_SUSPENDIDO;
    }
}
