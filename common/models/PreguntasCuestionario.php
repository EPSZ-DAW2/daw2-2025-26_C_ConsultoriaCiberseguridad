<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "preguntas_cuestionario".
 *
 * @property int $id
 * @property int $curso_id Curso al que pertenece la pregunta (FK a cursos)
 * @property string $enunciado_pregunta Texto de la pregunta
 * @property string $opcion_a Texto de la opción A
 * @property string $opcion_b Texto de la opción B
 * @property string $opcion_c Texto de la opción C
 * @property string $opcion_correcta Cuál es la respuesta correcta
 * @property int|null $creado_por Usuario que creó la pregunta
 * @property string $fecha_creacion
 * @property int|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Usuarios $creadoPor
 * @property Cursos $curso
 * @property Usuarios $modificadoPor
 */
class PreguntasCuestionario extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const OPCION_CORRECTA_A = 'a';
    const OPCION_CORRECTA_B = 'b';
    const OPCION_CORRECTA_C = 'c';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preguntas_cuestionario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creado_por', 'modificado_por', 'fecha_modificacion'], 'default', 'value' => null],
            [['curso_id', 'enunciado_pregunta', 'opcion_a', 'opcion_b', 'opcion_c', 'opcion_correcta'], 'required'],
            [['curso_id', 'creado_por', 'modificado_por'], 'integer'],
            [['enunciado_pregunta', 'opcion_correcta'], 'string'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['opcion_a', 'opcion_b', 'opcion_c'], 'string', 'max' => 500],
            ['opcion_correcta', 'in', 'range' => array_keys(self::optsOpcionCorrecta())],
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
            'enunciado_pregunta' => 'Enunciado Pregunta',
            'opcion_a' => 'Opcion A',
            'opcion_b' => 'Opcion B',
            'opcion_c' => 'Opcion C',
            'opcion_correcta' => 'Opcion Correcta',
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


    /**
     * column opcion_correcta ENUM value labels
     * @return string[]
     */
    public static function optsOpcionCorrecta()
    {
        return [
            self::OPCION_CORRECTA_A => 'a',
            self::OPCION_CORRECTA_B => 'b',
            self::OPCION_CORRECTA_C => 'c',
        ];
    }

    /**
     * @return string
     */
    public function displayOpcionCorrecta()
    {
        return self::optsOpcionCorrecta()[$this->opcion_correcta];
    }

    /**
     * @return bool
     */
    public function isOpcionCorrectaA()
    {
        return $this->opcion_correcta === self::OPCION_CORRECTA_A;
    }

    public function setOpcionCorrectaToA()
    {
        $this->opcion_correcta = self::OPCION_CORRECTA_A;
    }

    /**
     * @return bool
     */
    public function isOpcionCorrectaB()
    {
        return $this->opcion_correcta === self::OPCION_CORRECTA_B;
    }

    public function setOpcionCorrectaToB()
    {
        $this->opcion_correcta = self::OPCION_CORRECTA_B;
    }

    /**
     * @return bool
     */
    public function isOpcionCorrectaC()
    {
        return $this->opcion_correcta === self::OPCION_CORRECTA_C;
    }

    public function setOpcionCorrectaToC()
    {
        $this->opcion_correcta = self::OPCION_CORRECTA_C;
    }
}
