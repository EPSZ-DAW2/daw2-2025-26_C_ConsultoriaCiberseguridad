<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "logs_defender".
 *
 * @property int $id
 * @property string $evento
 * @property string $fuente
 * @property string $gravedad
 * @property string $fecha
 * @property int|null $cliente_afectado_id
 * @property string|null $sistema
 * @property string $estado
 * @property string|null $detalles_tecnicos
 *
 * @property Usuarios $clienteAfectado
 */
class LogDefender extends \yii\db\ActiveRecord
{
    const GRAVEDAD_CRITICA = 'Crítica';
    const GRAVEDAD_ALTA = 'Alta';
    const GRAVEDAD_MEDIA = 'Media';
    const GRAVEDAD_BAJA = 'Baja';
    const GRAVEDAD_INFORMATIVA = 'Informativa';

    const ESTADO_PENDIENTE = 'Pendiente';
    const ESTADO_PROCESADO = 'Procesado';
    const ESTADO_IGNORADO = 'Ignorado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%logs_defender}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evento'], 'required'],
            [['gravedad', 'estado', 'detalles_tecnicos'], 'string'],
            [['fecha'], 'safe'],
            [['cliente_afectado_id'], 'integer'],
            [['evento'], 'string', 'max' => 255],
            [['fuente', 'sistema'], 'string', 'max' => 100],
            [['gravedad'], 'default', 'value' => self::GRAVEDAD_MEDIA],
            [['estado'], 'default', 'value' => self::ESTADO_PENDIENTE],
            [['cliente_afectado_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['cliente_afectado_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'evento' => 'Evento',
            'fuente' => 'Fuente',
            'gravedad' => 'Gravedad',
            'fecha' => 'Fecha',
            'cliente_afectado_id' => 'Cliente Afectado',
            'sistema' => 'Sistema',
            'estado' => 'Estado',
            'detalles_tecnicos' => 'Detalles Técnicos',
        ];
    }

    /**
     * Relación con el Cliente
     */
    public function getClienteAfectado()
    {
        return $this->hasOne(User::class, ['id' => 'cliente_afectado_id']);
    }
}
