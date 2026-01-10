<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "incidencias".
 *
 * @property int $id
 * @property int $cliente_id Cliente que reporta (FK a usuarios con rol=cliente)
 * @property int|null $analista_id Analista SOC asignado (FK a usuarios con rol=analista_soc)
 * @property string $titulo Título breve de la incidencia
 * @property string $descripcion Descripción detallada del problema
 * @property string $severidad Nivel de severidad
 * @property string $estado_incidencia Estado actual
 * @property string|null $categoria_incidencia Categoría (malware, phishing, DDoS, etc.)
 * @property string $fecha_reporte Cuándo se reportó
 * @property string|null $fecha_asignacion Cuándo se asignó a un analista
 * @property string|null $fecha_primera_respuesta Primera respuesta del analista
 * @property string|null $fecha_resolucion Cuándo se resolvió
 * @property int|null $tiempo_resolucion Minutos que tomó resolver (calculado)
 * @property int|null $sla_cumplido Si se cumplió el SLA: 0=No, 1=Sí, NULL=No evaluado
 * @property string|null $ip_origen IP desde donde se detectó (IPv4 o IPv6)
 * @property string|null $sistema_afectado Sistema o servidor afectado
 * @property string|null $acciones_tomadas Descripción de acciones realizadas
 * @property string|null $notas_internas Notas del equipo SOC
 * @property string|null $origen Origen de la incidencia (Manual, Monitorización, etc.)
 * @property int $visible_cliente Si el cliente puede ver esta incidencia: 0=No, 1=Sí
 *
 * @property Usuarios $analista
 * @property Usuarios $cliente
 */
class Incidencias extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const SEVERIDAD_CRITICA = 'Crítica';
    const SEVERIDAD_ALTA = 'Alta';
    const SEVERIDAD_MEDIA = 'Media';
    const SEVERIDAD_BAJA = 'Baja';
    const SEVERIDAD_INFORMATIVA = 'Informativa';
    const ESTADO_INCIDENCIA_ABIERTO = 'Abierto';
    const ESTADO_INCIDENCIA_ASIGNADO = 'Asignado';
    const ESTADO_INCIDENCIA_EN_ANALISIS = 'En Análisis';
    const ESTADO_INCIDENCIA_EN_CONTENCION = 'En Contención';
    const ESTADO_INCIDENCIA_EN_REMEDIACION = 'En Remediación';
    const ESTADO_INCIDENCIA_RESUELTO = 'Resuelto';
    const ESTADO_INCIDENCIA_CERRADO = 'Cerrado';
    const ESTADO_INCIDENCIA_FALSO_POSITIVO = 'Falso Positivo';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incidencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['analista_id', 'categoria_incidencia', 'fecha_asignacion', 'fecha_primera_respuesta', 'fecha_resolucion', 'tiempo_resolucion', 'sla_cumplido', 'ip_origen', 'sistema_afectado', 'acciones_tomadas', 'notas_internas'], 'default', 'value' => null],
            [['severidad'], 'default', 'value' => 'Media'],
            [['estado_incidencia'], 'default', 'value' => 'Abierto'],
            [['visible_cliente'], 'default', 'value' => 1],
            [['cliente_id', 'titulo', 'descripcion'], 'required'],
            [['cliente_id', 'analista_id', 'tiempo_resolucion', 'sla_cumplido', 'visible_cliente'], 'integer'],
            [['descripcion', 'severidad', 'estado_incidencia', 'acciones_tomadas', 'notas_internas'], 'string'],
            [['fecha_reporte', 'fecha_asignacion', 'fecha_primera_respuesta', 'fecha_resolucion'], 'safe'],
            [['titulo', 'sistema_afectado'], 'string', 'max' => 255],
            [['origen'], 'string', 'max' => 100],
            [['categoria_incidencia'], 'string', 'max' => 50],
            [['ip_origen'], 'string', 'max' => 45],
            ['severidad', 'in', 'range' => array_keys(self::optsSeveridad())],
            ['estado_incidencia', 'in', 'range' => array_keys(self::optsEstadoIncidencia())],
            [['analista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['analista_id' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['cliente_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente',
            'analista_id' => 'Analista SOC',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'severidad' => 'Severidad',
            'estado_incidencia' => 'Estado Incidencia',
            'categoria_incidencia' => 'Categoria Incidencia',
            'origen' => 'Origen',
            'fecha_reporte' => 'Fecha Reporte',
            'fecha_asignacion' => 'Fecha Asignacion',
            'fecha_primera_respuesta' => 'Fecha Primera Respuesta',
            'fecha_resolucion' => 'Fecha Resolucion',
            'tiempo_resolucion' => 'Tiempo Resolucion',
            'sla_cumplido' => 'Sla Cumplido',
            'ip_origen' => 'Ip Origen',
            'sistema_afectado' => 'Sistema Afectado',
            'acciones_tomadas' => 'Acciones Tomadas',
            'notas_internas' => 'Notas Internas',
            'visible_cliente' => 'Visible Cliente',
        ];
    }

    /**
     * Gets query for [[Analista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnalista()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'analista_id']);
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
     * column severidad ENUM value labels
     * @return string[]
     */
    public static function optsSeveridad()
    {
        return [
            self::SEVERIDAD_CRITICA => 'Crítica',
            self::SEVERIDAD_ALTA => 'Alta',
            self::SEVERIDAD_MEDIA => 'Media',
            self::SEVERIDAD_BAJA => 'Baja',
            self::SEVERIDAD_INFORMATIVA => 'Informativa',
        ];
    }

    /**
     * column estado_incidencia ENUM value labels
     * @return string[]
     */
    public static function optsEstadoIncidencia()
    {
        return [
            self::ESTADO_INCIDENCIA_ABIERTO => 'Abierto',
            self::ESTADO_INCIDENCIA_ASIGNADO => 'Asignado',
            self::ESTADO_INCIDENCIA_EN_ANALISIS => 'En Análisis',
            self::ESTADO_INCIDENCIA_EN_CONTENCION => 'En Contención',
            self::ESTADO_INCIDENCIA_EN_REMEDIACION => 'En Remediación',
            self::ESTADO_INCIDENCIA_RESUELTO => 'Resuelto',
            self::ESTADO_INCIDENCIA_CERRADO => 'Cerrado',
            self::ESTADO_INCIDENCIA_FALSO_POSITIVO => 'Falso Positivo',
        ];
    }

    /**
     * @return string
     */
    public function displaySeveridad()
    {
        return self::optsSeveridad()[$this->severidad];
    }

    /**
     * @return bool
     */
    public function isSeveridadCritica()
    {
        return $this->severidad === self::SEVERIDAD_CRITICA;
    }

    public function setSeveridadToCritica()
    {
        $this->severidad = self::SEVERIDAD_CRITICA;
    }

    /**
     * @return bool
     */
    public function isSeveridadAlta()
    {
        return $this->severidad === self::SEVERIDAD_ALTA;
    }

    public function setSeveridadToAlta()
    {
        $this->severidad = self::SEVERIDAD_ALTA;
    }

    /**
     * @return bool
     */
    public function isSeveridadMedia()
    {
        return $this->severidad === self::SEVERIDAD_MEDIA;
    }

    public function setSeveridadToMedia()
    {
        $this->severidad = self::SEVERIDAD_MEDIA;
    }

    /**
     * @return bool
     */
    public function isSeveridadBaja()
    {
        return $this->severidad === self::SEVERIDAD_BAJA;
    }

    public function setSeveridadToBaja()
    {
        $this->severidad = self::SEVERIDAD_BAJA;
    }

    /**
     * @return bool
     */
    public function isSeveridadInformativa()
    {
        return $this->severidad === self::SEVERIDAD_INFORMATIVA;
    }

    public function setSeveridadToInformativa()
    {
        $this->severidad = self::SEVERIDAD_INFORMATIVA;
    }

    /**
     * @return string
     */
    public function displayEstadoIncidencia()
    {
        return self::optsEstadoIncidencia()[$this->estado_incidencia];
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaAbierto()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_ABIERTO;
    }

    public function setEstadoIncidenciaToAbierto()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_ABIERTO;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaAsignado()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_ASIGNADO;
    }

    public function setEstadoIncidenciaToAsignado()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_ASIGNADO;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaEnAnalisis()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_EN_ANALISIS;
    }

    public function setEstadoIncidenciaToEnAnalisis()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_EN_ANALISIS;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaEnContencion()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_EN_CONTENCION;
    }

    public function setEstadoIncidenciaToEnContencion()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_EN_CONTENCION;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaEnRemediacion()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_EN_REMEDIACION;
    }

    public function setEstadoIncidenciaToEnRemediacion()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_EN_REMEDIACION;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaResuelto()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_RESUELTO;
    }

    public function setEstadoIncidenciaToResuelto()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_RESUELTO;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaCerrado()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_CERRADO;
    }

    public function setEstadoIncidenciaToCerrado()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_CERRADO;
    }

    /**
     * @return bool
     */
    public function isEstadoIncidenciaFalsoPositivo()
    {
        return $this->estado_incidencia === self::ESTADO_INCIDENCIA_FALSO_POSITIVO;
    }

    public function setEstadoIncidenciaToFalsoPositivo()
    {
        $this->estado_incidencia = self::ESTADO_INCIDENCIA_FALSO_POSITIVO;
    }
}
