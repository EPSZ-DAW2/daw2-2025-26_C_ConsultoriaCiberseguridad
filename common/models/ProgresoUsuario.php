<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "progreso_usuario".
 *
 * @property int $id
 * @property int $usuario_id Cliente realizando el curso (FK a usuarios con rol=cliente)
 * @property int $curso_id Curso que está realizando (FK a cursos)
 * @property int $diapositiva_actual Última diapositiva vista (número de orden)
 * @property int $cuestionario_realizado Si ya hizo el test final: 0=No, 1=Sí
 * @property float|null $nota_obtenida Nota del cuestionario (0-10) o NULL si no lo ha hecho
 * @property string $fecha_inicio Cuándo empezó el curso
 * @property string|null $fecha_fin Cuándo completó el curso (aprobó o suspendió)
 * @property string $estado Estado actual del progreso
 *
 * @property Cursos $curso
 * @property Usuarios $usuario
 */
class ProgresoUsuario extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_EN_CURSO = 'En curso';
    const ESTADO_APROBADO = 'Aprobado';
    const ESTADO_SUSPENSO = 'Suspenso';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'progreso_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nota_obtenida', 'fecha_fin'], 'default', 'value' => null],
            [['diapositiva_actual'], 'default', 'value' => 1],
            [['cuestionario_realizado'], 'default', 'value' => 0],
            [['estado'], 'default', 'value' => 'En curso'],
            [['usuario_id', 'curso_id'], 'required'],
            [['usuario_id', 'curso_id', 'diapositiva_actual', 'cuestionario_realizado'], 'integer'],
            [['nota_obtenida'], 'number'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['estado'], 'string'],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['usuario_id', 'curso_id'], 'unique', 'targetAttribute' => ['usuario_id', 'curso_id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::class, 'targetAttribute' => ['curso_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'curso_id' => 'Curso ID',
            'diapositiva_actual' => 'Diapositiva Actual',
            'cuestionario_realizado' => 'Cuestionario Realizado',
            'nota_obtenida' => 'Nota Obtenida',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Cursos::class, ['id' => 'curso_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_EN_CURSO => 'En curso',
            self::ESTADO_APROBADO => 'Aprobado',
            self::ESTADO_SUSPENSO => 'Suspenso',
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
    public function isEstadoAprobado()
    {
        return $this->estado === self::ESTADO_APROBADO;
    }

    public function setEstadoToAprobado()
    {
        $this->estado = self::ESTADO_APROBADO;
    }

    /**
     * @return bool
     */
    public function isEstadoSuspenso()
    {
        return $this->estado === self::ESTADO_SUSPENSO;
    }

    public function setEstadoToSuspenso()
    {
        $this->estado = self::ESTADO_SUSPENSO;
    }

    /**
     * Obtiene el historial de cursos completados de un usuario.
     * @param int $userId ID del usuario
     * @return ProgresoUsuario[] Cursos completados (aprobados o suspendidos)
     */
    public static function getHistorialUsuario($userId)
    {
        return self::find()
            ->alias('pu')
            ->joinWith(['curso', 'curso.servicio'])
            ->where(['pu.usuario_id' => $userId])
            ->andWhere(['IN', 'pu.estado', [self::ESTADO_APROBADO, self::ESTADO_SUSPENSO]])
            ->orderBy(['pu.fecha_fin' => SORT_DESC])
            ->all();
    }

    /**
     * Verifica si el usuario aún tiene acceso activo al curso.
     * @return bool True si tiene proyecto activo con este curso
     */
    public function tieneAccesoActivo()
    {
        return Cursos::usuarioPuedeAccederCurso(
            $this->curso_id,
            $this->usuario_id,
            true
        );
    }
}
