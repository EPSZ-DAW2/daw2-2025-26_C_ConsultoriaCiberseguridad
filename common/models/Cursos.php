<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cursos".
 *
 * @property int $id
 * @property string $nombre Nombre del curso (ej: "Concienciación Phishing")
 * @property string|null $descripcion Descripción del contenido del curso
 * @property string|null $video_url URL del video del curso (o iframe)
 * @property string|null $imagen_portada Ruta a la imagen de portada del curso o NULL si no tiene
 * @property float $nota_minima_aprobado Nota mínima para aprobar el cuestionario (ej: 5.00 sobre 10)
 * @property int $activo Curso activo y disponible: 0=Inactivo, 1=Activo
 * @property int|null $creado_por Usuario que creó el curso
 * @property string $fecha_creacion
 * @property int|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Usuarios $creadoPor
 * @property Diapositivas[] $diapositivas
 * @property Usuarios $modificadoPor
 * @property PreguntasCuestionario[] $preguntasCuestionarios
 * @property ProgresoUsuario[] $progresoUsuarios
 * @property Usuarios[] $usuarios
 */
class Cursos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'imagen_portada', 'creado_por', 'modificado_por', 'fecha_modificacion'], 'default', 'value' => null],
            [['nota_minima_aprobado'], 'default', 'value' => 5.00],
            [['activo'], 'default', 'value' => 1],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['activo', 'servicio_id'], 'integer'],
            [['nota_minima_aprobado'], 'number'],
            [['activo', 'creado_por', 'modificado_por'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            [['imagen_portada', 'video_url'], 'string', 'max' => 255],
            [['creado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['creado_por' => 'id']],
            [['modificado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['modificado_por' => 'id']],
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
            'imagen_portada' => 'Imagen Portada',
            'nota_minima_aprobado' => 'Nota Minima Aprobado',
            'activo' => 'Activo',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
            'video_url' => 'URL del Video',
            'servicio_id' => 'Servicio Asociado',
        ];
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
     * Gets query for [[Diapositivas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiapositivas()
    {
        return $this->hasMany(Diapositivas::class, ['curso_id' => 'id']);
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
     * Gets query for [[PreguntasCuestionarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntasCuestionarios()
    {
        return $this->hasMany(PreguntasCuestionario::class, ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[ProgresoUsuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgresoUsuarios()
    {
        return $this->hasMany(ProgresoUsuario::class, ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::class, ['id' => 'usuario_id'])->viaTable('progreso_usuario', ['curso_id' => 'id']);
    }

}
