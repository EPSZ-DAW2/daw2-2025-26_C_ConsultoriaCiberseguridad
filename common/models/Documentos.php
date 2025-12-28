<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "documentos".
 *
 * @property int $id
 * @property int $proyecto_id Proyecto al que pertenece (FK a proyectos)
 * @property string $nombre_archivo Nombre del archivo (ej: "Politica_Seguridad_v2.pdf")
 * @property string|null $descripcion Descripción del contenido
 * @property string $ruta_archivo Ruta en el servidor donde se guarda el archivo
 * @property string $tipo_documento Tipo de documento
 * @property int $tamaño_bytes Tamaño del archivo en bytes
 * @property string|null $version Versión del documento
 * @property int $visible_cliente Si el cliente puede verlo: 0=No, 1=Sí
 * @property string|null $hash_verificacion Hash SHA-256 para verificar integridad del archivo
 * @property int $subido_por Usuario que subió el documento (FK a usuarios)
 * @property string $fecha_subida Cuándo se subió
 * @property string|null $fecha_modificacion Si se modificó el archivo
 * @property string|null $notas Notas adicionales sobre el documento
 *
 * @property Proyectos $proyecto
 * @property Usuarios $subidoPor
 */
class Documentos extends \yii\db\ActiveRecord
{
    /**
     * ENUM field values
     */
    const TIPO_DOCUMENTO_POLITICA = 'Política';
    const TIPO_DOCUMENTO_PROCEDIMIENTO = 'Procedimiento';
    const TIPO_DOCUMENTO_INFORME_DE_AUDITORIA = 'Informe de Auditoría';
    const TIPO_DOCUMENTO_INFORME_SOC = 'Informe SOC';
    const TIPO_DOCUMENTO_PLAN_DE_ACCION = 'Plan de Acción';
    const TIPO_DOCUMENTO_CERTIFICADO = 'Certificado';
    const TIPO_DOCUMENTO_DOCUMENTACION_TECNICA = 'Documentación Técnica';
    const TIPO_DOCUMENTO_OTROS = 'Otros';

    // -----------------------------------------------------------
    //              NUEVA VARIABLE PARA LA SUBIDA
    // -----------------------------------------------------------
    /**
     * @var UploadedFile Variable para manejar la subida del archivo
     */
    public $archivo_subido;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'hash_verificacion', 'fecha_modificacion', 'notas'], 'default', 'value' => null],
            [['tipo_documento'], 'default', 'value' => 'Otros'],
            [['tamaño_bytes'], 'default', 'value' => 0],
            [['version'], 'default', 'value' => 1.0],
            [['visible_cliente'], 'default', 'value' => 1],
            
            [['proyecto_id', 'subido_por'], 'required'],
            [['proyecto_id', 'tamaño_bytes', 'visible_cliente', 'subido_por'], 'integer'],
            [['descripcion', 'ruta_archivo', 'tipo_documento', 'notas'], 'string'],
            [['fecha_subida', 'fecha_modificacion'], 'safe'],
            [['nombre_archivo'], 'string', 'max' => 255],
            [['version'], 'string', 'max' => 20],
            [['hash_verificacion'], 'string', 'max' => 64],
            
            // --- NUEVA REGLA: VALIDAR QUE SEA UN PDF ---
            [['archivo_subido'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'checkExtensionByMimeType' => false],
            // -------------------------------------------

            ['tipo_documento', 'in', 'range' => array_keys(self::optsTipoDocumento())],
            [['proyecto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proyectos::class, 'targetAttribute' => ['proyecto_id' => 'id']],
            [['subido_por'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['subido_por' => 'id']],
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
            'nombre_archivo' => 'Nombre Archivo',
            'descripcion' => 'Descripción',
            'ruta_archivo' => 'Ruta Archivo',
            'tipo_documento' => 'Tipo Documento',
            'tamaño_bytes' => 'Tamaño',
            'version' => 'Versión',
            'visible_cliente' => 'Visible Cliente (1=Sí, 0=No)',
            'hash_verificacion' => 'Hash Verificación',
            'subido_por' => 'Subido Por',
            'fecha_subida' => 'Fecha Subida',
            'fecha_modificacion' => 'Fecha Modificación',
            'notas' => 'Notas',
            'archivo_subido' => 'Archivo PDF', // Etiqueta para el formulario
        ];
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
     * Gets query for [[SubidoPor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubidoPor()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'subido_por']);
    }


    /**
     * column tipo_documento ENUM value labels
     * @return string[]
     */
    public static function optsTipoDocumento()
    {
        return [
            self::TIPO_DOCUMENTO_POLITICA => 'Política',
            self::TIPO_DOCUMENTO_PROCEDIMIENTO => 'Procedimiento',
            self::TIPO_DOCUMENTO_INFORME_DE_AUDITORIA => 'Informe de Auditoría',
            self::TIPO_DOCUMENTO_INFORME_SOC => 'Informe SOC',
            self::TIPO_DOCUMENTO_PLAN_DE_ACCION => 'Plan de Acción',
            self::TIPO_DOCUMENTO_CERTIFICADO => 'Certificado',
            self::TIPO_DOCUMENTO_DOCUMENTACION_TECNICA => 'Documentación Técnica',
            self::TIPO_DOCUMENTO_OTROS => 'Otros',
        ];
    }

    /**
     * @return string
     */
    public function displayTipoDocumento()
    {
        return self::optsTipoDocumento()[$this->tipo_documento];
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoPolitica()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_POLITICA;
    }

    public function setTipoDocumentoToPolitica()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_POLITICA;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoProcedimiento()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_PROCEDIMIENTO;
    }

    public function setTipoDocumentoToProcedimiento()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_PROCEDIMIENTO;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoInformeDeAuditoria()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_INFORME_DE_AUDITORIA;
    }

    public function setTipoDocumentoToInformeDeAuditoria()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_INFORME_DE_AUDITORIA;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoInformeSoc()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_INFORME_SOC;
    }

    public function setTipoDocumentoToInformeSoc()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_INFORME_SOC;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoPlanDeAccion()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_PLAN_DE_ACCION;
    }

    public function setTipoDocumentoToPlanDeAccion()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_PLAN_DE_ACCION;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoCertificado()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_CERTIFICADO;
    }

    public function setTipoDocumentoToCertificado()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_CERTIFICADO;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoDocumentacionTecnica()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_DOCUMENTACION_TECNICA;
    }

    public function setTipoDocumentoToDocumentacionTecnica()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_DOCUMENTACION_TECNICA;
    }

    /**
     * @return bool
     */
    public function isTipoDocumentoOtros()
    {
        return $this->tipo_documento === self::TIPO_DOCUMENTO_OTROS;
    }

    public function setTipoDocumentoToOtros()
    {
        $this->tipo_documento = self::TIPO_DOCUMENTO_OTROS;
    }
}
