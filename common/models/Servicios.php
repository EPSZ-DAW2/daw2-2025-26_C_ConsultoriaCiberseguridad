<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicios".
 *
 * @property int $id
 * @property string $nombre Nombre del servicio
 * @property string|null $descripcion Descripción detallada del servicio
 * @property string $categoria Categoría del servicio
 * @property float|null $precio_base Precio de referencia
 * @property int|null $duracion_estimada Duración típica en días
 * @property int $requiere_auditoria Si requiere auditoría posterior: 0=No, 1=Sí
 * @property int $activo Visible en catálogo: 0=No, 1=Sí
 * @property int|null $creado_por ID del usuario que creó este servicio
 * @property string $fecha_creacion Cuándo se creó
 * @property int|null $modificado_por ID del último usuario que lo modificó
 * @property string|null $fecha_modificacion Última modificación
 *
 * @property Usuarios $creadoPor
 * @property Usuarios $modificadoPor
 * @property Proyectos[] $proyectos
 * @property SolicitudesPresupuesto[] $solicitudesPresupuestos
 */
class Servicios extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const CATEGORIA_GOBERNANZA = 'Gobernanza';
    const CATEGORIA_DEFENSA = 'Defensa';
    const CATEGORIA_AUDITORIA = 'Auditoría';
    const CATEGORIA_FORMACION = 'Formación';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'precio_base', 'duracion_estimada', 'creado_por', 'modificado_por', 'fecha_modificacion'], 'default', 'value' => null],
            [['categoria'], 'default', 'value' => 'Gobernanza'],
            [['requiere_auditoria'], 'default', 'value' => 0],
            [['activo'], 'default', 'value' => 1],
            [['nombre'], 'required'],
            // HE BORRADO 'mas_informacion' DE AQUÍ ABAJO:
            [['descripcion', 'categoria'], 'string'], 
            [['precio_base'], 'number'],
            [['duracion_estimada', 'requiere_auditoria', 'activo', 'creado_por', 'modificado_por'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            ['categoria', 'in', 'range' => array_keys(self::optsCategoria())],
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
            // HE BORRADO 'mas_informacion' DE AQUÍ TAMBIÉN
            'categoria' => 'Categoria',
            'precio_base' => 'Precio Base',
            'duracion_estimada' => 'Duracion Estimada',
            'requiere_auditoria' => 'Requiere Auditoria',
            'activo' => 'Activo',
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
     * Gets query for [[ModificadoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModificadoPor()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'modificado_por']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyectos::class, ['servicio_id' => 'id']);
    }

    /**
     * Gets query for [[SolicitudesPresupuestos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudesPresupuestos()
    {
        return $this->hasMany(SolicitudesPresupuesto::class, ['servicio_id' => 'id']);
    }


    /**
     * column categoria ENUM value labels
     * @return string[]
     */
    public static function optsCategoria()
    {
        return [
            self::CATEGORIA_GOBERNANZA => 'Gobernanza',
            self::CATEGORIA_DEFENSA => 'Defensa',
            self::CATEGORIA_AUDITORIA => 'Auditoría',
            self::CATEGORIA_FORMACION => 'Formación',
        ];
    }

    /**
     * @return string
     */
    public function displayCategoria()
    {
        return self::optsCategoria()[$this->categoria];
    }

    /**
     * @return bool
     */
    public function isCategoriaGobernanza()
    {
        return $this->categoria === self::CATEGORIA_GOBERNANZA;
    }

    public function setCategoriaToGobernanza()
    {
        $this->categoria = self::CATEGORIA_GOBERNANZA;
    }

    /**
     * @return bool
     */
    public function isCategoriaDefensa()
    {
        return $this->categoria === self::CATEGORIA_DEFENSA;
    }

    public function setCategoriaToDefensa()
    {
        $this->categoria = self::CATEGORIA_DEFENSA;
    }

    /**
     * @return bool
     */
    public function isCategoriaAuditoria()
    {
        return $this->categoria === self::CATEGORIA_AUDITORIA;
    }

    public function setCategoriaToAuditoria()
    {
        $this->categoria = self::CATEGORIA_AUDITORIA;
    }

    /**
     * @return bool
     */
    public function isCategoriaFormacion()
    {
        return $this->categoria === self::CATEGORIA_FORMACION;
    }

    public function setCategoriaToFormacion()
    {
        $this->categoria = self::CATEGORIA_FORMACION;
    }

    /**
     * Devuelve la URL de la imagen del servicio basada en su ID.
     * Busca en frontend/web/template/assets/img/services/service_{id}.jpg
     * * @return string
     */
    public function getImagenUrl()
    {
        $filename = 'service_' . $this->id . '.jpg';
        $filePath = Yii::getAlias('@frontend/web/template/assets/img/services/') . $filename;
        
        if (file_exists($filePath)) {
            $timestamp = filemtime($filePath); // Obtener fecha de modificación para cache busting
            return Yii::getAlias('@web/template/assets/img/services/') . $filename . '?v=' . $timestamp;
        }

        // Imagen por defecto si no existe la específica
        return Yii::getAlias('@web/template/assets/img/ens.jpg'); 
    }
}