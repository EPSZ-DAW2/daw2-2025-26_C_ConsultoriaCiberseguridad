<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diapositivas".
 *
 * @property int $id
 * @property int $curso_id Curso al que pertenece (FK a cursos)
 * @property int $numero_orden Orden de la diapositiva (1, 2, 3, ...). Determina la secuencia.
 * @property string $titulo Título de la diapositiva
 * @property string|null $contenido_html Contenido explicativo en formato HTML o NULL si solo tiene multimedia
 * @property string|null $imagen_url Ruta a imagen/esquema explicativo o NULL si no tiene
 * @property string|null $video_url URL a video (YouTube, Vimeo, servidor propio) o NULL si no tiene
 * @property int|null $creado_por Usuario que creó la diapositiva
 * @property string $fecha_creacion
 * @property int|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Usuarios $creadoPor
 * @property Cursos $curso
 * @property Usuarios $modificadoPor
 */
class Diapositivas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diapositivas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contenido_html', 'imagen_url', 'video_url', 'creado_por', 'modificado_por', 'fecha_modificacion'], 'default', 'value' => null],
            [['curso_id', 'numero_orden', 'titulo'], 'required'],
            [['curso_id', 'numero_orden', 'creado_por', 'modificado_por'], 'integer'],
            [['contenido_html'], 'string'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['titulo', 'imagen_url'], 'string', 'max' => 255],
            [['video_url'], 'string', 'max' => 500],
            [['creado_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['creado_por' => 'id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::class, 'targetAttribute' => ['curso_id' => 'id']],
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
            'curso_id' => 'Curso ID',
            'numero_orden' => 'Numero Orden',
            'titulo' => 'Titulo',
            'contenido_html' => 'Contenido Html',
            'imagen_url' => 'Imagen Url',
            'video_url' => 'Video Url',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
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
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Cursos::class, ['id' => 'curso_id']);
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

}
